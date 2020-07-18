<?php

    include_once('php/functions/database.php');
    $userId = $_GET['user_id'];

    $sql = "delete from user where user_id = '$userId'";
    
    get_connection();
    mysql_query($sql);
    close_connection();
    echo "<script>window.history.back(-1)</script>";

?>