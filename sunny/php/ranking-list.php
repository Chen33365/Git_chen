<?php
include_once("php/functions/is_login.php");
if (!session_id()){//这里使用session_id()判断是否已经开启了Session
	session_start();
}
include_once("functions/database.php");
include_once("functions/page.php");
include_once("infoArr.php");
get_connection();
$total_records = mysql_num_rows($bookResult);
$keyword = "";
$page_size = 13;
if (isset($_GET["page_current"])) {
    $page_current = $_GET["page_current"];
} else {
    $page_current = 1;
}
$start = ($page_current - 1) * $page_size;
$result_sql = "select * from bookList order by booklist.hot  desc limit $start,$page_size";

$result_set = mysql_query($result_sql);
close_connection();

// 封装排行版第一到第三的序号颜色
function colorArr($i){
  if($i == 1){
    echo  'background: rgb(245, 69, 69)';
  }elseif($i == 2){
    echo 'background: rgb(255, 133, 71)';
  }elseif($i == 3){
    echo 'background: rgb(255, 172, 56)';
  }else{
    echo 'background: blueviolet';
  }
}
?>

<link rel="stylesheet" href="./css/ranking-list.css">
<div class="Box">
  <div class="poem">
        <p>读书不觉已春深</p>
        <p>一寸光阴一寸金</p>
    </div>
  <div class="hot-list">
        <div class="headSection clearfix">
          <span class="hot">排行榜</span>
        </div>
        <ul class="showSection">
          
        <?php
          $i = ($page_current - 1) * $page_size;
          while ($row = mysql_fetch_array($result_set)) {
            $i++;
        ?>
          <li class="clearfix">
            <a href="index.php?url=./php/book_detail.php&news_id=<?php echo $row['book_id']?>">
            <span class="number" style="<?php colorArr($i);?>"><?php echo $i;?></span>
            <span class="title"><?php echo $row['title'];?></span>
            <span class="mes"><?php echo $row['hot']?></span>
            </a>
          </li>
        <?php
          }
        ?>
        </ul>
        <?php
          $url = $_SERVER["PHP_SELF"] . "?url=./php/ranking-list.php";
          page($total_records, $page_size, $page_current, $url, $keyword);
          ?>
  </div>
</div>
<script>
    $('.hot-list').find('.showSection').hide(0).fadeIn(1500);

</script>
 