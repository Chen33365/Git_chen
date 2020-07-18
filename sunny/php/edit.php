<link rel="stylesheet" href="./css/edit.css">
<div class="back">
    <a style="    cursor: pointer;" onclick="window.history.back(-1);"><</a>
 
</div>
<?php
    include_once('functions/database.php');
    get_connection();

    if(isset($_GET['user_id'])){
    $num = $_GET['user_id'];
    $sql = "select * from user";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result)){
        if($num == $row["user_id"]){
            $u = $row;
        }
    }
?>
    <div class="user">
        <div class="user-edit">更新用户操作</div>
        <div class="content">
            <form action="./php/user_update.php" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'];?>">
                用户名：<input type="text" name="name" value="<? echo $u['uname'];?>"></br>
                密码：&nbsp;&nbsp;&nbsp;<input type="text" name="password" value="<?php echo $u['password']?>"></br>
                <input type="submit" value="确定修改">
            </form>
        </div>
    </div>
<?php
    }
    if(isset( $_GET['book_id'])){
    $num = $_GET['book_id'];
    $sql = "select * from booklist";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result)){
        if($num == $row["book_id"]){
            $u = $row;
        }
    }
?>
<div class="book">
    <div class="news">
                <div>
                    <h1>修改图书</h1>
                </div>
                <div class="add">
                    <form action="./php/book_update.php" method="POST"  enctype="multipart/form-data">
                        <div class="addLeft fl">
                            <input type="hidden"name="id" value="<?php echo $u['book_id']?>">
                            书名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" value="<?php echo $u['title'];?>"></br>
                            作者：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="author"value="<?php echo $u['author'];?>"></br>
                            字数：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="word"value="<?php echo $u['word'];?>"></br>
                            详情介绍：<input type="text" class="details" name="details"value="<?php echo $u['details']?>"></br>
                            当前热度：<input type="text" name="hot"value="<?php echo $u['hot']?>"></br>
                        </div>
                        <div class="addRight fr">
                            更改图片：<input type="file" name="add_img"value="<?php echo $u['img']?>"></br>
                            资源地址：<input type="text" name="add_url"value="<?php echo $u['url']?>"></br>
                            图书分类：<input type="text" name="class"value="<?php echo $u['class']?>"></br>
                        </div>
                        <input type="submit" value="确认修改">
                    </form>
                </div>
    </div>
</div>
<?php
}
close_connection();
?>

