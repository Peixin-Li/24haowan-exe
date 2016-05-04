<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>过往专题</title>
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/oldmain.css">
</head>
<body>
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
	<script type="text/javascript" src = "http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		$(function() {
			var subject_info = JSON.parse('<?php echo empty($subject_list)?"":$subject_list ?>');
			addAbstract(subject_info);
			function addAbstract(game) {
				var str = '';
				for(var i=0,len=game.length;i<len;i++) {
					var obj = game[i];
					str += '<a href="/main/SubjectInfo/subject_id/' + obj['subject_id'] + '"><section class="played-game" style="background:url(' + obj['img'] + ') no-repeat center center;background-size:cover;">';
					str += '<div class="bg"></div>';
					str += '<div class="data-box">';
					str += '<span class="title">' + obj['subject_name'] + '</span>';
					str += '<span class="date">' + obj['start_time'] + '</span>';
					str += '</div></section></a>';
				}
				str += '<h4 style="text-align:center;color:#999;font-size:16px;padding:12px">更多专题准备中</h4>';
				$('body').append(str);
			}
		});

	</script>
</body>
</html>