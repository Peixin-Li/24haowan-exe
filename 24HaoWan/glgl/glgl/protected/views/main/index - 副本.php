<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <title>丸子の世界</title>
    <!--<link rel="stylesheet" href="app.css" type="text/css" />-->
	<script type="text/javascript" src="/js/game.min.js"></script>
	<script type="text/javascript" src='./sg/softgames-1.1.js'></script>
    <script type="text/javascript" src='./sg/sg.hooks.js'></script>
	 <!--Analytics-->
<style>
BODY, HTML 
{
    -webkit-tap-highlight-color: rgba(0,0,0,0); 
    -webkit-touch-callout: none;                
    -webkit-text-size-adjust: none;             
    -webkit-user-select: none;                  
	margin: 			0;
	padding: 			0;
	font-family: 		Arial, Verdana, sans-serif;
	font-size: 			12px;
	font-weight:		normal;
	color: 				#ccc;
	background-color:	#4aa4c2;
}

.loader {
	width: 100%;
	height: 100px;
	position: absolute;
	text-align:center;
	margin-top: 250px;
    display: block !important;
}
</style>
</head>
<body style="position:absolute" onLoad="alk();">
    <div id="viewporter" style="position: absolute; top: 0px; left: 0px;">
        <canvas id="canvas" width="700" height="900"></canvas>
        <div id="loader"></div>
    </div>
    <script type="text/javascript">
    	var game_id = <?php echo empty($game_id)?"":$game_id ?>;
    	var openid = '<?php echo empty($openid)?"":$openid ?>';
    	// alert('<?php echo empty($name)?"123":$name ?>');
    </script>
    <script type="text/javascript" src = "http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
	    ['click','touchstart'].map(function(value){
		    document.getElementById('viewporter').addEventListener(value,function(){
				SoundManager.g_instance.init();
	            SoundManager.g_instance.playMusic();
		    });
	    });

      wx.config({
	    debug: false,
	    appId: '<?php echo $signPackage["appId"];?>',
	    timestamp: <?php echo $signPackage["timestamp"];?>,
	    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
	    signature: '<?php echo $signPackage["signature"];?>',
	    jsApiList: [
	      // 所有要调用的 API 都要加到这个列表中
	      'onMenuShareTimeline','onMenuShareAppMessage'
	    ]
	  });
	  wx.ready(function () {
	    // 在这里调用 API
	    //分享朋友圈
	    wx.onMenuShareTimeline({
		    title: '天哪，饿死宝宝了', // 分享标题
		    desc: '最好吃的小丸子', // 分享描述

		    link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxef721b05e2002815&redirect_uri=http%3A%2F%2Fglgl-dev.shanyougame.com%2F&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect', // 分享链接
		    imgUrl: 'http://glgl-dev.shanyougame.com/assets/art/cake_4.png', // 分享图标
		    success: function () { 
		       // 用户确认分享后执行的回调函数
		       var data = "openid="+openid+"&type=cfriend";
		       var url = "http://glgl-dev.shanyougame.com/ajax/commitShare";
		       var xhr = new XMLHttpRequest();
			   xhr.open('post',url,true);
			   //that's ok
			   xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			   xhr.onreadystatechange = function() {
			       if(xhr.readyState == 4) {
			           if(xhr.status == 200) {
			               // alert('1'+xhr.responseText);
			           } else {
			               // alert('2'+xhr.status);
			           }
			       }
			   }
			   xhr.send(data);
		    },
		    cancel: function () { 
		        // 用户取消分享后执行的回调函数
		    }
		});
	    
	    //分享朋友
		wx.onMenuShareAppMessage({
		    title: '天哪，饿死宝宝了', // 分享标题
		    desc: '啦啦啦，一起消灭丸子吧', // 分享描述
		    link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxef721b05e2002815&redirect_uri=http%3A%2F%2Fglgl-dev.shanyougame.com%2F&response_type=code&scope=snsapi_userinfo&state=STATE&connect_redirect=1#wechat_redirect', // 分享链接
		    imgUrl: 'http://glgl-dev.shanyougame.com/assets/art/cake_4.png', // 分享图标
		    type: 'link', // 分享类型,music、video或link，不填默认为link
		    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		    success: function () {
		        // 用户确认分享后执行的回调函数
		       var data = "openid="+openid+"&type=friend";
		       var url = "http://glgl-dev.shanyougame.com/ajax/commitShare";
		       var xhr = new XMLHttpRequest();
			   xhr.open('post',url,true);
			   //that's ok
			   xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			   xhr.onreadystatechange = function() {
			       if(xhr.readyState == 4) {
			           if(xhr.status == 200) {
			               // alert('1'+xhr.responseText);
			           } else {
			               // alert('2'+xhr.status);
			           }
			       }
			   }
			   xhr.send(data);
		    },
		    cancel: function () { 
		        // 用户取消分享后执行的回调函数
		    }
		});
	  });

    </script>
</body>
</html>