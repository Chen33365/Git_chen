<?php
include_once("functions/database.php");
include_once("functions/page.php");
include_once("infoArr.php");
get_connection();
$keyword = "";
$total_records = mysql_num_rows($bookResult);
$page_size = 5;
if (isset($_GET["page_current"])) {
    $page_current = $_GET["page_current"];
} else {
    $page_current = 1;
}
$start = ($page_current - 1) * $page_size;
$result_sql = "select * from bookList order by book_id desc limit $start,$page_size";
$result_set = mysql_query($result_sql);

if(isset($_GET["item"])){
    $keyword = $_GET["item"];
    //构造模糊查询新闻的SQL语句
    $result_sql = "select * from booklist where title like '%$keyword%'  order by book_id desc limit $start,$page_size";
    $result_set = mysql_query($result_sql);
	$total_records = mysql_num_rows($result_set);
}
close_connection();
?>



<link rel="stylesheet" href="./css/admin.css">

<div class="admin contain">
    <div class="adminLeft fl">
        <ul>
            <li class="bookList_admin active">图书管理</li>
            <li class="user_admin">用户管理</li>
            <li class="news_add">发布图书</li>
        </ul>
    </div>
    <div class="adminRight fr">

        <div class="bookList">
            请输入关键字：<input type="text" class="adminSearch" value="<?php echo isset($_GET['item']) ? $_GET['item'] : '';?>">
            <a class="Btn">搜索</a>
            <script>
                $('.bookList').find('.Btn').on('click', function(){
                  $.ajax({
                    url:"index.php",
                    type:"post",
                    data:{
                    //   url:"index.php?url=./php/admin.php&item=" + $('.search').find('input').val()
                    },
                    dataType:'json'
                  });
                  window.location="index.php?url=./php/admin.php&item=" + $('.bookList').find('input').val();
                });
              </script>

            <ul class="bookList-title">
                <li>书名</li>
                <li>作者</li>
                <li>用户操作</li>
            </ul>
            <ul class="bookList-content">
                    <?php
                    while($row = mysql_fetch_array($result_set)){
                    ?>
                    <li>
                        <div><?php echo $row['title']?></div>
                        <div><?php echo $row['author']?></div>
                        <div><a href="index.php?url=./php/edit.php&book_id=<?php echo $row['book_id']?>" class="user-office">修改</a>
                        <a href="index.php?url=./php/book_delete.php&book_id=<?php echo $row['book_id']?>" class="user-delete">删除</a>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
            <?php
                $url = $_SERVER["PHP_SELF"] . "?url=./php/admin.php";
                page($total_records, $page_size, $page_current, $url, $keyword);
            ?>
            </ul>
        </div>


        <div class="news">
            <div>
                <h1>发布新的图书</h1>
            </div>
            <div class="add">
                <form action="./php/book_add.php" method="POST"  enctype="multipart/form-data">
                    <div class="addLeft fl">
                        书名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title"></br>
                        作者：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="author"></br>
                        字数：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="word"></br>
                        详情介绍：<input type="text" name="details"></br>
                        当前热度：<input type="text" name="hot"></br>
                    </div>
                    <div class="addRight fr">
                        上传图片：<input type="file" name="add_img"></br>
                        资源地址：<input type="text" name="add_url"></br>
                        图书分类：<input type="text" name="class"></br>
                    </div>
                    <input type="submit" value="点击发布">
                </form>
            </div>
        </div>
        <div class="user">
            <ul class="user-title">
                <li>用户名</li>
                <li>密码</li>
                <li>用户操作</li>
            </ul>
            <ul class="user-content">
                <?php
                    while($userRow = mysql_fetch_array($useArrResult)){
                        if($userRow['user_id'] == 1){
                        ?>
                            <li>
                            <div><?php echo $userRow['uname']?></div>
                            <div>*******</div>
                            <div><a href="index.php?url=./php/edit.php&user_id=<?php echo $userRow['user_id']?>" class="user-office">编辑</a>
                            </div>
                            </li>   

                        <?php    
                        }else{
                        ?>
                        <li>
                          <div><?php echo $userRow['uname']?></div>
                          <div>*******</div>
                          <div><a href="index.php?url=./php/edit.php&user_id=<?php echo $userRow['user_id']?>" class="user-office">编辑</a>
                          <a href="index.php?url=./php/user_delete.php&user_id=<?php echo $userRow['user_id']?>" onclick="return confirm('你确定要删除吗？');" class="user-delete">失效</a>
                          </div>
                      </li>            
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
            </ul>
        </div>
    </div>
</div>
<script>
    $('.adminLeft').find('ul').find('li').on('click', function(e){
        $('.adminLeft').find('ul').find('.active').removeClass('active')
        $('.adminRight').find('.user').css({display:'none'})
        $('.adminRight').find('.bookList').css({display:'none'})
        $('.adminRight').find('.news').css({display:'none'})

        if(e.target.className == 'news_add'){
            $('.adminRight').find('.news').slideDown(500)
        }else if(e.target.className == 'user_admin'){
            $('.adminRight').find('.user').slideDown(500)
        }else if(e.target.className == 'bookList_admin'){
            $('.adminRight').find('.bookList').slideDown(500)
        }
        $(this).addClass('active');
    })
</script>