<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title></title>
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/main.css">
</head>
<body>
	
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
	<script type="text/javascript" src = "http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		$(function(){
			//游戏列表界面
			var subject_info = JSON.parse('<?php echo empty($subject_info)?"":$subject_info ?>');
			var game_info_list = JSON.parse('<?php echo empty($game_list)?"":$game_list ?>');
			var game_wait_list = JSON.parse('<?php echo empty($game_wait_list)?"":$game_wait_list ?>');
			$('title').text(subject_info['subject_name']);
			addGameCanPlay(game_info_list);
			addGameWait(game_wait_list);
			//添加游戏列表
			function addGameCanPlay(game) {
				var str = '';
				for(var i=0,len=game.length;i<len;i++) {
					var obj = game[i];
					str += '<a href="' + obj['game_url'] + '"><section class="game-list" style="background:url(' + obj['img'] + ') no-repeat center center;background-size:cover">';
					if(obj['persent']) {
						str += '<span class="win">打败了' + obj['persent'] + '%的人</span>';
					}
					str += '<div class="bg"></div>';
					str += '<span class="title">' + obj['game_name'] + '<span class="date">' + obj['start_time'] + '</span></span>';
					str += '<div class="data-box">';
					str += '<span class="popular">' + obj['quantity'] + '人玩过</span>';
					
					str += '<span class="star"><ul>'
					for(var j=0,k=obj['star'].split('').length;j<k;j++) {
						str += '<li style="background:url(http://24haowan-cdn.shanyougame.com/platform/images/star.png) left top;background-size:cover;"></li>';
					}
					for(var j=0,k=5-k;j<k;j++) {
						str += '<li style="background:url(http://24haowan-cdn.shanyougame.com/platform/images/star.png) 60px top;background-size:cover;">';
					}
					str += '</ul></span>';
					str += '</div></section></a>';
				}
				str += '<h4 style="text-align:center;color:#999;font-size:16px;padding:12px">更多游戏准备中</h4>';
				$('body').append(str);
			}
			//添加等待游戏列表
			function addGameWait(game) {
				var str = '';
				for(var i=0,len=game.length;i<len;i++) {
					var obj = game[i];
					str += '<section class="game-list" style="background:url(http://24haowan-cdn.shanyougame.com/platform/images/wait.png) no-repeat center center;background-size:cover">'
					str += '<span class="date">' + obj['start_time'] + '</span>';
					str += '</section>';
				}
				$('body').append(str);
			}
		});
	</script>
</body>
</html>