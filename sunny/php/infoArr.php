<?php
    include_once("functions/database.php");
    get_connection();
    
    $bookArr = "SELECT * FROM booklist ORDER BY booklist.hot DESC";
    $userArr = "select * from user";
    $readArr = "SELECT `read`.user,booklist.book_id,booklist.title,booklist.author,booklist.word,booklist.details,booklist.hot,booklist.img,booklist.url,booklist.class FROM booklist ,`read` ,`user` WHERE booklist.book_id = `read`.book_id AND `user`.user_id = `read`.`user`";

    $bookResult = mysql_query($bookArr);
    $useArrResult = mysql_query($userArr);
    $readArrResult = mysql_query($readArr);

    close_connection();

?>