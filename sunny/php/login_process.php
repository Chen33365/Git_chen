<?php
include_once("functions/database.php");

header('Content-type:text/html;charset=UTF-8');

$name = trim( $_POST["name"] );
$password = trim( $_POST["password"] );

$sql = "select * from user where uname='$name' and password ='$password'";
get_connection();
$result_set = mysql_query($sql);
if(mysql_num_rows($result_set)>0){
	if(isset($_POST["expire"])){
		$expire = time()+intval($_POST["expire"]);
		setcookie("name",$name,$expire);
		setcookie("password",$password,$expire);
	}
	session_start();
	$admin = mysql_fetch_array($result_set);
	$_SESSION['user_id'] = $admin['user_id'];
	$_SESSION['name'] = $admin['uname'];
	$_SESSION['imgSrc'] = $admin['photo'];
	header("Location:../index.php?login_message=password_right");
}else{
	echo "<script>alert('账号或密码有误！');window.location='../index.php?login_message=password_error'</script>";
}
close_connection();
?>
