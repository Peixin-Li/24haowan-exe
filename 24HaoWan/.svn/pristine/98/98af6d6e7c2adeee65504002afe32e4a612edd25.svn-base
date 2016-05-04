<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>看评论</title>
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/review.css">

</head>
<body>
	<div class="main">
		<a class="gameLink" href="/main/game/game_id/<?php echo $this->game_id ?>">
			<header class="head">
				<div class="leftbox">
					<img src="" alt="">
				</div>
				<div class="rightbox">
					<h1></h1>
					<h3 class="star"></h3>
					<h3 class="popular"></h3>
				</div>
			</header>
		</a>
		<div class="review">
			<h1>评论</h1>
			<ol></ol>
		</div>
	</div>

	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
	<script type="text/javascript" src = "http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		$(function() {
			var game_info = JSON.parse('<?php echo empty($game_info)?"":$game_info ?>');
			var comment_list = JSON.parse('<?php echo empty($comment_list)?"":$comment_list ?>');
			addHead(game_info);
			addComment(comment_list);
			//添加游戏信息
			function addHead(game) {
				$('.gameLink').attr('href','/main/game/game_id/' + game['game_id']);
				$('.leftbox img').attr('src',game['share_img']);
				$('.rightbox h1').text(game['name']);
				$('.star').text(game['star'] + '（' + game['comment_times'] + '）');
				$('.popular').text('人气：' + game['quantity']);
			}
			//添加评论列表
			function addComment(game) {
				var str = '';
				for(var i=0,len=game.length;i<len;i++) {
					var obj = game[i];
					 str += '<li><div class="review-list">';
					 str += '<div class="data">';
					 str += '<img src="' + obj['headimgurl'] + '">';
					 str += '<span class="people-name">' + obj['user_name'] + '</span>';
					 str += '<span class="star">' + obj['star'] + '</span>';
					 str += '<span class="date">' + obj['update_time'] + '</span></div>';
					 str += '<p class="review-content">' + obj['comment'] + '</p></div></li>';
				}
				$('.review ol').append(str);
			}
		});

	</script>
</body>
</html>