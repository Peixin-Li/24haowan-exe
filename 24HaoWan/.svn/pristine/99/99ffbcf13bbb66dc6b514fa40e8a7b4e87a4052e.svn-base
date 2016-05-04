var canvasWidth = window.innerWidth*2;
var canvasHeight = window.innerHeight*2;
var game = new Phaser.Game(canvasWidth,canvasHeight,Phaser.CANVAS,'game_div');
var Multiplayer = false;

var ratio = canvasWidth/canvasHeight;
// 背景宽高比
var bgRatio_mobile = 828/1344;
var bgRatio_pad = 1408/2048;
// 设备类型
var device = (navigator.userAgent.indexOf("iPad") > -1) ? 'pad' : 'mobile';
var dataJson = [];
/*
	iphone rect arguments
*/
var rect;
var rectWidth = (device=='mobile')?(268):(356); 
var rectHeight = (device=='mobile')?(60):(72);
var rectLeft; //左半边方块
var rectRight; //右半边方块

var direction; //方向

var loopNum = 0; 
var replay = false;

var score = 0;
var scoreLabel;

var rectPositionY = 160; //方块Y轴位置
var musicBox = {};
game.States = {};
	
game.States.boot = function(){
	
	this.preload = function(){
		game.load.atlasJSONArray('loading','http://24haowan-cdn.shanyougame.com/public/image/' + device +'/sprite.png','http://24haowan-cdn.shanyougame.com/public/image/' + device +'/sprite.json');
		
		// 设置画布大小
		$(game.canvas).css("width", canvasWidth/2);
		$(game.canvas).css("height", canvasHeight/2);
		//会撑大屏幕
		game.stage.backgroundColor = '#aaa';
	};
	this.create = function(){
		setTimeout(function(){
			hiddenImg();
		},1500);
		game.state.start('preload');

	};
};

game.States.preload = function() {
	this.preload = function() {
		//加载图
		var pic_start = game.add.image(0,0,'loading','background.png');
        var ratio_temp = (device == "mobile") ? bgRatio_mobile : bgRatio_pad;
		if (ratio >= ratio_temp) {
			pic_start.width = canvasWidth;
			pic_start.height = canvasWidth/ratio_temp;
		} else {
			pic_start.width = canvasHeight*ratio_temp;
			pic_start.height = canvasHeight;
			pic_start.x = -(pic_start.width - canvasWidth)/2;
		}

		// 显示进度条
		var progress_fill, progress_empty;
		if (device == "mobile") {
			progress_empty = game.add.sprite((canvasWidth-326)/2, (canvasHeight-70)/2+80, 'loading', 'progress_empty.png');
			progress_empty.width = 326;
			progress_empty.height = 70;
			progress_fill = game.add.sprite((canvasWidth-320)/2, (canvasHeight-60)/2+80, 'loading', 'progress_fill.png');
			progress_fill.width = 320;
			progress_fill.height = 60;
		} else {
			progress_empty = game.add.sprite((canvasWidth-486)/2, (canvasHeight-110)/2+100, 'loading', 'progress_empty.png');
			progress_empty.width = 486;
			progress_empty.height = 110;
			progress_fill = game.add.sprite((canvasWidth-480)/2, (canvasHeight-90)/2+100, 'loading', 'progress_fill.png');
			progress_fill.width = 480;
			progress_fill.height = 90;
		}
		
		game.load.setPreloadSprite(progress_fill);

		game.load.atlasJSONArray('pixel','http://24haowan-cdn.shanyougame.com/weightlifting/image/' + device + '/1234.png','http://24haowan-cdn.shanyougame.com/weightlifting/image/' + device + '/1234.json');
		game.load.image('stage','http://24haowan-cdn.shanyougame.com/weightlifting/image/' + device + '/stage.png');
		game.load.image('perfect','http://24haowan-cdn.shanyougame.com/weightlifting/image/' + device + '/perfect.png');
		game.load.image('start_btn','http://24haowan-cdn.shanyougame.com/weightlifting/image/' + device + '/start_btn.png');
		game.load.image('title','http://24haowan-cdn.shanyougame.com/weightlifting/image/' + device + '/title.png');
		game.load.image('dotted_6p','http://24haowan-cdn.shanyougame.com/weightlifting/image/dotted_6p.png');
		game.load.image('dotted','http://24haowan-cdn.shanyougame.com/weightlifting/image/dotted.png');
		game.load.image('finger','http://24haowan-cdn.shanyougame.com/weightlifting/image/finger.png');

		game.load.audio('bgMusic','http://24haowan-cdn.shanyougame.com/weightlifting/image/audio/bgMusic.mp3');
		game.load.audio('gameOver','http://24haowan-cdn.shanyougame.com/weightlifting/image/audio/gameOver.mp3');
		game.load.audio('perfectMusic','http://24haowan-cdn.shanyougame.com/weightlifting/image/audio/perfect.mp3');
		game.load.audio('rectKill','http://24haowan-cdn.shanyougame.com/weightlifting/image/audio/rectKill.mp3');
		game.load.audio('splitRect','http://24haowan-cdn.shanyougame.com/weightlifting/image/audio/splitRect.mp3');

	};
	this.create = function() {
		musicBox.bgMusic = game.add.audio('bgMusic');
		musicBox.gameOver = game.add.audio('gameOver');
		musicBox.perfect = game.add.audio('perfectMusic');
		musicBox.rectKill = game.add.audio('rectKill');
		musicBox.splitRect = game.add.audio('splitRect');
		game.state.start('create');
	}
};

//开始的菜单模块
game.States.create = function() {
	this.create = function() {
		// $('#start_menu').show();
		$('.game_rank_btn').show();
		$(game.canvas).css("width", canvasWidth/2);
		$(game.canvas).css("height", canvasHeight/2);
		game.stage.backgroundColor = "#545e71";
		var stage = game.add.image(game.world.centerX,game.world.height,'stage');
		stage.anchor.setTo(0.5,1);
		if(game.height/2 <= 568) {
			var title = game.add.sprite(game.world.centerX,game.cache.getImage('title').height,'title');
			title.anchor.setTo(0.5,1);
			title.scale.setTo(0.8);
			var start_btn = game.add.sprite(game.world.centerX,game.cache.getImage('title').height,'start_btn');
			start_btn.anchor.setTo(0.5,0);
			game.add.tween(start_btn).to({width:start_btn.width*1.2,height:start_btn.height*1.2},500,'Linear',true,0,Math.max(),true);
		} else if(game.height/2 >= 730){
			var title = game.add.sprite(game.world.centerX,game.world.centerY/2,'title');
			title.anchor.setTo(0.5,1);
			// title.scale.setTo(0.8);
			var start_btn = game.add.sprite(game.world.centerX,game.world.centerY/3*2,'start_btn');
			start_btn.anchor.setTo(0.5,0);
			game.add.tween(start_btn).to({width:start_btn.width*1.2,height:start_btn.height*1.2},500,'Linear',true,0,Math.max(),true);
		} else {
			var title = game.add.sprite(game.world.centerX,game.world.centerY/2,'title');
			title.anchor.setTo(0.5,1);
			// title.scale.setTo(0.8);
			var start_btn = game.add.sprite(game.world.centerX,game.world.centerY/2,'start_btn');
			start_btn.anchor.setTo(0.5,0);
			game.add.tween(start_btn).to({width:start_btn.width*1.2,height:start_btn.height*1.2},500,'Linear',true,0,Math.max(),true);
		}
		// start_btn.scale.setTo(0.8);

		var one = new weight();
		one.createPeople();
		game.input.onDown.add(function(){
			game.state.start('play');
			hiddenLabel();
		});
	}
};

//所有点击事件触发的均为物理像素，由于画布扩大了两倍，所以所有的触屏坐标计算都应当乘以2
game.States.play = function(){
	this.preload = function(){
		game.world.removeAll();
	};
	this.create = function(){
		score = 0;
		loopNum = 0;
		animate = null;

		$('.game_rank_btn').hide();
		if(navigator.userAgent.toLowerCase().indexOf('android')<0) {
			//非安卓
			musicBox.bgMusic.loopFull();
			musicBox.bgMusic.volume = 0.2;
			$('.stop_music_btn').show();
			$('.stop_music_btn').on('click',function(){
				if(musicBox.bgMusic.paused == true) {
					//start
					musicBox.bgMusic.resume();
					musicBox.bgMusic.volume = 0.2;
					$('.stop_music_btn').css('background-image','url(http://24haowan-cdn.shanyougame.com/weightlifting/image/stopMusic.png)');
				} else {
					$('.stop_music_btn').css('background-image','url(http://24haowan-cdn.shanyougame.com/weightlifting/image/startMusic.png)');
					musicBox.bgMusic.pause();
				}
			});
			$('.stop_music_btn').on('touchmove',function(e){
				e.preventDefault();
			});
		}
		var stage = game.add.image(game.world.centerX,game.world.height,'stage');
		stage.anchor.setTo(0.5,1);
		finger = game.add.image(game.world.centerX,game.world.height,'finger');
		finger.anchor.setTo(0,0);
		finger.angle = -90;
		if(game.height/2 <730) {
			dotted = game.add.image(game.world.centerX,0,'dotted');
		} else {
			dotted = game.add.image(game.world.centerX,0,'dotted_6p');
		}
		dotted.anchor.setTo(0.5,0);
		// dotted.height = game.world.height/2;
		if(!Multiplayer) {
			//单人游戏
			var one = new weight();
			one.init();
		}
	};
	this.update = function() {
	}

};

function weight() {
	this.canDown = true;
	if(arguments[0]) {
		this.argument = arguments[0];
	}
};
weight.prototype.init = function() {
	this.sum = 0;
	if(device == 'pad') {
		rectPositionY = game.height - (game.cache.getImage('stage').height + game.cache.getImage('pixel').height) -180;
	} else {
		rectPositionY = game.height - (game.cache.getImage('stage').height + game.cache.getImage('pixel').height) +180;
	}
	this.createRect();
	this.createPeople();
	var scoreMarginTop = 219;
	scoreLabel = game.add.text(game.world.centerX,scoreMarginTop,score,{ fontSize: '40px', fill: '#000' });
	scoreLabel.anchor.setTo(0.5);
	if(game.world.height/2 <=480) {
		scoreLabel.y = 270/2;
		dotted.height = game.world.height/2;
	} else if(game.height/2 > 730) {
		scoreLabel.y = 380;
	}
};
//绘制长方块
weight.prototype.createRect = function() {
	var self = this;
	//add direction 1 left moveTo right  2 right moveTo left
	direction = ((Math.random()>0.6)?1:-1);
	// create a new bitmap data object
	var bmd = game.add.bitmapData(rectWidth,rectHeight);

    // draw to the canvas context like normal
    bmd.ctx.beginPath();
    bmd.ctx.rect(0,0,rectWidth,rectHeight);
    bmd.ctx.fillStyle = '#0d0d1f';
    bmd.ctx.fill();
    bmd.ctx.beginPath();
    bmd.ctx.lineWidth = 2;
    bmd.ctx.strokeStyle = '#FF2E2E';
    bmd.ctx.moveTo(rectWidth/2-10,0);
    bmd.ctx.lineTo(rectWidth/2-10,rectHeight);
	bmd.ctx.stroke();

    bmd.ctx.beginPath();
    bmd.ctx.moveTo(rectWidth/2+10,0);
    bmd.ctx.lineTo(rectWidth/2+10,rectHeight);    
	bmd.ctx.stroke();

    //长块位置
    // game.physics.arcade.enable(rect,true);
    // rect.body.setSize(100,50,-100,50);
    if(score>0) {
    	// rect = game.add.sprite(game.world.centerX-(rectWidth*0.5*0.7)*direction,rectPositionY,bmd);
    	rect = game.add.sprite(direction>0?rectWidth/2:(game.world.width - rectWidth/2),rectPositionY,bmd);
	    rect.anchor.setTo(0.5);
	    animate = game.add.tween(rect).to({
	        // x: game.world.centerX+(rectWidth*0.5*0.7)*direction
	        x: direction>0?(game.world.width - rectWidth/2):(rectWidth/2)
	    }, (1800-score*40)>100?(1800-score*40):100, Phaser.Easing.Linear.None, true,0,Math.max(),true);
	    animate.onStart.add(function(){
	    	loopNum++;
	    });
	    animate.onLoop.add(function(){
	    	loopNum++;
	    });
    } else {
    	rect = game.add.sprite(game.world.centerX,rectPositionY,bmd);
	    rect.anchor.setTo(0.5);
    }

    game.input.onDown.add(function(){
		if(score <= 2 && self.canDown){
			self.splitRect();
		} else if (!animate.isPaused && self.canDown) {
			animate.pause();
			self.splitRect();
    	}
    	self.canDown = false;
    });
};
//绘制人物
weight.prototype.createPeople = function() {
	this.people = game.add.sprite(game.world.centerX,game.height-game.cache.getImage('stage').height+50,'pixel','p3.png');
	this.people.anchor.setTo(0.5,1);
	// this.people.width = game.world.width*0.8;
	// console.log(asd = this.people);
	if(game.height/2 <= 480) {
		this.people.scale.setTo(0.7);
	} else {
		this.people.scale.setTo(0.8);
	}
	this.people.state = 5; //跟sprite图有关
};
weight.prototype.changePeople = function(diff) {
	/*--------------------------------------------
		sum>0  左边方块小于右边方块，人物向右倒
		sum<0  左边方块大于右边方块，人物向左倒
	--------------------------------------------*/
	// if(this.people.state = 5) {
	// 	this.people.animations.add('crouch',[5,6,5,4],600,false);
	// 	this.people.animations.play('crouch');
	// }
	
	var self = this;
	if(score == 1) {
		game.add.tween(this.people).to({height:this.people.height*0.98},150,'Linear',true,0,1,true);
	} else {
		if(this.sum<=0 && diff>=-this.sum) {
			//更换方向 右边
			this.animate && this.animate.stop();
			this.animate = game.add.tween(this.people).to({'angle':35},(5000 - 20*score)>3000?(5000 - 20*score):3000,Phaser.Easing.Linear.None,true);
		} else if(this.sum>=0 && -diff>=this.sum){
			//更换方向 左边
			this.animate && this.animate.stop();
			this.animate = game.add.tween(this.people).to({'angle':-35},(5000 - 20*score)>3000?(5000 - 20*score):3000,Phaser.Easing.Linear.None,true);
		} else {
			//非改变角度
			// console.log((5000 - diff*20));
			// this.animate.updateTweenData('duration',5000,0);
			// console.info((8000 - diff*40));
			var toAngle;
			if(this.sum<=0) {
				toAngle = 35;
			} else {
				toAngle = -35;
			} 
			this.animate && this.animate.stop();
			this.animate = game.add.tween(this.people).to({'angle':-toAngle},(8000 - Math.abs(diff)*50)>2000?(8000 - Math.abs(diff)*50):2000,Phaser.Easing.Linear.None,true);
			// this.animate.updateTweenData('duration',(8000 - Math.abs(diff)*50)>2000?(8000 - Math.abs(diff)*50):2000,0);
		}
		this.bindAnimate(this.animate);
	}
	this.sum += diff;
}
weight.prototype.bindAnimate = function(animate){
	var self = this;
	animate.onComplete.add(function(){
		console.log('lose,you score:' + score);
		rectLeft.kill();
		rectRight.kill();
		//结束 
		rect.kill();
		setTimeout(function(){
			//提交成绩接口
			game.paused = true;
		},50);
		setGameScore(score,getBadge(score),resetShareText());
		$('#over_box').show();
		$('#over_box .over-btn-container').show();
	});
	animate.onUpdateCallback(function(){
		var angle = this.people.angle;
		if(Math.abs(angle)>=25) {
			// animate = null;
			if(angle>0) {
				this.people.frame = 4;
			} else {
				this.people.frame = 0;
			} 
			this.people.angle=0
			musicBox.gameOver.play();
			// alert('lose,you score:' + score);
			console.log('lose,you score:' + score);
			rectLeft.kill();
			rectRight.kill();
			//结束 
			rect.kill();
			setTimeout(function(){
				//提交成绩接口
				game.paused = true;
			},50);
			setGameScore(score,getBadge(score),resetShareText());
			$('#over_box').show();
			$('#over_box .over-btn-container').show();
			//跳转结束页面
			// alert($('.over_menu').width() + ',' + $('body').width());
		} else if(Math.abs(angle) <3) {
			if(this.people.frame != 2) {
				this.people.frame = 2;
			}
		}
	},this);
}
weight.prototype.perfectAnimation = function() {
	var perfect = game.add.sprite(game.world.centerX,rectPositionY,'perfect');
	perfect.anchor.setTo(0.5);
	perfect.bringToTop();
	game.add.tween(perfect).to({width:perfect.width*1.1,height:perfect.height*1.1},100,'Linear',true,0,0,true).onComplete.add(function(){
		game.add.tween(perfect).to({alpha:0},200,'Linear',true,0,0,false).onComplete.add(function(){
			perfect.kill();
			// console.info('a');
		});
	});
};
//点击事件后绘制两个小方块
weight.prototype.splitRect = function() {
	musicBox.splitRect.play();

	finger.kill();
	var self = this;
	diff = rect.x - game.world.centerX; //计算中部差
	if(Math.abs(diff)>rectWidth/2) {
		if(diff>0) {
			diff = rectWidth/2;
		} else {
			diff = -rectWidth/2;
		}
	}
	var rightY = self.people.position.y - Math.sin((Math.atan(483/312)*180/Math.PI - self.people.angle)/180*Math.PI)*460;
	var rightX = Math.cos((Math.atan(483/312)*180/Math.PI - self.people.angle)/180*Math.PI)*575*self.people.scale.x + self.people.position.x;
	var leftX  = rightX - Math.cos(self.people.angle/180*Math.PI)*653*self.people.scale.y;
	var leftY  = rightY - Math.sin(self.people.angle/180*Math.PI)*653*self.people.scale.y;

	//绘制左边方块
	var bmd = game.add.bitmapData(rectWidth/2-diff,rectHeight);
	bmd.ctx.beginPath();
    bmd.ctx.rect(0,0,rectWidth/2-diff,rectHeight);
    bmd.ctx.fillStyle = '#0d0d1f';
    bmd.ctx.fill();
    rectLeft = game.add.sprite(game.world.centerX,rectPositionY,bmd);
    rectLeft.anchor.setTo(1,0.5);
    rectLeft_animate = game.add.tween(rectLeft).to({
    	angle : -45,
    	// x : rectLeft.x - 150 + xDiff + moveDiff ,
    	// y : rectLeft.y + ((200 - yDiff)<0?50:(200 - yDiff))
    	// x:self.people.position.x - 312*self.people.scale.x,
    	// y:self.people.position.y - 483*self.people.scale.y
    	x:leftX + 50,
    	y:leftY,
    	width:rectLeft.width/2
    },400,Phaser.Easing.Quadratic.In,true,0,0,false);

    //绘制右边方块
    bmd = game.add.bitmapData(rectWidth/2+diff,rectHeight);
	bmd.ctx.beginPath();
    bmd.ctx.rect(0,0,rectWidth/2+diff,rectHeight);
    bmd.ctx.fillStyle = '#0d0d1f';
    bmd.ctx.fill();
    rectRight = game.add.sprite(game.world.centerX,rectPositionY,bmd);
    rectRight.anchor.setTo(0,0.5);
    rectRight_animate = game.add.tween(rectRight).to({
    	angle : +45,
    	// x : rectRight.x + 150 + xDiffRight + moveDiff,
    	// y : rectRight.y + ((200 + yDiff - (rectWidth/2-diff)*0.5)<0?50:(200 + yDiff - (rectWidth/2-diff)*0.5))
    	x:rightX - 50,
    	y:rightY,
    	width:rectRight.width/2
    },400,Phaser.Easing.Quadratic.In,true,0,0,false);
    //方块下落动画完成后回调
    if(Math.abs(diff) <= 10) {
    	musicBox.perfect.play();
		this.perfectAnimation();
		scoreLabel.text = (++score);
	}
	this.people.bringToTop();
    rectRight_animate.onComplete.add(function(){
    	// musicBox.rectKill.play();
    	rectLeft.kill();
    	rectRight.kill();
    	self.createRect();
    	self.canDown = true;
    	self.addJson();
    	self.changePeople(diff);
    	scoreLabel.text = (++score);
    });
    // console.log(rect);
    rect.kill();
};
//填充数据
weight.prototype.addJson = function() {
	var obj = {};
	obj.loopNum = loopNum;
	obj.leftLength = Math.round((rectWidth/2-diff)*1000)/1000;
	obj.rightLength = Math.round((rectWidth/2+diff)*1000)/1000;
	obj.direction = direction;
	dataJson.push(obj);
};


game.state.add('boot',game.States.boot);
game.state.add('preload',game.States.preload);
game.state.add('create',game.States.create);
game.state.add('play',game.States.play);
game.state.start('boot');

function getBadge(score) {
    if(score>=30) {
        return 1;
    } else if(score>=25) {
        return 2;
    } else if(score>=15) {
        return 3;
    } else {
        return 0;
    }
}

function resetShareText() {
    var obj = {
            share:"点击右上角，分享自己坚持的次数",
            default:"寻找单身狗的情侣们又回来啦！快来看看你坚持比不比他们久",
            title:"我在举重运动中,坚持了{score}下,打败了全国{persent}%人,快看你能坚持多少下",
            desc:"寻找单身狗的情侣们又回来啦！这次他们要举行激烈的运动会,第一个项目就是举重,看看谁是举重大师!",
            imgUrl:"http://24haowan-cdn.shanyougame.com/weightlifting/image/pic_title.png",
    };
    return obj;
}