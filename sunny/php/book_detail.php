<?php
include_once("php/functions/is_login.php");

include_once("infoArr.php");
if (!session_id()){//这里使用session_id()判断是否已经开启了Session
	session_start();
}

$num = $_GET["news_id"];
while($row = mysql_fetch_array($bookResult)){
    if($num == $row["book_id"]){
        $u = $row;
    }
}
$sql = '';
$load = 0;
if(!isset( $_SESSION['user_id'])){
$load = 3;
}
while($read = mysql_fetch_array($readArrResult)){
    if(isset( $_SESSION['user_id'] ) && $_SESSION['user_id'] == $read['user'] && $num == $read['book_id']){
        $load = 1;
    }
}
?>
<link rel="stylesheet" href="./css/book_detail.css">
<link rel="stylesheet" href="http://at.alicdn.com/t/font_1873951_ghxq7ra28bk.css">
<div class="top-book_detail">
<div class="content contain">
    <div class="head">
        <div class="leftHead">
            <img src="<?php echo './img/book/'. $u['img'] .''?>" />
        </div>
        <div class="rightHead">
            <h1 class="title"><?php echo $u['title']?></h1>
            <p class="author">
                作者：<span><?php echo $u['author']?></span>&nbsp;&nbsp;&nbsp;
                字数：<span><?php echo $u['word']?></span>
            </p>
            <p class="money">
                价格：免费
            </p>

            <p class="read"><a href="<?php echo $u['url']?>">开始阅读</a></p>
            <a class="love" href="index.php?url=./php/add_love.php&new_id=<?php echo $num;?>&load=<?php echo $load;?>">
                <img class="love" src="<?php echo $load == 1 ?  './img/love1.jfif':'./img/love2.jpg';?>" title="点击收藏">
            </a>
            <p>详情介绍:</p>
            <div class="details">
                <?php echo $u['details']?>
            </div></br>
            <div class="like">为这本书点个赞吧&nbsp;&nbsp;<a href="index.php?url=./php/add_like.php&new_id=<?php echo $num;?>"><span class="icon iconfont icon-dianzan1"></span></a></div>
        </div>
    </div>
</div>
</div>
<script>
    $('.content').find('.head').find('.love').on('click',function(){
        if( $(this).attr('src')== './img/love2.jpg'){
            $(this).attr('src','./img/love1.jfif');
        }else if( $(this).attr('src')== './img/love1.jfif'){
            $(this).attr('src','./img/love2.jpg');
        }
    });

    $(".head .rightHead").find('.like').find('span').on('click',function(){
        if($(this).hasClass('icon-dianzan1')){
            $(this).removeClass('icon-dianzan1').addClass('icon-dianzan');
        }else{
            $(this).removeClass('icon-dianzan').addClass('icon-dianzan1');
        }
    })

</script>