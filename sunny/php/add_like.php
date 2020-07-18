<?php
    include_once("functions/database.php"); 
    get_connection();
    $new_id = $_GET['new_id'];
    $sql = "select * from booklist where book_id = '{$new_id}'";
    $ret = mysql_query($sql);
    while($row = mysql_fetch_array($ret)){
        $hot = $row['hot'];
    }
    $hot = $hot + 1;
    $sql1 = "update booklist set hot = '{$hot}' where book_id = '{$new_id}'";
    mysql_query($sql1);
    close_connection();
    echo "<script>window.history.back(-1)</script>";
?>