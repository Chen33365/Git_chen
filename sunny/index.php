<?php
	include_once("php/functions/is_login.php");
	if (!session_id()){//这里使用session_id()判断是否已经开启了Session
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>阳光书城</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="./css/reset.css" />
  <link rel="stylesheet" href="./css/index.css" />

  <script src="./js/jquery.js"></script>
  <style>
    .contain {
      width: 1200px;
      margin: 0 auto;
    }
    ul li{
      list-style: none;
    }
    .fl {
      float: left;
    }

    .fr {
      float: right;
    }

    .wrapper {
      width: 1510px;
      background-color: #F0F0F0;
    }
    .clearfix{
      display: inline-block;
      content: '';
      clear: both;
    }
  </style>
</head>

<body>
  <!-- 最上方导航 -->
    <div class="blankHead">
      <div class="nav contain">
        <div class="logo fl"><img src="./img/logo.jpg"/><span class="logoText">阳光书城欢迎你</span></div>
        <ul class="fr">
          <li><a href="index.php?url=./php/home_page.php">首页</a></li>
          <li><a href="index.php?url=./php/subtotal.php"">分类</a></li>
          <li><a href="index.php?url=./php/ranking-list.php">排行</a></li>
          <li><a href="index.php?url=./php/connect_us.php">联系我们</a></li>
          <li style="transform: none;">
            <div class="search">
                <input type="text" name="title" class="enter" value="<?php echo isset($_GET['title'])? $_GET['title']:'';?>"/>
                <div class="searchBtn">
                  <a class="iconfont">&#xe62a;</a>
                </div>
              <!-- <script>
                $('.searchBtn').find('a').on('click', function(){                  
                  $.ajax({
                    url:"index.php",
                    type:"POST",
                    data:{
                      // url:"index.php?url=./php/search.php&title=" + $('.search').find('input').val()
                    },
                    // dataType:'json',
                    success:function(mes){
                      console.log(`<?php
                            var_dump($_POST);
                          ?>`)
                    },
                    error:function(){
                      console.log("请求数据失败！");
                    }
                  })
                  window.location="index.php?url=./php/search.php&title=" + $('.search').find('input').val();
                });
              </script> -->
            </div>
          </li><img src="" alt="">
          <li style="border: none;transform: none;">
            <div class="login">
                <?php
                  include_once("./php/functions/is_login.php");
                  if(is_login()){
                    echo "<img src='./img/head_photo/". $_SESSION['imgSrc'] ."' class='loginImg'>";
                    echo "<div class='loginName'>". $_SESSION['name'] ."</div>";

                    echo "<div class='loginShow'><a class='loginContent' href='index.php?url=./php/resume.php'>个人中心</a>";
                    echo "<a class='loginOut' href='./php/functions/logout.php'>注销</a></div>";
                  }else{
                    echo "<div class='login-area'>登录</div>";
                  }
                ?>
            </div>
          </li>
          <li><a href="index.php?url=./php/admin.php" onclick="<?php
                if(!isset($_SESSION['user_id'])){
                    echo "alert('请登录以后再进行操作！');return false;";
                }elseif($_SESSION['user_id'] != 1){
                    echo "alert('你暂时没有权限访问此界面！');return false;";
                }       
              ?>">管理</a></li>
        </ul>
      </div>
    </div>
    <div class="Wrapper">
      <br>
      <?php
      if (isset($_GET["url"])) {
        $url = $_GET["url"];
      } else {
        $url = "./php/home_page.php";
      }
      include_once($url);
      ?>
    </div>
    <div class="footer">
      <p>本站所有小说为转载作品，所有章节及图片均由网友上传,转载至本站只是为了宣传本书让更多读者欣赏。</p>
      <p>版权投诉及建议：联系我们~</p>
    </div>
    </div>

      <!-- 登录框 -->
    <div class="modal">
        <div class="container">
            <div class="enroll">
                <h2>
                    <span>欢迎登录</span>
                </h2>
                <form action="./php/login_process.php" method="POST">
                  <div class="area">
                      <div class="item">
                          账号：<input type="text" name="name" placeholder="账号"><br/>
                      </div>
                      <div class="item">
                          密码：<input type="password" name="password" placeholder="密码(6~16个字符)">
                      </div>
                      <div class="item">
                          <input type="submit" class="fill" value="登录">
                      </div>
                  </div>
                </form>
                <div class="logon">
                    <a href="./php/register.php">没有账号，点击注册>></a>
                </div>
            </div>
            <div class="close">X</div>
        </div>
    </div>


  <script src="./js/index.js"></script>


  <script>
             $('.searchBtn').find('a').on('click', function(){                  
                  $.ajax({
                    url:"search_get.php",
                    type:"GET",
                    data:{
                      title:$('.search').find('input').val()
                    },
                    success:function(mes){
                      console.log(mes);
                      
                      window.location="index.php?url=./php/search.php&title=" + mes;
                    },
                    error:function(){
                      console.log("请求数据失败！");
                    }
                  })
                });     
  </script>
</body>
</html>