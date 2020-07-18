<?php
    include_once('functions/database.php');
    header("Content-type:text/html;charset=utf-8");

    $id = $_POST['user_id'];
    $uname = $_POST['name'];
    $pwd = $_POST['password'];
    
    get_connection();
    $sql = "update user set uname = '$uname',password = '$pwd' where user_id = '$id'";

    if(mysql_query($sql)){
        echo "<script>alert('修改成功！');window.history.back(-1)</script>";
    }else{
        echo "<script>alert('修改失败！');window.history.back(-1)</script>";
    }
    close_connection();
?>