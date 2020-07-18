<?php

header('Content-type:text/html;charset=utf-8');

include_once("functions/database.php");

$name = $_POST['name'];
$password = $_POST['password'];
if($_FILES['imgFile']['name'] != ''){
    $imgFile = $_FILES['imgFile'];
    $imgFileName = $imgFile['name'];
}else{
    $imgFileName = "timg.jfif";
}
//判断用户名是否占用
$nameSQL = "select * from user where uname='$name'";
get_connection();

if ($password == "" || $name == ''){
    echo "<script>alert('用户名或密码不能为空'); history.back();</script>";break;
}

$resultSet = mysql_query($nameSQL);
if(mysql_num_rows($resultSet)>0){
	close_connection();
    exit("<script>alert('用户名已被占用，请重新输入！');window.location='./register.php'</script>");
    return;
}

$sql = "insert into user (uname,password,photo) values ('$name','$password','$imgFileName')";
if(mysql_query($sql)){
    if($_FILES['imgFile']['name'] != ''){
        move_uploaded_file($imgFile['tmp_name'], '../img/head_photo/'.$imgFileName);
    }
    echo "<script>alert('注册成功！');window.location='../index.php'</script>";
}else{
    echo "<script>alert('注册失败！');window.location='./register.php'</script>";
}

close_connection();
?>