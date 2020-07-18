<?php
include_once("php/functions/is_login.php");
if (!session_id()){//这里使用session_id()判断是否已经开启了Session
	session_start();
}
?>
<link rel="stylesheet" href="./css/home_page.css" />
<link rel="stylesheet" href="./js/swiper/swiper.min.css" />
<link rel="stylesheet" href="http://at.alicdn.com/t/font_1877085_eunub7id5lc.css">

<style>
  .swiper-container {
    width: 1300px;
    height: 180px !important;
    padding-top: 50px;
    padding-bottom: 50px;
    overflow: hidden !important;
  }

  .swiper-slide {
    height: 200px !important;
    width: 210px !important;
    background-size: 100% 100% !important;
    background-position: center;
    background-size: cover;
    width: 300px;
    height: 300px;
  }
</style>
  <!-- 轮播图区域 -->
  <div class="home">
  <div class="recom">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image: url(./img/book/book1.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book2.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book3.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book4.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book5.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book6.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book15.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book8.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book9.jpg);"></div>
        <div class="swiper-slide" style="background-image: url(./img/book/book10.jpg);"></div>
      </div>
      <!-- Add Pagination -->
      <div class="swiper-pagination"></div>
    </div>
  </div>

  <!-- 内容区域 -->
  <div class="content contain">
    <div class="leftCon fl">
      <h2>热销图书</h2>
      <span class="icon iconfont icon-huo" style="font-size: 55px; color:red;"></span>
    </div>
    <div class="rightCon fr">
      <div class="bookList">
        <ul class="ul-bookList">
          <?php
            include_once("infoArr.php");
            $i = 0;
            while ($row = mysql_fetch_array($bookResult)) {
              $i++;
              if($i == 7){
                break;
              }
          ?>
            <li>
              <a href="index.php?url=./php/book_detail.php&news_id=<?php echo $row['book_id']?>">
              <img src="<?php echo './img/book/'.$row['img']?>" alt="" />
              <p class="dec"><?php echo $row['title']?></p>
              <p class="uname"><?php echo $row['author']?></p>
              </a>
            </li>
          <?php
            }
          ?>
        </ul>
      </div>
      <div class="bookflow">
        <h2>畅销榜</h2>
        <ul class="ul-bookflow">
          <?php
          include_once("infoArr.php");
          $i = 0;
          while ($row = mysql_fetch_array($bookResult)) {
            $i++;
            if($i == 8){
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
  <script src="./js/swiper/swiper.min.js"></script>
  <script>
    (function() {
      var swiper = new Swiper(".swiper-container", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        autoplay: {
          delay: 450,
          stopOnLastSlide: false,
          disableOnInteraction: false,
        },
        slidesPerView: "auto",
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },
        pagination: {
          el: ".swiper-pagination",
        },
      });
    })();
    $('.rightCon').find('.ul-bookList').hide().fadeIn(1500);
    $('.bookflow').find('.ul-bookflow').hide().slideDown(1000);
  </script>