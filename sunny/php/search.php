<?php
include_once("php/functions/is_login.php");
if (!session_id()){//这里使用session_id()判断是否已经开启了Session
	session_start();
}

include_once("functions/database.php");
include_once("functions/page.php");
include_once("infoArr.php");
get_connection();
$keyword = "";
$total_records = mysql_num_rows($bookResult);
$page_size = 8;
if (isset($_GET["page_current"])) {
    $page_current = $_GET["page_current"];
} else {
    $page_current = 1;
}
$start = ($page_current - 1) * $page_size;
$result_sql = "select * from bookList order by book_id desc limit $start,$page_size";
$result_set = mysql_query($result_sql);
if($_GET["title"] != ''){
    $keyword = $_GET["title"];
    //构造模糊查询新闻的SQL语句
    $result_sql = "select * from bookList where title like '%$keyword%'  order by book_id desc limit $start,$page_size";
    $result_set = mysql_query($result_sql);
	$total_records = mysql_num_rows($result_set);
}
close_connection();

?>
<link rel="stylesheet" href="./css/search.css">
<div class="searchHead contain">
        <div class="seacrchContent">
            <div class="contentLeft fl">
                <p class="colorTitle">找到<?php echo $total_records;?>条数据</p>
                <div class="content">
                    <ul>
                    <?php
                        while ($row = mysql_fetch_array($result_set)) {
                        ?>
                            <li>
                                <a href="index.php?url=./php/book_detail.php&news_id=<?php echo $row['book_id'] ?>">
                                    <img src="<?php echo './img/book/' . $row['img'] . '' ?>" class="fl">
                                    <div class="text-right fl">
                                        <p class="bookname"><?php echo $row['title']; ?></p>
                                        <p class="uname"><?php echo $row['author'] ?></p>
                                        <p class="hot"><?php echo $row['hot'] ?></p>
                                        <p class="textword"><?php echo $row['details'] ?></p>
                                    </div>
                                </a>
                            </li>
                        <?php
                        }
                    ?>
                    </ul>
                <?php
                    $url = $_SERVER["PHP_SELF"] . "?url=./php/search.php";
                    page($total_records, $page_size, $page_current, $url, $keyword);
                ?>
                <div >
                </div>
                </div>
            </div>
            <div class="contentRight fr">
                <p class="colorTitle">搜索排行</p>
                <ul class="ul-bookflow">
                    <?php
                        include_once("infoArr.php");
                        $i = 0;
                        while ($row = mysql_fetch_array($bookResult)) {
                            $i++;
                            if($i == 16){
                            break;
                            }
                        ?>
                            <a href="index.php?url=./php/book_detail.php&news_id=<?php echo $row['book_id']?>">
                            <span class="flow-number"><?php echo $i?></span>
                            <span class="flow-book"><?php echo $row['title'] ?></span>
                            <span class="flow"><?php echo $row['hot']?></span>
                            </a>
                        <?php
                        }
                    ?>
                 </ul>
            </div>
        </div>
</div>
<script>
    $('.content').find('ul').hide().fadeIn(1500);
    $('.contentRight').find('.ul-bookflow').hide().slideDown(1000);
  </script>
