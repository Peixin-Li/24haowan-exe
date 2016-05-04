	<link rel="stylesheet" type="text/css" href="http://24haowan-cdn.shanyougame.com/BreakSquare/main.css">
	<div id="start_menu">
		<div class="start_btn"></div>
		<div class="rank_btn"></div>
	</div>
	<div class="pause_div">
		<div class="text">关注24好玩，每天一款精品小游戏</div>
		<div class="qrcode"></div>
		<div class="exit"></div>
		<div class="goon"></div>
	</div>
	<div class="mask"></div>
	<div class="pause_btn"></div>
	<div id="game_div"></div>

	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/phaser.min.js"></script>
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/BreakSquare/main.js" defer="defer"></script>
	<script type="text/javascript">
	window.onload = function() {
		$('.pause_btn').on('click',function(){
			game.paused = true;
			$('.pause_div').show();
			$('.mask').show();
		});

		$('.pause_div .exit').on('click',function(){
			$('.pause_div').hide();
			$('.mask').hide();
			game.state.start('play');
			game.paused = false;
		});

		$('.pause_div .goon').on('click',function(){
			game.paused = false;
			$('.pause_div').hide();
			$('.mask').hide();
		});
		$('#start_menu .start_btn').on('click',function(){
			game.state.start('play');
			hiddenLabel();
		});
		$('#start_menu .rank_btn').on('click',function(){
			showRankBox();
		});

		$("#over_box .over-btn-replay").on("click", function() {
			game.state.start("play");
			$('#over_box').hide();
			$('#over_box .over-btn-container').hide();
		});
		$("#over_box .over-btn-more").on("click", function() {
			location.href = "http://24haowan.shanyougame.com/main/subject";
		});
		$("#over_box .over-btn-rank").on("click", function() {
			showRankBox();
		});

		$("#over_box .score").css("font-size", "14px").css("right", "10%").css("top", "18%");
		$("#over_box .best").css("font-size", "14px").css("right", "10%").css("top", "38%");
	}
	</script>
