
<style>
	.body {overflow: hidden; background: #222; color:#cccccc; margin: 0px; padding: 0px; border: 0px; } 
	#game_div {image-rendering: optimizeSpeed; -webkit-interpolation-mode: nearest-neighbor; margin: 0px; padding: 0px; border: 0px; }
	:-webkit-full-screen #game_div {width: 100%; height: 100%; }
	.change {
		position: absolute;
		top: 40%;
		background:url(http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/mobile/selectPeople/select_background.png) no-repeat center center;
		background-size: contain;
		color:#fff;
		height: 220px;
		text-align: center;
		display: none;
		left: 50%;
		-webkit-transform: translateX(-50%) translateY(-50%);
		transform: translateX(-50%) translateY(-50%);
		z-index: 90;
		max-width: 300px;
	}
	.change ol {
		list-style-type: none;
		padding: 0;
		margin: 46px 0 0 0;

	}
	.change li {
		display: inline-block;
		width: 30%;
		height: 55px;
	}
	.change li img {
		width: 20px;
		height: 20px;
	}
	.change .on img{
		outline :3px solid #fff100;
		box-shadow: 2px 1px 1px 4px #b15933;
	}
	.change .close_btn {
		position: absolute;
		width: 26px;
		height: 26px;
		background:url(http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/mobile/selectPeople/close.png) no-repeat center center;
		background-size: cover;
		right: 10px;
	}
	.change .select {
		position: absolute;
		bottom: 30px;
		left: 50%;
		-webkit-transform: translateX(-50%);
		transform: translateX(-50%);
		width: 60px;
		height: 30px;
	    background:url(http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/mobile/selectPeople/selectPeople_btn.png) no-repeat center center;
	    background-size: cover;
	}
	.select_bg {
		z-index: 80;
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		background-color: #000;
		opacity: .8;
		display: none;
	}

	#game_div {
		z-index: 70;
	}
</style>
<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/CubeAdventure/phaser.min.js"></script>
<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/CubeAdventure/main.js"></script>
</head>

<body class="body">
<div class="select_bg"></div>
<div id="wrapper">
	<div id="game_div" style="position: absolute;"></div>
</div>
<div class="change">
	<span class="close_btn"></span>
	<ol></ol>
	<span class="select"></span>
</div>



  <script type="text/javascript">
  function addTextbyTop(text) {
  	$('.top-text').text(text);
  }
  addTextbyTop('关注微信公众帐号，即可解锁方块猫咪');
  	$('.btn1').on('click',function(){
  		//继续游戏
  		$('#pauseButton').hide();
  		$('.select_bg').hide();
  		game.paused = false;
  	});
  	$('.btn2').on('click',function(){
  		//游戏结束
  		$('#pauseButton').hide();
  		$('.select_bg').hide();
  		game.paused = false;
  		gameStep++;
        gameState = "GameOver";
  		GameRunningScene.next();
  	});
  	
  	
  	$('.change .close_btn').on('click', function(){
  		$('.change').hide();
        $('.select_bg').hide();
  	});
  </script>
</body>
</html>
