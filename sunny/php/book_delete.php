<?php

    include_once('php/functions/database.php');
    $bookId = $_GET['book_id'];

    $sql = "delete from booklist where book_id = '$bookId'";
    
    get_connection();
    mysql_query($sql);
    close_connection();
    echo "<script>window.history.back(-1)</script>";

?>