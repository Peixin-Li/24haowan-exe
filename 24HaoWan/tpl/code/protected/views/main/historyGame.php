<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>玩过的游戏</title>
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/played.css">
</head>
<body>
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
	<script type="text/javascript" src = "http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		$(function() {
			var game_list = JSON.parse('<?php echo empty($game_list)?"":$game_list ?>');
			addGameList(game_list);
			function addGameList(game) {
				var str = '';
				for(var i=0,len=game.length;i<len;i++) {
					var obj = game[i];
					//偶数则上色，0开始
					var bgColor = i%2?"":"section-odd";
					str += '<a href="' + obj['game_url'] + '"><section class="played-game ' + bgColor + '">';
					str += '<div class="leftbox">';
					str += '<p><img src="' + obj['share_img'] + '" />';
					str += '<span>人气：' + obj['quantity'] + '</span></p></div>';
					str += '<div class="rightbox">';
					str += '<h1 class="title">' + obj['game_name'] + '</h1>';
					str += '<h3 class="max-score">最高得分：' + obj['score'] + '</h3>';
					str += '<h3 class="civil">排名：' + obj['rank'] + '</h3>';
					str += '<span class="badge">';
					if(obj['badge'] != 0) {
						str += '<img src="http://24haowan-cdn.shanyougame.com/platform/images/badge_' + obj['badge'] + '.png">';
					}
					str +='</span></div></section>';
				}
				$('body').append(str);
			}
		});

	</script>
</body>
</html>