	<style>
		*{
			margin: 0;
			padding: 0;
		}
		.game_rank_btn {
			background: url(http://24haowan-cdn.shanyougame.com/weightlifting/image/rank_btn.png) no-repeat center center;
			background-size: cover;
			width: 120px;
			height: 50px;
			position: absolute;
			bottom: 90px;
			left: 50%;
			-webkit-transform: translateX(-50%);
			        transform: translateX(-50%);
			display: none;
		}
		.stop_music_btn,.start_music_btn {
			background: url(http://24haowan-cdn.shanyougame.com/weightlifting/image/stopMusic.png) no-repeat center center;
			background-size: cover;
			width: 50px;
			height: 50px; 
			position: absolute;
			top: 12px;
			right: 12px;
			display: none;
		}
		.start_music_btn {
			background: url(http://24haowan-cdn.shanyougame.com/weightlifting/image/startMusic.png) no-repeat center center;
			background-size: cover;
		}
		@media only screen and (min-device-width : 700px) and (max-device-width : 1024px) {
			.game_rank_btn {
				width: 160px;
				height: 70px;
			}
			.stop_music_btn,.start_music_btn {
				width: 80px;
				height: 80px;
			}
		}
	</style>
</head>
<body>
	<div id="game_div"></div>
	<div class="game_rank_btn"></div>
	<div class="stop_music_btn"></div>
	<div class="start_music_btn"></div>
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/phaser.min.js"></script>
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/weightlifting/main.js" defer="defer"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript">
		$(function(){
			var img = new Image();
			img.src = 'http://24haowan-cdn.shanyougame.com/weightlifting/image/startMusic.png';
			$('.game_rank_btn').on('click',function(){
				//排行榜
				showRankBox();
			});
			$("#over_box .over-btn-replay").on("click", function() {
				$('#over_box').hide();
				$('#over_box .over-btn-container').hide();
				game.state.start("play");
				game.paused = false;
			});
			$("#over_box .over-btn-more").on("click", function() {
				location.href = "http://24haowan.shanyougame.com/main/subject";
			});
			$("#over_box .over-btn-rank").on("click", function() {
				showRankBox();
			});
		});
	</script>
</body>
</html>