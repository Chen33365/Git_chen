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
$page_size = 9;
if (isset($_GET["page_current"])) {
    $page_current = $_GET["page_current"];
} else {
    $page_current = 1;
}
$start = ($page_current - 1) * $page_size;
$result_sql = "select * from bookList order by book_id desc limit $start,$page_size";
// if(isset($_GET["keyword"])){
//     $keyword = $_GET["keyword"];
//     //构造模糊查询新闻的SQL语句
//     $result_sql = "select * from news where title like '%$keyword%' or content like '%$keyword%' order by news_id desc limit $start,$page_size";
// }
if (isset($_GET["class"])) {
    $class = $_GET["class"];
    if ($class == '全部') {
        $result_sql = "select * from bookList order by book_id desc limit $start,$page_size";
    } else {
        //构造模糊查询新闻的SQL语句
        $result_sql = "select * from bookList where class = '$class' order by book_id desc limit $start,$page_size";
    }
}
$result_set = mysql_query($result_sql);
close_connection();

?>


<link rel="stylesheet" href="./css/subtotal.css">
<div class="sub-content">
<div class="content contain">
    <div class="sort">
        <div class="book-type">类型</div>
        <ul class="title">
            <li><a href="index.php?url=./php/subtotal.php&class=全部">全部</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=爱情">爱情</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=小说">小说</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=青春">青春</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=文学">文学</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=传记">传记</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=励志">励志</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=历史">历史</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=社科">社科</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=心理">心理</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=经济">经济</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=管理">管理</a></li>
            <li><a href="index.php?url=./php/subtotal.php&class=推理悬疑">推理悬疑</a></li>
        </ul>
    </div>
    <div class="show">
        <div class="sortting">
            <div class="news">最新</div>
            <div class="last-page">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="show-content">
            <ul class="clearfix">
                <!-- <li>
                    <img src="./img/book1.jpg" class="fl">
                    <div class="text-right fl" >
                        <p class="bookname">齐天大圣</p>
                        <p class="uname">禾维</p>
                        <p class="hot">2333</p>
                        <p class="textword">谁安排了大闹天宫？谁操纵了唐僧西游？五百年重压藏猫腻，八十一难</p>
                    </div>
                </li> -->
                <?php
                include_once("infoArr.php");

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
        </div>
        <?php
        $url = $_SERVER["PHP_SELF"] . "?url=./php/subtotal.php";
        page($total_records, $page_size, $page_current, $url, $keyword);
        ?>
    </div>
</div>
</div>
<script>
    $('.show-content').hide().fadeIn(1000);

    $(function(){

        function getQueryVariable(variable){
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                    var pair = vars[i].split("=");
                    if(pair[0] == variable){return pair[1];}
            }
            return(false);
        }

        $(".sort .title").find("li").each(function(index, ele){         
            if(encodeURIComponent( $(".sort .title").find("li").eq(index).find("a").text()) == getQueryVariable("class")){
                $(".sort .title").find("li").eq(index).css({color:"#fff",backgroundColor: "#9E9E9E"});  
                console.log(12);       
            }
        })
    })
    
</script>