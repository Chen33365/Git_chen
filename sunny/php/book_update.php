<?php
        include_once('functions/database.php');
        header("Content-type:text/html;charset=utf-8");
        $id = $_POST['id'];
        $title = $_POST["title"];
        $author = $_POST["author"];
        $word = $_POST["word"];
        $details = $_POST["details"];
        $hot = $_POST["hot"];
        $add_url = $_POST["add_url"];
        $class = $_POST["class"];

        get_connection();

        if($_FILES['add_img']['name'] != ''){
            $imgFile = $_FILES['add_img'];
            $imgFileName = $imgFile['name'];
            $sql = "update booklist set title = '$title',author = '$author',word = '$word', details = '$details', hot = '$hot', img = '$imgFileName', url = '$add_url', class = '$class' where book_id = $id";
            move_uploaded_file($imgFile['tmp_name'], '../img/book/'.$imgFileName);
        }else{
            $sql = "update booklist set title = '$title',author = '$author',word = '$word', details = '$details', hot = '$hot', url = '$add_url', class = '$class' where book_id = $id";
        }
        if(mysql_query($sql)){
            echo "<script>alert('修改成功！');window.history.back(-1)</script>";
        }else{
            echo "<script>alert('修改失败！');window.history.back(-1)</script>";
        }
        close_connection();
?>