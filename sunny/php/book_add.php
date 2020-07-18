<?php
    include_once('functions/database.php');
    header("Content-type:text/html;charset=utf-8");
    $title = $_POST["title"] != '' ? trim($_POST["title"]) : "";
    $author = $_POST["author"] != '' ? trim($_POST["author"]) : "佚名";
    $word = $_POST["word"] != ''? trim($_POST["word"]) : "未知";
    $details = $_POST["details"] != '' ? trim($_POST["details"]) : "暂无";
    $hot = $_POST["hot"] != '' ? trim($_POST["hot"]) : "无";
    $add_url = $_POST["add_url"] != '' ? trim($_POST["add_url"]) : "";
    $class = $_POST["class"] != '' ? trim($_POST["class"]) : "";

    get_connection();
    if($_FILES['add_img']['name'] != ''){
        $imgFile = $_FILES['add_img'];
        $imgFileName = $imgFile['name'];
    }else{
        $imgFileName = "book_default.png";
    }
    $sql = "insert into bookList values (null,'$title','$author', '$word', '$details', '$hot','$imgFileName','$add_url','$class')";
    if(mysql_query($sql)){
        if($_FILES['add_img']['name'] != ''){
            move_uploaded_file($imgFile['tmp_name'], '../img/book/'.$imgFileName);
        }
        echo "<script>alert('发布成功');window.history.back(-1)</script>";
    }else{
        echo "<script>alert('发布失败');window.history.back(-1)</script>";
    }
    
    close_connection();
?>