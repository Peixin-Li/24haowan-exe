<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0041)http://ldzw.vxinyou.com/zt/game_features/ -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <title>24好玩</title>
    <style type="text/css">
        html{font-size:312.5%;}
        html,body{padding:0; margin: 0; height: 100%; background: #ededed;}
        div{padding: 0; margin: 0;}
        #main{
            height: 100%;
        }
        .weixin{
            height: 100%;;
            background-size: 100% auto;
            min-height: 8.7rem;
        }
        .refer{
            height: 100%;
            min-height: 8.7rem;
            background-repeat: no-repeat;
            background-position: center top;
            background-size: 100% 100%;
        }
        .ios .refer{
            background-image: url(http://24haowan-cdn.shanyougame.com/public/img/ios-1.png);
        }
        .android .refer{
            background-image: url(http://24haowan-cdn.shanyougame.com/public/img/android-1.png);
        }
        .hidden{
            display: none;
        }
    </style>
</head>
<body>
    <div id="main">
        <div id="notice-div">
            <div class="refer" style="line-height: 400%;text-align: center;" >
                <img src="http://24haowan-cdn.shanyougame.com/public/img/waiting.gif" style="padding-top: 40%;">
            </div>
        </div>
        <div id="weixin_show" class="hidden">
            <div class="refer">
            </div>
        </div>
    </div>
</body>

<script type="text/javascript"> 
    var share_url = '<?php echo empty($url)? "": $url ?>';
    var share_a_url = '<?php echo empty($a_url)? "": $a_url ?>';
    document.getElementsByTagName("html")[0].style.fontSize=document.body.clientWidth/375*312.5+"%";
    function orientation(event){
        var st=setTimeout(function(){
            document.getElementsByTagName("html")[0].style.fontSize=document.body.clientWidth/375*312.5+"%";
        },300)
        
    }
    window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function(e){      
        orientation(e);
    }, false);

    var browser={ 
        versions:function(){ 
            var u = navigator.userAgent, app = navigator.appVersion; 
            return { //移动终端浏览器版本信息 
                trident: u.indexOf('Trident') > -1, //IE内核 
                presto: u.indexOf('Presto') > -1, //opera内核 
                webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核 
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核 
                mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端 
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端 
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器 
                iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器 
                iPad: u.indexOf('iPad') > -1, //是否iPad 
                webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部 
            }; 
        }(), 
        language:(navigator.browserLanguage || navigator.language).toLowerCase(),
    }
    function isWeiXin(){
        var ua = window.navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            return true;
        }else{
            return false;
        }
    }

    // if(true) {
    //     if( false ) {
    if(isWeiXin()) {
        if( browser.versions.iPhone || browser.versions.iPad ) {
            var div = document.getElementById('weixin_show');
            var notice_div = document.getElementById('notice-div');
            div.className = 'weixin ios';
            notice_div.className = 'hidden';
        }else{
            var div = document.getElementById('weixin_show');
            var notice_div = document.getElementById('notice-div');

            div.className = 'weixin android';
            notice_div.className = 'hidden';
        }
    }
    else if( (share_url!="") && (browser.versions.iPhone || browser.versions.iPad) ){
        window.location.href = share_url;
    }
    else if(share_a_url!=""){
        window.location.href = share_a_url;
    }
</script> 
</html>