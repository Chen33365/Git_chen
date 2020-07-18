
    // 网站导航栏状态的变化
    (function(){
        $('.blankHead')
        .find('.nav')
            .find('ul')
                .find('li').on('click', function(){
                    sessionStorage.setItem('index', $(this).index('li'));
                });

        if(sessionStorage.getItem == null){
            $('.blankHead')
            .find('.nav')
                .find('ul')
                    .find('li').eq(0).addClass('active');
        }else{
            $('.blankHead')
            .find('.nav')
                .find('ul')
                    .find('li').eq(sessionStorage.getItem('index')).addClass('active')
        }
    }());


    (function(){
        $('body').css({width:window.innerWidth-20,backgroundColor:'#F0F0F0'})
    }());

    // 登录框
    (function(){
        $loginModal = $('.modal');
        $('.blankHead')
            .find('.nav')
                .find('.login-area')
                    .on('click',function(){
                        $loginModal.show();
                    });
        $loginModal.find('.close').on('click',function(){
            $loginModal.hide();      
        });
    
    }());

    (function(){
        $('.nav').find('.login').find('.loginName').on('mouseover',function(){
            $('.loginShow').slideDown();
        })
        var timer = null;
        $('.nav').find('.login').find('.loginShow').on('mouseout',function(e){
            // var e = e || window.event;
            $(this).on('mousemove',function(){
                clearInterval(timer);
                timer = setTimeout(function(){
                    $('.loginShow').slideUp();   
                },1500)
            })
        })
    }());

    // 排行一二三给予不同的颜色值
    (function(){
        $(".ul-bookflow")
            .find('a').eq(0)
                .find('.flow-number')
                    .css({backgroundColor:'rgb(245, 69, 69)'})
                        .parent()
                            .next()
                                .find('.flow-number')
                                    .css({backgroundColor:'rgb(255, 133, 71)'})
                                        .parent()
                                            .next()   
                                                .find('.flow-number')
                                                    .css({backgroundColor:'rgb(255, 172, 56)'});
    }());

    // 回车自动搜索
    (function(){
        if($('.modal').css('display') == 'none'){
            document.onkeydown = function(e){
                if(e.which == 13){
                    $('.search').find('.searchBtn').find('a').click();
                }
            }
        }
    }());