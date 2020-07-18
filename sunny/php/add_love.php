<?php
include_once("functions/database.php"); 
get_connection();

if(isset($_GET['new_id'])){
    $new_id = $_GET['new_id'];
}else{
    $new_id = '';
}
if(isset($_GET['load'])){
    $load = $_GET['load'];
    if($load == 3){
        echo "<script>alert('请先登录！');window.history.back(-1)</script>";
        return;
    }
}

if($_SESSION['user_id'] && $load == 0){
    $userId = $_SESSION['user_id'];
    $sql = "INSERT `read` VALUES (null, $userId,$new_id)";
    mysql_query($sql);
}
if($load){
    $userId = $_SESSION['user_id'];
    $sql = "DELETE FROM `read` WHERE user = '{$userId}'  and book_id = '{$new_id}'";
    mysql_query($sql);
}
close_connection();
echo "<script>window.history.back(-1)</script>";
?>
