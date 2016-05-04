<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>写评论</title>
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/review.css">
</head>
<body>
	<div class="main">
		<a class="gameLink" href="">
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

		<div class="write-review">
			<div class="write-score">
				<ul class="write-star">
					<li>☆</li>
					<li>☆</li>
					<li>☆</li>
					<li>☆</li>
					<li>☆</li>
				</ul>
				<span class="text">给游戏打个分吧~</span>
			</div>
			<textarea name="write-content" id="write-content" rows="6" onfocus="if(value=='100字以内哟~亲'){v100字以内哟~亲alue=''}"  
    onblur="if (value ==''){value='100字以内哟~亲'}">100字以内哟~亲</textarea>
			<span class="submit-review">立即评论</span>

		</div>

	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
	<script type="text/javascript" src = "http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#write-content').focus(); //聚焦输入框
			var game_info = JSON.parse('<?php echo empty($game_info)?"":$game_info?>'); //游戏信息
			addHead(game_info); //添加游戏信息列表

			var comment_info = '<?php echo empty($comment_info)?"":$comment_info ?>'; //评论信息
			comment_info = comment_info?JSON.parse(comment_info):"";
			addCommentInfo(comment_info); //修改评论信息
			
			//绑定点击星星事件 [若需要更换星星样式，需修改]
			$('.write-star li').on('tap',function(){
				var index = $(this).index()+1;
				var dom = $('.write-star li');
				dom.text('☆');
				for(var i=0;i<index;i++) {
					dom.eq(i).text('★');
				}
			});


			function addCommentInfo(game) {
				if(game) {
					if(game['star'] != null) {
						$('ul').empty().append(game['star'].split('').map(function(v){return '<li>' + v + '</li>'}).join(''));
					}
					if(game['comment'] != null) {
						$('#write-content').val(game['comment']);
					}
				}
			}

			//添加头部
			function addHead(game) {
				$('.gameLink').attr('href','/main/game/game_id/' + game['game_id']);
				$('.leftbox img').attr('src',game['share_img']);
				$('.rightbox h1').text(game['name']);
				$('.star').text(game['star'] + '（' + game['comment_times'] + '）');
				$('.popular').text('人气：' + game['quantity']);
			}

			//提交评论
			$('.submit-review').on('tap',function() {
				//loading
				var obj = {};
				var domStar = $('.write-star li');
				var star = '';
				for(var i=0,len=domStar.length;i<len;i++) {
					domStar.eq(i).text() == '★'?star+='★':"";
				}
				if(star.indexOf('★') == -1) {
					alert('请点击星星评分哟~');
				} else {
					var textVal = $('#write-content').val().trim();
					if(textVal.length <= 100) {
						obj['star'] = star;
						obj['comment'] = $('#write-content').val().trim();
						obj['game_id'] = game_info['game_id'];
						console.log(obj);
						$.ajax({
							url: "/ajax/SendComment",
							data: obj,
							dataType: "json",
							type: "POST",
							success: function(data) {
								if(data['code'] == 0) {
									location.href = "/main/comment/game_id/"+game_info['game_id'];
								}
							},
							error: function(err) {
								alert('评论失败，请稍候再试');
								console.log('error:' + err);
							}
						});
					} else {
						alert('超过100字了哟~亲');
					}
				}
			});
		//end
		});
	</script>
</body>
</html>

