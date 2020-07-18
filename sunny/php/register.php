<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户注册</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="header">
        <div class="logo"><img src="../img/logo.jpg"></div>
    </div>

    <div class="ad"><h2>让阅读滋养心灵</h2></div>
    <div class="write"><h2>欢&nbsp;迎&nbsp;来&nbsp;到&nbsp;阳&nbsp;光&nbsp;书&nbsp;城</h2></div>
    
    <div class="area">
        <h2>
            <span>用户注册</span>
        </h2>
        
        <div class="item">
            <form class="item-area" action="./register_process.php" method="POST" enctype="multipart/form-data" name="my_f1" onsubmit="check(this)">
                <!-- 要将父布局的position设置为relative，父布局将无法包裹input -->
                <div class="picture" style="position: relative;">
                    <!--设置input的position为absolute，使其不按文档流排版，并设置其包裹整个布局 -->
                    <!-- 设置opactity为0，使input变透明 -->
                    <!-- 只接受jpg，gif和png格式 -->
                        <!-- <input id="upload-input" style="position: absolute; top: 0; bottom: 0; left: 0;right: 0; opacity: 0;" type="file" 
                       accept="image/gif, image/jpg, image/png" onchange="showImg(this)"/> -->
                    <!-- 自定义按钮效果 -->
                        <div class="photo">
                            <span style="font-size: 16px;">上传头像：</span>
                            <img id="preview" src="../img/head_photo/timg.jfif" alt="">
                                <button disabled>上传头像</button>
                                <input id="imgPicker" name="imgFile" type="file" accept="image/gif, image/jpg, image/png">
                        </div>
                </div>
    
                <div class="name">
                    <label>用户名:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="name" placeholder="用户名" id="userName" required="required">
                    
                </div>

                <div class="name">
                    <label for="password">密　码:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input id="password" type="password" name="password" placeholder="密码" required="required">
                </div>

                <div class="name">
                    <label for="repassword">确认密码: </label>
                    <input id="confirmPassword" type="password" name="confirmPassword" placeholder="请再次输入密码" required="required">
                    <div class="pwd-if"></div>
                </div>

                <div class="readme">
                    <label>
                        <input type="checkbox" id="checkboxBtn">
                        <span class="checkbox"></span>
                        <span>我已同意<a href="">《互联网用户使用协议》</a>
                            和<a href="">《用户隐私政策》</a>
                        </span>
                    </label>
                </div>
                <div class="name">
                    <input type="submit" value="注册" class="submitBtn">
                </div>
            </form>
           

            <div class="readme txt">
                <a target="blank" href="../index.php">注册成功，返回登录 --></a>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        document.querySelector('#imgPicker').addEventListener('change', function(){
        //当没选中图片时，清除预览
        if(this.files.length === 0){
            document.querySelector('#preview').src = '';
            return;
        }
        
        //实例化一个FileReader
        var reader = new FileReader();

        reader.onload = function (e) {
            //当reader加载时，把图片的内容赋值给
            document.querySelector('#preview').src = e.target.result;
        };

        //读取选中的图片，并转换成dataURL格式
        reader.readAsDataURL(this.files[0]);
        }, false);

        var userName = document.querySelector('#userName');
        var pwd = document.querySelector('#password');
        var pwdCon = document.querySelector('#confirmPassword');
        var pwdIf = document.querySelector('.pwd-if');


        // 判断两次密码要相同
        pwdCon.oninput = function(){
            if(pwd.value == ''){
                pwdIf.innerHTML = '请先填写第一次密码';
            }else if(pwdCon.value == pwd.value){
                pwdIf.innerHTML = '<span>√</span>输入正确！';
            }else{
                pwdIf.innerHTML = "<span>X</span>两次密码不一致";
            }
        }
        function check(form){
            var p1 = form.password;
            var checked = document.querySelector("#checkboxBtn");
            var p2 = form.confirmPassword;
            if (p1.value != p2.value) {
                p2.oninvalid();
                return false;
            }
            return true;
        }
        window.onload = function() {
            var p2 = document.forms["my_f1"].confirmPassword;
            p2.oninvalid = function() {
                this.setCustomValidity("密码不一致，请重新输入");
            }
        }
    </script>

</body>
</html>