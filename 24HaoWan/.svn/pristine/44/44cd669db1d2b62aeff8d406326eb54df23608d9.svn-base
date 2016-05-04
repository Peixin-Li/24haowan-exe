<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>寻找熊本部长</title>
    <script src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
    <script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/tourist/code.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://24haowan-cdn.shanyougame.com/tourist/main.css">
</head> 
<body>
	<div class="start-img">
		<span class="start-text">每24小时，一款精彩小游戏</span>
	</div>
	<div class="page_1"></div>
	<div class="page_2"></div>
	
	<div id="tip"><img src="http://24haowan-cdn.shanyougame.com/tourist/assets/tip.png" alt=""></div>

	<div class="page_3">
		<div id="game-div" class="game-div"></div><!-- 游戏界面 -->
		<div id="circle" class="circle"></div><!-- 圆圈 -->
		<div id="startButton" class="start-button"></div><!-- 开始按钮 -->
		<div id="pauseButton" class="pause-button"></div><!-- 暂停按钮 -->
		<div id="pause-div" class="pause-div">
			<div class="pause-container">
				<img id="pauseHead" class="pause-head" src="http://24haowan-cdn.shanyougame.com/tourist/assets/icon-bear.png" >
				<div class="pause-text-container">
					
				</div>
				<div class="pause-button-container">
					<div id="pauseReplay" class="replay-button"></div>
					<div id="pauseResume" class="resume-button"></div>
				</div>
			</div>
		</div><!-- 暂停界面 -->
		<div id="rotate-div" class="rotate-div">
			<div class="rotate-img"></div>
		</div><!-- 旋转提示 -->
	</div>

	<div id="bear-over-box">
		<div class="show-box">
			<img src="http://24haowan-cdn.shanyougame.com/tourist/assets/show-box.png" alt="surprise">
			<span class="play-again">
				<img src="http://24haowan-cdn.shanyougame.com/tourist/assets/play-again.png" alt="">
			</span>
			<span class="buy">
				<img src="http://24haowan-cdn.shanyougame.com/tourist/assets/buy.png" alt="">
			</span>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$('.page_1').on('swipeUp',function(){
		$('.page_1').animate({'height':0},800,'linear',function(){
			$('.page_1').hide();
		},0);
	});
	$('.page_2').on('swipeUp',function(){
		$('.page_2').animate({'height':0},800,'linear',function(){
			$('.page_2').hide();
		},0);
	});

	$('#bear-over-box .play-again').on('tap',function(){
		$('#bear-over-box').hide();
		gameReplay();
	});

	$('#bear-over-box .buy').on('tap',function(){
		location.href = 'http://www.yaochufa.com/package/20735';
	});

	$('body').on('touchmove', function (event) {
    	event.preventDefault();
	}); 
// (function () {
	

	// 屏幕数据
	var windowInnerWidth = window.innerWidth;
	var windowInnerHeight = window.innerHeight;
	var ratio = windowInnerWidth/windowInnerHeight;

	// 设备类型
	var device = (navigator.userAgent.indexOf("iPad") > -1) ? 'pad' : 'mobile';

	// 背景宽高比
	var bgRatio_mobile = 828/1344;
	var bgRatio_pad = 1408/2048;

	// pauseResource.forEach(function(key){
	// 	var img = new Image();
	// 	img.src = key['pic'];
	// });

	// 游戏状态
	var playing = false;
	var isInit = false;

	// 人群
	var persons;

	// 单身狗
	var single;

	// 计时器
	var timer;

	// 音频
	var audioWin;
	var audioBg;

	// 游戏顶部icon
	var iconDoge;
	var iconCountDown;
	var iconScore;
	var dogeText;
	var countDownText;
	var bestScore = 18;
	var bestScoreText;

	// 游戏数值
	var level = 1; // 难度级别
	var scale = 1.0; // 缩放级别
	var hatTag = false; // 戴帽子标记
	var countDown = 60; // 计时
	var score = 0; // 得分
	var offsetRange = 60; // 点击允许偏移范围
	// 单身狗位置
	var singleLocation = {
		x: 0,
		y: 0,
		offsetX: 0,
		offsetY: 0
	};
	// 单体体积
	var singleSize = {
		width: 120,
		height: 120
	};
	// 单身狗中心
	var singleCenter = {
		x: 0, 
		y: 0
	};
	// 情侣个数
	var personsNum = {
		x: 0,
		y: 0,
		total: 0
	};
	// 游戏界面画布
	var playground = {
		x: 0,
		y: 0,
		width: windowInnerWidth*2,
		height: windowInnerHeight*2
	};
	orientationChanged();
	// 初始化数据
	function reloadData() {
		// 屏幕数据
		windowInnerWidth = window.innerWidth;
		windowInnerHeight = window.innerHeight;
		ratio = windowInnerWidth/windowInnerHeight;

		// 画布
		playground.width = windowInnerWidth*2;
		playground.height = windowInnerHeight*2;
	}

	// 开始游戏
	function gameStart() {
		hiddenLabel();
		if (navigator.userAgent.indexOf("Android") < 0) audioWin.play();
		$("#startButton").css("-webkit-transform", "scale(0.9, 0.9)");
		setTimeout(function() {
			$("#startButton").css("-webkit-transform", "scale(1.0, 1.0)");
			setTimeout(function() {
				$("#startButton").css("display", "none");
				game.state.start('play');
				setTimeout(function() {
					playing = true;
				}, 100);
			}, 100);
		}, 100);
	}

	// 游戏结束
	function gameEnd() {
		timer.pause();

		playing = false;

		// 提交分数和奖牌
		// setScore(score, getBadge());
		$('#bear-over-box').show();
		// 设置最高分
		if (score > bestScore) {
			bestScore = score;
		}
	}

	// 暂停游戏
	function gamePause() {
		if (!timer.paused) {
			timer.pause();
			$("#pause-div").css("display", "-webkit-box");
			playing = false;
		}
	}

	// 继续游戏
	function gameResume() {
		if (timer.paused) {
			setTimeout(function() {
				playing = true;
			}, 100);
			$("#pause-div").css("display", "none");
			timer.resume();
		}
	}

	// 重玩游戏
	function gameReplay() {
		// 重置游戏数据
		gameReset();
		game.state.start('play');
		$("#pauseButton").css("display", "none");
		$("#pause-div").css("display", "none");
		setTimeout(function() {
			playing = true;
		}, 100);
	}

	// 游戏重置
	function gameReset() {
		// 重设数值
		level = 1;
		scale = 1.0;
		countDown = 60;
		hatTag = false;
		score = 0;
		countDownText.text = countDown;
		// dogeText.text = score;
		// 清空场景
		persons.destroy(true, true);
	}

	// 计算情侣个数
	function setPersonsNum() {
		personsNum.x = parseInt(Math.ceil(playground.width/singleSize.width/scale));
		personsNum.y = parseInt(Math.ceil(playground.height/singleSize.height/scale));
		personsNum.total = parseInt(personsNum.x * personsNum.y);
	}

	// 设置单身狗位置
	function setSingleLocation() {
		singleLocation.offsetX = parseInt(Math.random() * (personsNum.x-4))+2;
		singleLocation.offsetY = parseInt(Math.random() * (personsNum.y-4))+2;
	}

	// 平铺人群
	function fillStage() {
		var random_arr = getRandomArr();
		for (var j = 0; j < personsNum.y; j++) {
			for (var i = 0; i < personsNum.x; i++) {
				// 偏移值
				var offsetX = getRandomOffset(30, false);
				var offsetY = (j == 0) ? getRandomOffset(10, true) : offsetX;
				// 坐标
				var x = i * singleSize.width + offsetX - singleSize.width/3;
				var y = j * singleSize.height + offsetY;
				// 判断创建的是否为单身狗
				if (i == singleLocation.offsetX && j == singleLocation.offsetY) {
					// 是否戴帽子
					var random_face = hatTag ? 1 : 0;
					// 单身狗的坐标
					singleLocation.x = x * scale;
					singleLocation.y = y * scale;
					// 单身狗的中心
					singleCenter.x = (singleLocation.x + 150/2*scale);
					singleCenter.y = (singleLocation.y + 300/2*scale);
					// 创建单身狗
					single = persons.create(x, y, 'people', 'p1.png');
					// single.animations.add('found', [0, 1, 0, 1], 10, false);
				} else {
					// 随机抽取一个情侣
					if (random_arr.length == 0) random_arr = getRandomArr();
					var ramdom_index = Math.floor(Math.random()*random_arr.length);
					var random_face = random_arr[ramdom_index];
					random_arr.splice(ramdom_index, 1);
					// 如果是单身狗的下面一个情侣，移动到单身狗下面
					if (i == singleLocation.offsetX && j == singleLocation.offsetY+1) {
						var d = (device == "mobile") ? 80 : 120;
						x = singleLocation.x/scale + getRandomOffset(10, false);
						y = singleLocation.y/scale + d + getRandomOffset(5, true);
					}
					// 是否反转
					var flip = Math.random() > 0.5 ? 1 : -1;
					x = (flip == 1) ? x : (x+singleSize.width);
					// 创建情侣
					var person = persons.create(x, y, 'people', 'p'+random_face+'.png');
					person.scale.x = flip;
				}
			}
		}
		persons.scale.set(scale, scale);
	}

	// 获取情侣数组
	function getRandomArr() {
		var arr = [];
		for (var i = 0; i < 10; i++) {
			arr[i] = i+2;
		}

		return arr;
	}

	// 获取随机偏移值
	function getRandomOffset(offset, tag) {
		var x = Math.random()*offset;
		var y = Math.random() > 0.5 ? 1 : -1;
		var result = x * y;
		if (tag) {
			result = x;
		}
		return result;
	}

	// 重置人群
	function resetPersons() {
		persons.destroy(true, true);
		initPersons();
	}

	// 初始化人群
	function initPersons() {
		// 计算人群数量
		setPersonsNum();
		// 计算单身狗位置
		setSingleLocation();
		// 填充画布
		fillStage();
	}

	// 点击事件回调
	function onTap(pointer, doubleTap) {
		if (playing) {
			var x = pointer.x * 2;
			var y = pointer.y * 2;
			if (Math.abs(x-singleCenter.x) <= offsetRange && Math.abs(y-singleCenter.y) <= offsetRange) {
				scoreCallback();
			}
		}
	}

	// 得分回调
	function scoreCallback() {
		// 播放动画和声效
		// single.animations.play('found');
		if (navigator.userAgent.indexOf("Android") < 0) audioWin.play();
		// 显示分数
		score += 1;
		dogeText.text = score;
		if (score == 10) {
			dogeText.x -= 19;
		}
		// 级别提升
		levelUp();
		// 显示圆圈
		showCircle();
		// 得分以后跳动
		game.add.tween(dogeText).to( { width: dogeText.width*1.2, height:dogeText.height*1.2 }, 100, Phaser.Easing.Linear.None, true, 0, 0, true);
		// game.add.tween(iconDoge).to( { width: iconDoge.width*1.2, height:iconDoge.height*1.2 }, 100, Phaser.Easing.Linear.None, true, 0, 0, true);
		// 500毫秒以后到下一关
		setTimeout(function() {
			$("#circle").css("display", "none");
			resetPersons();
		}, 500);
	}

	// 显示圈圈
	function showCircle() {
		var circleSize = (device == "mobile") ? 50 : 50;
		var top = singleCenter.y/2 - circleSize;
		var left = singleCenter.x/2 - circleSize;
		$("#circle").css("top", top).css("left", left).css("display", "block");
	}

	// 等级提升
	function levelUp() {
		level++;
		if (level <= 2) { // 1-2
			scale = 1.0;
		} else if (level <= 4) { // 3-4
			scale = 0.9;
		} else if (level <= 6) { // 5-6
			scale = 0.8;
		} else if (level <= 8) { // 7-8
			scale = 0.75;
		} else if (level <= 9) { // 9
			scale = 0.7;
		} else if (level <= 10) { // 10
			scale = 0.65;
		} else if (level <= 11) { // 11
			scale = 0.6;
		} else if (level <= 23) { // 12-23
			scale = 0.6-0.22*(level-11)/12;
		} else { // 23以后
			scale = 0.38;
		}
		if (level >= 15) {
			hatTag = true;
		}
		console.log(scale);
	}

	// 计算奖牌
	function getBadge() {
		if (score < 8) {
			return 0;
		} else if (score < 17) {
			return 3;
		} else if (score < 21) {
			return 2;
		} else {
			return 1;
		}
	}
setGameScore_bear(score,0,resetShareText());

	//文案接口
	function resetShareText() {
	    var obj = {
	            share:"关注微信公众帐号，即可解锁方块猫咪",
	            default:"躲开尖刺，快看你能坚持多久！",
	            title:"眼力太好！DBI给我发了面试邀请",
	            desc:"",
	            imgUrl:"http://24haowan-cdn.shanyougame.com/tourist/assets/icon-bear.png",
	    };
	    return obj;
	}

	//提交分数
	function setGameScore_bear(score,badge,obj,level, update) {
		/*
			obj = {
				default:"",
				title:"{score}  {persent},  " //{score}替换成分数 {persent}替换成百分比
				desc:"描述",  无替换
				link:"",
				imgUrl:"",
			}
		*/
		level = level || null;
		obj = obj || {};
		
				var data = data['data'];
				//数据显示
				var str = '';
				//更新分数
				if(update != false) {  
					$('#over_box .score').text(score);
					$('#over_box .win').text(data['persent']);
					if(parseInt(score) == 0) {
						obj.title = obj.default;
					} else {
						obj.title = obj.title.replace('{score}',score).replace('{persent}',data['persent']);
						if(score<=5) {
							obj.title += ',感知能力是天生的辣~';
						} else if(score<=10) {
							obj.title += ',我的眼力和福尔摩斯有的一拼';
						} else {
							obj.title += ',FBI给我发了面试邀请';
						}
					}
					wxReady(obj);
				}
				var dataText = '';
				currentScore = score;
	}

	/*------------------------------------------------

	游戏的不同状态

	------------------------------------------------*/

	var game;

	// 初始化游戏
	function initGame() {
		isInit = true;

		// 创建游戏
		game = new Phaser.Game(playground.width, playground.height, Phaser.CANVAS, 'game-div');

		game.States = {};

		game.States.boot = function () {
			this.preload = function () {
				// 隐藏平台元素
				// hiddenLabel();
				// 设置重玩函数
				// setFunction(gameReplay);
				// 设置最高分数
				// bestScore = max_score;

				// 停止监听页面可见性事件
				game.stage.disableVisibilityChange = true;

				
				game.load.atlasJSONArray('text-load', 'http://24haowan-cdn.shanyougame.com/tourist/assets/'+device+'/text-load.png', 'http://24haowan-cdn.shanyougame.com/tourist/assets/'+device+'/text-load.json');

				// 设置画布大小
				$(game.canvas).css("width", windowInnerWidth);
				$(game.canvas).css("height", windowInnerHeight);

				// ipad处理
				if (device == "pad") {
					singleSize.width = 180;
					singleSize.height = 180;
					offsetRange = 90;
				}
			};
			this.create = function() {
				// 隐藏画面
				setTimeout(function() {
					hiddenImg();
				}, 1500);
				game.state.start('preload');
			};
		}

		game.States.preload = function () {
			this.preload = function () {
				// 添加开始图片
				// var pic_start = game.add.image(0, 0, 'pic-start');
				var pic_start = game.add.image(0, 0, 'text-load', 'pic-start.png');
				var ratio_temp = (device == "mobile") ? bgRatio_mobile : bgRatio_pad;
				if (ratio >= ratio_temp) {
					pic_start.width = playground.width;
					pic_start.height = playground.width/ratio_temp;
				} else {
					pic_start.width = playground.height*ratio_temp;
					pic_start.height = playground.height;
					pic_start.x = -(pic_start.width - playground.width)/2;
				}
				console.log(pic_start.width, pic_start.height);
				
				// 显示进度条
				var progress_fill, progress_empty;
				if (device == "mobile") {
					
					// progress_empty = game.add.sprite((playground.width-326)/2, (playground.height-70)/2+40, 'progress-empty');
					progress_empty = game.add.sprite((playground.width-326)/2, (playground.height-70)/2+40, 'text-load', 'progress-empty.png');
					progress_empty.width = 326;
					progress_empty.height = 70;
					// progress_fill = game.add.sprite((playground.width-320)/2, (playground.height-60)/2+40, 'progress-fill');
					progress_fill = game.add.sprite((playground.width-320)/2, (playground.height-60)/2+40, 'text-load', 'progress-fill.png');
					progress_fill.width = 320;
					progress_fill.height = 60;
				} else {
					// progress_empty = game.add.sprite((playground.width-486)/2, (playground.height-110)/2+60, 'progress-empty');
					progress_empty = game.add.sprite((playground.width-486)/2, (playground.height-110)/2+60, 'text-load', 'progress-empty.png');
					progress_empty.width = 486;
					progress_empty.height = 110;
					// progress_fill = game.add.sprite((playground.width-480)/2, (playground.height-90)/2+60, 'progress-fill');
					progress_fill = game.add.sprite((playground.width-480)/2, (playground.height-90)/2+60, 'text-load', 'progress-fill.png');
					progress_fill.width = 480;
					progress_fill.height = 90;
				}
				
				game.load.setPreloadSprite(progress_fill);

				// 加载其他资源
				game.load.audio('sound_win', 'http://24haowan-cdn.shanyougame.com/tourist/assets/audio/win.wav');
				game.load.audio('sound_bg', 'http://24haowan-cdn.shanyougame.com/tourist/assets/audio/bg.mp3');
				// game.load.image('bg-start', 'assets/'+device+'/bg-start.png');
				// game.load.image('icon-countDown', 'assets/'+device+'/bg-countDown.png');
				// game.load.image('bg-score', 'assets/'+device+'/bg-score.png');
				game.load.atlasJSONHash('texture-play', 'http://24haowan-cdn.shanyougame.com/tourist/assets/'+device+'/texture-play.png', 'http://24haowan-cdn.shanyougame.com/tourist/assets/'+device+'/texture-play.json');
				game.load.image('icon-bear','http://24haowan-cdn.shanyougame.com/tourist/assets/icon-bear.png');
				game.load.atlasJSONArray('people', 'http://24haowan-cdn.shanyougame.com/tourist/assets/'+device+'/texture.png', 'http://24haowan-cdn.shanyougame.com/tourist/assets/'+device+'/texture.json');
				game.load.image('bg-score','http://24haowan-cdn.shanyougame.com/tourist/assets/'+device+'/bg-score.png');
				if (device == "mobile") {
					game.load.spritesheet('persons', 'http://24haowan-cdn.shanyougame.com/tourist/assets/mobile/persons.png', 150, 300);
				} else {
					game.load.spritesheet('persons', 'http://24haowan-cdn.shanyougame.com/tourist/assets/pad/persons.png', 225, 450);
				}
			};
			this.create = function() {
				game.state.start('create');
			};
		}

		game.States.create = function () {
			this.create = function () {
				// 设置背景颜色
				game.stage.backgroundColor = "#336666";

				// 添加声效素材
				if (typeof(audioBg) == "undefined") {
					audioBg = game.add.audio('sound_bg');
				}
				audioWin = game.add.audio('sound_win');
				
				// 添加背景
				// var bg_start = game.add.image(0, 0, 'bg-start');
				var bg_start = game.add.image(0, 0, 'texture-play', 'bg-start.png');
				var ratio_temp = (device == "mobile") ? bgRatio_mobile : bgRatio_pad;
				if (ratio >= ratio_temp) {
					bg_start.width = playground.width;
					bg_start.height = playground.width/ratio_temp;
				} else {
					bg_start.width = playground.height*ratio_temp;
					bg_start.height = playground.height;
					bg_start.x = -(bg_start.width - playground.width)/2;
				}

				// 开始按钮
				$("#startButton").css("display", "block").css("left", (windowInnerWidth-180)/2).css("top", windowInnerHeight*4/5);
				$("#startButton").on("tap", function(e) {
					e.preventDefault();
					e.stopPropagation();
					gameStart();
				});

				// 暂停按钮
				$("#pauseButton").on("tap", function(e) {
					e.preventDefault();
					e.stopPropagation();
					gamePause();
				});

				// 重玩按钮
				$("#pauseReplay").on("tap", function(e) {
					e.preventDefault();
					e.stopPropagation();
					gameReplay();
				});

				// 继续按钮
				$("#pauseResume").on("tap", function(e) {
					e.preventDefault();
					e.stopPropagation();
					gameResume();
				});

				// 禁止旋转提示拖动
				$("#rotate-div").on("touchmove", function(e) {
					e.preventDefault();
				});

				// 禁止暂停按钮拖动
				$("#pauseButton").on("touchmove", function(e) {
					e.preventDefault();
				});
			};
		}

		game.States.play = function () {
			this.create = function () {
				// 显示暂停按钮
				$("#pauseButton").css("display", "block");

				// 播放背景音乐
				if (!audioBg.isPlaying) audioBg.loopFull();

				// 创建人群
				persons = game.add.group();
				initPersons();
				
				if (device == "mobile") {
					// 找到的单身狗个数
					var bgScore = game.add.image(10, 20, 'bg-score');
					// var bgScore = game.add.image(10, 20, 'texture-play', 'bg-score.png');
					// iconDoge = game.add.image(28, 24, 'icon-bear');
					// iconDoge.width = 38;
					// iconDoge.height = 38;
					dogeText = game.add.text(100, 24, '0', {fontSize: '38px', fill:"#FFFFFF"});
					// bestScoreText = game.add.text(90, 64, bestScore, {fontSize: '20px', fill:"#FFFFFF"});

					// 剩余时间
					// iconCountDown = game.add.image((playground.width-60)/2, 20, 'icon-countDown');
					iconCountDown = game.add.image((playground.width-60)/2, 20, 'texture-play', 'bg-countDown.png');
					iconCountDown.width = 60;
					iconCountDown.height = 60;
					countDownText = game.add.text((playground.width-40)/2, 28, '60', {fontSize: "40px", fill:"#FFFFFF"});
					countDownText.setTextBounds(0, 0, 40, 40);
				} else {
					// 找到的单身狗个数
					var bgScore = game.add.image(15, 30, 'bg-score');
					// var bgScore = game.add.image(15, 30, 'texture-play', 'bg-score.png');
					// iconDoge = game.add.image(42, 36, 'icon-bear');
					// iconDoge.width = 57;
					// iconDoge.height = 57;
					dogeText = game.add.text(150, 36, '0', {fontSize: '57px', fill:"#FFFFFF"});
					// bestScoreText = game.add.text(135, 96, bestScore, {fontSize: '30px', fill:"#FFFFFF"});

					// 剩余时间
					// iconCountDown = game.add.image((playground.width-90)/2, 30, 'icon-countDown');
					iconCountDown = game.add.image((playground.width-90)/2, 30, 'texture-play', 'bg-countDown.png');
					iconCountDown.width = 90;
					iconCountDown.height = 90;
					countDownText = game.add.text((playground.width-60)/2, 42, '60', {fontSize: "60px", fill:"#FFFFFF"});
					countDownText.setTextBounds(0, 0, 60, 60);
				}
				countDownText.boundsAlignH = 'center';
				 

				// 绑定点击事件
				game.input.onTap.add(onTap, this);
				game.input.onHold.add(onTap, this);

				// 启动计时器
				timer = game.time.create(false);
				timer.loop(1000, function() {
					countDown--;
					countDownText.text = countDown;
					if (countDown == 0) {
						gameEnd();
					} else if (countDown == 10) {
						if (device == "mobile") {
							game.add.tween(iconCountDown).to( { width: 70, height: 70, x: (playground.width-70)/2, y:15 }, 300, Phaser.Easing.Linear.None, true, 0, Number.MAX_VALUE, true);
						} else {
							game.add.tween(iconCountDown).to( { width: 100, height: 100, x: (playground.width-100)/2, y:30 }, 300, Phaser.Easing.Linear.None, true, 0, Number.MAX_VALUE, true);
						}
					}
				}, this);
				timer.start();
			};
		}
		game.state.add('boot',game.States.boot);
		game.state.add('preload',game.States.preload);
		game.state.add('create',game.States.create);
		game.state.add('play',game.States.play);
		game.state.start('boot');
	}

	/*------------------------------------------------

	监听横竖屏变化

	------------------------------------------------*/

	window.addEventListener("orientationchange", orientationChanged, false);

	function orientationChanged() {

		if(window.orientation==180 || window.orientation==0 || window.orientation == null){ // 竖屏状态
			reloadData();
			console.log('1');
			if(!isInit) initGame();
			$(game.canvas).css("width", windowInnerWidth);
			$(game.canvas).css("height", windowInnerHeight);
			$("#rotate-div").css("display", "none");
	    } else if (window.orientation==90 || window.orientation==-90) {
	    	$("#rotate-div").css("display", "-webkit-box");
	    	if(isInit) gamePause();
	    }
	}

// })();
	 wx.config({
	    debug: false,
	    appId: '<?php echo $this->signPackage["appId"];?>',
	    timestamp: <?php echo $this->signPackage["timestamp"];?>,
	    nonceStr: '<?php echo $this->signPackage["nonceStr"];?>',
	    signature: '<?php echo $this->signPackage["signature"];?>',
	    jsApiList: [
	      // 所有要调用的 API 都要加到这个列表中
	      'onMenuShareTimeline','onMenuShareAppMessage'
	    ]
	  });
	wxReady();
	  function wxReady(obj) {
		obj = obj || {};
		var text = obj.title || '24好玩平台，就是童年那股味道';
	  	  var imgUrl = obj.imgUrl || 'http://24haowan-cdn.shanyougame.com/platform/images/head_logo.png';
	  	  var desc = obj.desc || '哼，本公举要被这个游戏弄得爆炸啦';
		  wx.ready(function () {
		    // 在这里调用 API
		    //分享朋友圈
		    wx.onMenuShareTimeline({
			    title: text, // 分享标题
			    link:  location.href.slice(0,(location.href.indexOf('?')>-1)?location.href.indexOf('?'):location.href.length), // 分享链接
			    imgUrl: imgUrl, // 分享图标
			    success: function () { 
			       // 用户确认分享后执行的回调函数
			       //var data = "openid="+openid+"&type=cfriend";
			       //var url = "http://glgl-dev.shanyougame.com/ajax/commitShare";
			       //var xhr = new XMLHttpRequest();
				   // xhr.open('post',url,true);
				   // //that's ok
				   // xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				   // xhr.onreadystatechange = function() {
				   //     if(xhr.readyState == 4) {
				   //         if(xhr.status == 200) {
				   //         } else {
				   //         }
				   //     }
				   // }
				   // xhr.send(data);
			    },
			    cancel: function () { 
			    }
			});
		    
		    //分享朋友
			wx.onMenuShareAppMessage({
			    title: text, // 分享标题
			    desc: desc, // 分享描述
			    link: location.href.slice(0,(location.href.indexOf('?')>-1)?location.href.indexOf('?'):location.href.length), // 分享链接
			    imgUrl: imgUrl, // 分享图标
			    type: 'link', // 分享类型,music、video或link，不填默认为link
			    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			    success: function () {
			       // 用户确认分享后执行的回调函数
			       //var data = "openid="+openid+"&type=friend";
			       //var url = "http://glgl-dev.shanyougame.com/ajax/commitShare";
			       //var xhr = new XMLHttpRequest();
				   // xhr.open('post',url,true);
				   // //that's ok
				   // xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				   // xhr.onreadystatechange = function() {
				   //     if(xhr.readyState == 4) {
				   //         if(xhr.status == 200) {
				   //             // alert('1'+xhr.responseText);
				   //         } else {
				   //             // alert('2'+xhr.status);
				   //         }
				   //     }
				   // }
				   // xhr.send(data);
			    },
			    cancel: function () { 
			        // 用户取消分享后执行的回调函数
			    }
			});
		  });
	  }
</script>