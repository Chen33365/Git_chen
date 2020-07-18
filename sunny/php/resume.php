<?php
include_once("php/functions/is_login.php");
include_once("php/infoArr.php");
if (!session_id()){//这里使用session_id()判断是否已经开启了Session
	session_start();
}
?>
<link rel="stylesheet" href="./css/resume.css">
<div class="resume">
	<div class="head contain">
		<h1>我的书单---><img src="./img/love1.jfif"/><span>我喜欢</span></h1>
		<div class="content"> 
		<ul>
                    <?php
                        while ($row = mysql_fetch_array($readArrResult)) {
                            if($_SESSION['user_id'] == $row['user']){
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
                    }
                    ?>
            </ul>
		</div>
		
	</div>
</div>