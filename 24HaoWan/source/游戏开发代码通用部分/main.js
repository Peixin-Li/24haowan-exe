var canvasWidth = window.innerWidth*2;
var canvasHeight = window.innerHeight*2;
var game = new Phaser.Game(canvasWidth,canvasHeight,Phaser.CANVAS,'game_div');

// 背景宽高比
var ratio = canvasWidth/canvasHeight;
var bgRatio_mobile = 828/1344;
var bgRatio_pad = 1408/2048;

// 设备类型
var device = (navigator.userAgent.indexOf("iPad") > -1) ? 'pad' : 'mobile';

game.States = {};

//加载进度条所需资源
game.States.boot = function(){
	this.preload = function(){
		// 进度条
		game.load.atlasJSONArray('loading','http://24haowan-cdn.shanyougame.com/public/image/' + device +'/sprite.png','http://24haowan-cdn.shanyougame.com/public/image/' + device +'/sprite.json');

		// 设置画布大小
		$(game.canvas).css("width", canvasWidth/2);
		$(game.canvas).css("height", canvasHeight/2);
		//会撑大屏幕
		game.stage.backgroundColor = '#aaa';
	},
	this.create = function() {
		setTimeout(function(){
            // hiddenImg();
        }, 1500);
		game.state.start('preload');
	}
}

//加载列表
game.States.preload = function(){
	this.preload = function(){
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

		//加载资源
	};
	this.create = function(){
		game.state.start('create');
	};
}

//开始的菜单模块
game.States.create = function(){
	this.create = function() {
		//显示开始菜单页面 使用dom构建
		//开始按钮调用 
		/*
			game.state.start('play');
			hiddenLabel();
		*/
	}
}

game.States.play = function(){
	this.create = function(){

	};
	this.update = function(){

	};
}
//开始写逻辑


game.state.add('boot',game.States.boot);
game.state.add('preload',game.States.preload);
game.state.add('create',game.States.create);
game.state.add('play',game.States.play);
game.state.start('boot');

//文案分享接口
function resetShareText() {
    var obj = {
            share:"“点击右上方，炫耀自己打掉恶魔的成绩”",
            default:"助方块长老一臂之力，清掉所有恶魔方块",
            title:"我在打掉魔块中取得了{score}分，打败了全国{persent}%人，快来帮忙拯救小方块",
            desc:"恶魔军团，绑架了方块家族成员作人质，助方块长老一臂之力，清掉所有恶魔方块。",
            imgUrl:"http://24haowan-cdn.shanyougame.com/BreakSquare/pic_title.png",
    };
    return obj;
}

//分数规则接口
function getBadge(score) {
    if(score>=3000) {
        return 1;
    } else if(score>=2500) {
        return 2;
    } else if(score>=1500) {
        return 3;
    } else {
        return 0;
    }
}