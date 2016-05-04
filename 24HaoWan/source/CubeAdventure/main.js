var music_btn,musicBox,musicJump,musicDie;
/*
    obj = {
        share:"",
        default:"",
        title:"{score}  {persent},  " //{score}替换成分数 {persent}替换成百分比
        desc:"描述",  无替换
        imgUrl:"",
    }
*/
var GameObj = {};
// 屏幕数据
    var windowInnerWidth = window.innerWidth;
    var windowInnerHeight = window.innerHeight;
    var ratio = windowInnerWidth/windowInnerHeight;

// 设备类型
    var device = (navigator.userAgent.indexOf("iPad") > -1) ? 'pad' : 'mobile';

// 背景宽高比
    var bgRatio_mobile = 828/1344;
    var bgRatio_pad = 1408/2048;

// 创建游戏
//480 * 800
var game = new Phaser.Game(480, 800, Phaser.CANVAS, "game_div");
/*
    不同游戏状态
*/
game.States = {};

game.States.boot = function() {
    this.preload = function() {
        //loading
        game.load.atlasJSONArray('loading','http://24haowan-cdn.shanyougame.com/public/image/' + device +'/sprite.png','http://24haowan-cdn.shanyougame.com/public/image/' + device +'/sprite.json');
    };
    this.create = function() {
        setTimeout(function(){
            hiddenImg();
        }, 1500);
        game.state.start('preload');
    };
};
game.States.preload = function() {
    this.preload = function() {
        game.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;
        game.scale.minWidth = 120;
        game.scale.minHeight = 200;
        game.scale.maxWidth = 960;
        game.scale.maxHeight = 1600;
        game.scale.pageAlignHorizontally = true;
        game.scale.pageAlignVertically = true;
        game.scale.setScreenSize(true)
        game.scale.refresh();
        var pic_start = game.add.image(0,0,'loading','background.png');
        pic_start.width = 480;
        pic_start.height = 800;
        var progress_fill, progress_empty;
        if (device == "mobile") {
            // game.add.text((windowInnerWidth-96)/2, (windowInnerHeight-32)/2, '加载中', { fontSize: '32px', fill: '#000' });
            // progress_empty = game.add.sprite((windowInnerWidth-326)/2, (windowInnerHeight-70)/2+40, 'progress-empty');
            progress_empty = game.add.sprite((460-306)/2, (800-70)/2+80,'loading', 'progress_empty.png');
            progress_empty.width = 306;
            progress_empty.height = 45;
            // progress_fill = game.add.sprite((windowInnerWidth-320)/2, (windowInnerHeight-60)/2+40, 'progress-fill');
            progress_fill = game.add.sprite((460-300)/2, (800-60)/2+80,'loading','progress_fill.png');
            progress_fill.width = 300;
            progress_fill.height = 35;
        } else {
            // game.add.text((windowInnerWidth-144)/2, (windowInnerHeight-48)/2, '加载中', { fontSize: '48px', fill: '#000' });
            // progress_empty = game.add.sprite((windowInnerWidth-486)/2, (windowInnerHeight-110)/2+60, 'progress-empty');
            progress_empty = game.add.sprite((460-396)/2, (800-60)/2+60,'loading', 'progress_empty.png');
            progress_empty.width = 396;
            progress_empty.height = 60;
            // progress_fill = game.add.sprite((windowInnerWidth-480)/2, (windowInnerHeight-90)/2+60, 'progress-fill');
            progress_fill = game.add.sprite((460-390)/2, (800-40)/2+55,'loading', 'progress_fill.png');
            progress_fill.width = 390;
            progress_fill.height = 50;
        }
        
        game.load.setPreloadSprite(progress_fill);
        game.load.image("skull", "http://24haowan-cdn.shanyougame.com/CubeAdventure/assets/skull.png");
        game.load.image("limb", "http://24haowan-cdn.shanyougame.com/CubeAdventure/assets/limb.png");
        game.load.image("spike", "http://24haowan-cdn.shanyougame.com/CubeAdventure/assets/spike1.png");
        game.load.image("bar0", "http://24haowan-cdn.shanyougame.com/CubeAdventure/assets/bar0.png");
        game.load.image("bar1", "http://24haowan-cdn.shanyougame.com/CubeAdventure/assets/bar1.png");
        game.load.image("mask", "http://24haowan-cdn.shanyougame.com/CubeAdventure/assets/mask.png");
        game.load.spritesheet("number_white", "http://24haowan-cdn.shanyougame.com/CubeAdventure/assets/number_white.png", 58, 75);
        game.load.spritesheet("number_black", "http://24haowan-cdn.shanyougame.com/CubeAdventure/assets/number_black.png", 58, 75);

        //人物
        // game.load.image('p1','/images/CubeAdventure/squareImage/people/p1.png');
        // http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/people/p1.png
        game.load.atlasJSONArray('people','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/people/people.png','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/people/people.json');

        //主界面背景
        game.load.image('start_pic','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/' + device + '/start/start_pic.png');
        
        //按钮元素
        game.load.atlasJSONArray('button','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/button/button.png','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/button/button.json');
        // game.load.image('start_game','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/button/start_game.png');
        // game.load.image('select_people','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/button/select_people.png');
        // game.load.image('rank_btn','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/button/rank_btn.png');
        // game.load.image('play_again','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/button/play_again.png');
        // game.load.image('more_game','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/button/more_game.png');

        //加载音乐
        // game.load.audio('music_1', '/image/CubeAdventure/squareImage/audio/music_1.mp3'); 
        game.load.audio('music_1', 'http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/audio/music_1.mp3');
        game.load.audio('music_jump','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/audio/music_jump.mp3');
        game.load.audio('music_btn', 'http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/audio/music_btn.mp3');
        game.load.audio('music_die', 'http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/audio/music_die.mp3');
    };
    this.create = function() {
        //改变宽度
        $('.change').css('width',$('canvas').width());
        game.state.start('create');
    }
};

//菜单页面
game.States.create = function() {
    this.create = function(){
        music_btn = game.add.audio('music_btn');
        musicBox = game.add.audio('music_1');
        musicJump = game.add.audio('music_jump');
        musicDie = game.add.audio('music_die');
        var a = game.add.sprite(0, 0, "mask");
        game.physics.startSystem(Phaser.Physics.P2JS);
        game.physics.p2.gravity.y = 1500;
        game.physics.p2.setImpactEvents(true); // 开启冲撞计算
        game.physics.p2.restitution = 0.6; // 碰撞反弹系数
        game.physics.p2.defaultFriction = 0; // 默认摩擦力
        game.physics.p2.friction = 0; // 摩擦力
        game.physics.p2.updateBoundsCollisionGroup(); // 使用自定义边界元素
        collisionGroup.pixelCollisionGroup = game.physics.p2.createCollisionGroup();
        collisionGroup.barsCollisionGroup = game.physics.p2.createCollisionGroup();
        collisionGroup.spikeCollisionGroup = game.physics.p2.createCollisionGroup();
        collisionGroup.limbCollisionGroup = game.physics.p2.createCollisionGroup();
        collisionGroup.propCollisionGroup = game.physics.p2.createCollisionGroup();
        spikes = new Spikes();
        // 创建上下左右的黑边
        (function() {
            var b = function(c, d) {
                game.physics.p2.enable(c, isDebug);
                c.body.kinematic = true; // 开启运动模式
                c.body.setCollisionGroup(collisionGroup.barsCollisionGroup); // 设置碰撞组
                c.body.collides([collisionGroup.pixelCollisionGroup]); // 设置碰撞的对象
                c.id = d // 设置id
            };
            bars = game.add.group();
            b(bars.create(240, 0 - 25, "bar0"), "bar0");
            b(bars.create(0 + 40 - 55, 400, "bar1"), "bar1");
            b(bars.create(240, 800 + 25, "bar0"), "bar2");
            b(bars.create(480 - 40 + 55, 400, "bar1"), "bar3")
        })();
        
        gameState = "GameStart";
        GameStartScene.start();
        
    };
    this.update = function() {
        //开始游戏后根据坐标判断碰撞
        if (gameState == "GameRunning" && prop && hasProp == true) {
            if (Math.abs(dPixel.body.x - prop.body.x) < prop.body.width*0.8 && Math.abs(dPixel.body.y - prop.body.y) < prop.body.height*0.8) {
                GameRunningScene.hitProp();
            }
        }
    }
};


game.state.add('boot',game.States.boot);
game.state.add('preload',game.States.preload);
game.state.add('create',game.States.create);
game.state.start('boot');

// debug模式
var isDebug = false;
// 场景
var Scene = {
    GameStart: {},
    GameRunning: {},
    GameOver: {}
};
var gameState; // 游戏状态
var lastGameState; // 最近游戏状态
var gameStep = 0; // 游戏步数
var direction; // 运动方向
var maxScore = 0; // 最高分
try {
    maxScore = (localStorage.boncybitMaxScore != undefined) ? localStorage.boncybitMaxScore : 0
} catch (e) {}
var score; // 得分
var dPixel; // 方块
var spikes; // 尖刺组
var bars; // 工具栏
var collisionGroup = {}; // 碰撞体组
var bit = 7; // 无用参数
var isChange = false;
var currentScore = 0;
var Scene = {
    nextScene: "",
    next: function() {
        this.clear();
        window[this.nextScene].start()
    },
    clear: function() {}
};
var best = [0,9,16,21,29];
function initPeople(num) {
    //传入动物个数
    $('.change li').remove();
    var str = '';
    //前五个角色
    for(var i=1;i<=num;i++) {
        str += '<li><img src="http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/people/p' + i + '.png" alt=""><span style="display:block">' + ((i!=1)?('Best:' + best[i-1]):"&nbsp;") + '</span></li>';
    }
    if(num<5) {
        for(var i=num+1;i<=5;i++) {
            str += '<li select="no"><img src="http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/people/b' + i + '.png" alt=""><span style="display:block">Best:' + best[i-1] + '</span></li>'
        }
    }
    //猫咪单独判断
    if(isAttention == 'yes') {
        str += '<li><img src="http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/people/p6.png" alt=""><span style="display:block">&nbsp;</span></li>';
    } else {
        str += '<li select="no"><img src="http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/people/b6.png" alt=""><span style="display:block">&nbsp;</span></li>'
    }

    $('.change ol').append(str);
    $('.change li').eq(0).addClass('on');
    //绑定事件 
    //选择人物
    $('.change ol li').on('click',function(){
        if($(this).attr('select') == 'no') {
            alert('未解锁该人物哟~');
        } else {
            $('.change .on').removeClass('on');
            $(this).addClass('on');
        }
    });
    $('.change .select').on('click',function(){
        music_btn.play();
        peopleType = $('.change .on').index()+1;
        GameStartScene.changePixel(peopleType);
        $('.change').hide();
        $('.select_bg').hide();
    });
}

//人物解锁接口
function getPeople(num) {
    num = num || 0;
    if(num<9) {
        return 1;
    } else if(num<16) {
        return 2;
    } else if(num<21) {
        return 3;
    } else if(num<29) {
        return 4;
    } else {
        return 5;
    }
}

//获得徽章
function getBadge(score) {
    if(score>=21) {
        return 1;
    } else if(score>=16) {
        return 2;
    } else if(score>=9) {
        return 3;
    } else {
        return 0;
    }
}
// 游戏开始
var colors = ['#2128b1','#5021b1','#21acc1','#bb20b2'];
var currentColor = 0;
GameStartScene = $.extend({}, Scene, {
    nextScene: "GameRunningScene",
    title: {},
    startTips: {},
    changePeople: {},
    pixel: {},
    start_pic:{},
    rank_btn:{},
    start: function() {
        //选择人物界面
        initPeople(getPeople(max_score));
        //背景图
        this.start_pic = game.add.image(0,0,"start_pic");
        this.start_pic.width = 480;
        this.start_pic.height = 800;
        // 设置背景色
        currentColor = Math.floor(Math.random()*4);
        game.stage.backgroundColor = colors[currentColor];
        // 添加弹力小方块
        this.pixel = game.add.sprite(game.world.width / 2, game.world.height / 2+40, 'people',"p"+peopleType+'.png');
        this.pixel.anchor.setTo(0.5, 0.5);
        var a = this;
        this.startTips = game.add.button(game.world.centerX, 500, "button",function(){
            music_btn.play();
            gameState = "GameRunning";
            a.next()
        },this,'','start_game.png');
        this.startTips.scale.setTo(0.8);
        //改变人物
        this.changePeople = game.add.button(game.world.centerX-100,600,"button",function(){
            music_btn.play();
            $('.change').show();
            $('.select_bg').show();
        },this,'','select_people.png');
        this.changePeople.scale.setTo(0.8);
        this.rank_btn = game.add.button(game.world.centerX+100,600,"button",function(){
            music_btn.play();
            //打开排行榜
            showRankBox();
        },this,'','rank_btn.png');
        this.rank_btn.scale.setTo(0.8);
        this.startTips.anchor.setTo(0.5);
        this.changePeople.anchor.setTo(0.5);
        this.rank_btn.anchor.setTo(0.5);
        spikes.recycleSpikes(0);
        spikes.recycleSpikes(1);
        // 设置点击开始事件
    },
    changePixel:function(type){
        peopleType = parseInt(type);
        game.world.remove(this.pixel);
        this.pixel = game.add.sprite(game.world.width / 2, game.world.height / 2+40, 'people',"p"+type+'.png');
        this.pixel.anchor.setTo(0.5, 0.5);
    },
    clear: function() {
        // 隐藏平台
        hiddenLabel();
        $('.change').hide();
        game.world.remove(this.rank_btn);
        game.world.remove(this.start_pic);
        game.world.remove(this.title);
        game.world.remove(this.changePeople);
        game.world.remove(this.startTips);
        game.world.remove(this.pixel);
        game.input.onDown.removeAll()
    }
});
//改变人物
var peopleType = 1;
function initdPixel(type) {
    dPixel = game.add.sprite(game.world.width / 2, game.world.height / 2+40, 'people',"p"+type+'.png');
}
// 游戏进行中
GameRunningScene = $.extend({}, Scene, {
    nextScene: "GameOverScene",
    scoreBoard: {},
    start: function() {
        
        // 添加弹力小方块
        initdPixel(peopleType);
        dPixel.anchor.setTo(0.5, 0.5);
        game.physics.p2.enable(dPixel, isDebug);
        dPixel.body.collideWorldBounds = true; // 与边界碰撞
        // change size
        // dPixel.scale.setTo(2);
        dPixel.body.setRectangleFromSprite(dPixel);
        dPixel.body.setCollisionGroup(collisionGroup.pixelCollisionGroup);

        // 设置和边界碰撞事件
        dPixel.body.collides(collisionGroup.barsCollisionGroup, this.hitBars, this);
        // 设置和尖刺碰撞事件
        dPixel.body.collides(collisionGroup.spikeCollisionGroup, function(f, d) {
            this.hitSpikes(f, d);
        }, this);
        //重置重力
        game.physics.p2.gravity.y = 1500;
        dPixel.body.damping = 0; // 速度衰减
        dPixel.body.id = "dPixel";
        dPixel.body.step = gameStep;
        // 设置左右两边边界碰撞属性
        this.resetCollide();
        // 设置方块初始速度
        dPixel.body.velocity.x = 250;
        dPixel.body.velocity.y = -650;
        score = 0;
        isChange = false;
        // 创建得分显示面板
        this.scoreBoard = new PixelNumber(game.world.centerX, 130, "number_black", score, 0.5);
        spikes.setSpikes(1);
        direction = 1; // 运动方向
        // 添加点击弹跳事件
        game.input.onDown.add(this.pixelJump,this)

    },
    clear: function() {
        game.world.remove(prop);
        this.scoreBoard.remove();
        game.input.onDown.removeAll();
        hasProp = false;
    },
    hitSpikes: function(b, a, c) {
        if (gameState == "GameRunning" && gameStep == b.step) {
            gameStep++;
            gameState = "GameOver";
            this.next()
        }
    },
    hitBarsFun: null,
    hitBars: function(b, a) {
        var c = this;
        if (this.hitBarsFun == null) {
                this.hitBarsFun = setTimeout(function() {
                    var d, f;
                    direction == 1 ? (d = 0, f = 1, direction = 0) : (d = 1, f = 0, direction = 1);
                    if (gameState == "GameRunning") {
                        musicBox.play();
                        //music播放
                        score++;
                        c.createProp();
                        c.scoreBoard.setNumber(score);
                        spikes.setSpikes(d);
                        spikes.recycleSpikes(f);
                    }
                    c.hitBarsFun = null
                }, 20)
        }
    },
    createProp: function() {
        //如果改变状态，3分后reset回去
        var self = this;
        if(isChange) {
            if(score-currentScore>=3) {
                setTimeout(function(){
                    self.resetPixel();
                    isChange = false;
                },300);
            }
        }
        //每5分出现一个星星
        if(prop) {
            if(!prop.alive) {
                hasProp = false;
            }
        }
        if(gameState == "GameRunning" && score && score%5 == 0 && !hasProp ) {
            new Prop().create();
            hasProp = true;
        } 
    },
    //重置状态
    resetPixel: function() {
        dPixel.scale.setTo(1);
        dPixel.body.setRectangleFromSprite();
        dPixel.body.setCollisionGroup(collisionGroup.pixelCollisionGroup);
        this.resetCollide();
        game.physics.p2.gravity.y = 1500;
        setTimeout(function(){
            dPixel.body.velocity.x = dPixel.body.velocity.x>0?-250:250;
        },200);
    },
    resetCollide:function(){

        var b = game.physics.p2.createMaterial("spriteMaterial", dPixel.body);
        var a = game.physics.p2.createMaterial("spriteMaterial", bars.iterate("id", "bar1", Phaser.Group.RETURN_CHILD).body);
        var c = game.physics.p2.createContactMaterial(b, a);
        c.friction = 0;
        c.restitution = 1;
        a = game.physics.p2.createMaterial("spriteMaterial", bars.iterate("id", "bar3", Phaser.Group.RETURN_CHILD).body);
        var c = game.physics.p2.createContactMaterial(b, a);
        c.friction = 0;
        c.restitution = 1;
    },
    hitProp: function() {
        //销毁道具
        var type = prop.type;
        prop.destroy();
        hasProp = false;
        prop = null;
        isChange = true;
        currentScore = score;
        if(type == 1) {
            //变大
            dPixel.scale.setTo(1.5);
            dPixel.body.setRectangleFromSprite();
            dPixel.body.setCollisionGroup(collisionGroup.pixelCollisionGroup);

        } else if(type == 2) {
            //变小
            dPixel.scale.setTo(0.5);
            dPixel.body.setRectangleFromSprite();
            dPixel.body.setCollisionGroup(collisionGroup.pixelCollisionGroup);
        } else if(type == 3) {
            game.physics.p2.gravity.y = 1800;
        }
        this.resetCollide();
        
    },
    pixelJump: function() {
        if (gameState == "GameRunning") {
            musicJump.play();
            dPixel.body.velocity.y = -650
        }
    }
});
function resetShareText() {
    var obj = {
            share:"关注微信公众帐号，即可解锁方块猫咪",
            default:"躲开尖刺，快看你能坚持多久！",
            title:"我坚持了{score}下,打败了全国{persent}%人，快来看看你有我这么持久吗？",
            desc:"小方块被困在牢笼中，墙壁中不断出现尖刺，危险重重。帮助小方块避开尖刺，坚持到底。",
            imgUrl:"http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/sharePic.png",
    };
    return obj;
}
GameOverScene = $.extend({}, Scene, {
    nextScene: "GameStartScene",
    skull: {},
    scoreTitle: {},
    more: {},
    share: {},
    replay: {},
    limbs: {},
    maxScoreBoard: {},
    curScoreBoard: {},
    start: function() {
        // console.log(GameObj);
        musicDie.play();
        // 设置背景色
        game.stage.backgroundColor = colors[currentColor];
        // 创建骷髅头
        this.skull = game.add.sprite(dPixel.body.x, dPixel.body.y, "skull");
        this.skull.scale.setTo(0.4);
        this.skull.anchor.setTo(0.5);
        game.physics.p2.enable(this.skull, isDebug);
        this.skull.body.collideWorldBounds = true;
        this.skull.body.setCollisionGroup(collisionGroup.pixelCollisionGroup);
        this.skull.body.collides([collisionGroup.barsCollisionGroup, collisionGroup.spikeCollisionGroup]);
        this.skull.body.angle = Math.floor(Math.random() * 60 - 30);
        this.skull.body.velocity.x = dPixel.body.velocity.x;
        this.skull.body.velocity.y = dPixel.body.velocity.y;
        // 创建肢体
        this.limbs = game.add.group();
        for (var a = 0; a < 9; a++) {
            this.addLimb(this.limbs)
        }
        dPixel.body.destroy();
        game.world.remove(dPixel);
        // 设置分数标题
        var d = -40;
        $('.over_menu .score').text(score);
        if(getPeople(score)>getPeople(maxScore)) {
            alert('您已解锁新角色，快去看看吧');
            initPeople(getPeople(score));
        }
        // 设置最高分
        maxScore = (score > maxScore ? score : maxScore);
        try {
            localStorage.boncybitMaxScore = maxScore
        } catch (c) {}
        $('.over_menu .best').text(maxScore);
        //结束页面
        setGameScore(score,getBadge(score),resetShareText());
        $('#over_box').show();
        // 显示出全部的刺
        setTimeout(function() {
            //重置尖刺速度位置
            spikes.move = false;
            spikes.setAllSpikes();
            spikes.resetSpike(0);
            spikes.resetSpike(1);
        }, 100);
        // 显示添加更多游戏和再玩一次的按钮
        var b = this;
        setTimeout(function() {
            // 更多游戏按钮
            b.share = game.add.button(game.world.centerX-100, 650 + d, "button", function() {
                music_btn.play();
                location.href = "http://24haowan.shanyougame.com/main/subject";
            },this,'','more_game.png');
            b.share.scale.setTo(0.7);
            b.share.anchor.setTo(0.5);
            //排行榜
            b.more = game.add.button(game.world.centerX+100, 650 + d, "button", function() {
                music_btn.play();
                showRankBox();
                // 排行榜接口
            },this,'','rank_btn.png'); 
            b.more.scale.setTo(0.7);
            b.more.anchor.setTo(0.5);
            b.more.alpha = 0.9;
            //再来一次
            b.replay = game.add.button(game.world.centerX, 550 + d, "button", function() {
                music_btn.play();
                gameState = "GameStart";
                b.next()
            },this,'','play_again.png');
            b.replay.scale.setTo(0.7);
            b.replay.anchor.setTo(0.5);
            // 向平台提交分数
            // dp_submitScore(score);
        }, 320)
    },
    clear: function() {
        $('#over_box').hide();
        game.world.remove(this.scoreTitle);
        game.world.remove(this.more);
        game.world.remove(this.share);
        game.world.remove(this.replay);
        this.limbs.callAll("body.destroy", "body");
        this.skull.body.destroy();
        game.world.remove(this.skull);
        game.world.remove(this.limbs);
        // this.maxScoreBoard.remove();
        // this.curScoreBoard.remove()
    },
    addLimb: function(a) {
        limb = a.create(dPixel.body.x, dPixel.body.y, "limb");
        limb.scale.setTo(0.5);
        limb.anchor.setTo(0.5, 0.5);
        game.physics.p2.enable(limb, isDebug);
        limb.body.velocity.x = rand(-40, 40);
        limb.body.velocity.y = rand(-40, 40);
        limb.body.setCollisionGroup(collisionGroup.limbCollisionGroup);
        limb.body.collides([collisionGroup.pixelCollisionGroup, collisionGroup.spikeCollisionGroup, collisionGroup.barsCollisionGroup, collisionGroup.limbCollisionGroup])
    }
});
//产生道具
var prop;
var hasProp = false; //是否有道具
var propList = ['big','small','heavity'];
var Prop = function() {
    this.group = game.add.group();
    this.number = 2;
};
Prop.prototype.create = function() {
    hasProp = true;
    this.type = Math.ceil(Math.random()*3);
    
    var ranX = Math.random()*(game.world.width - 50 - 50) + 50;
    prop = game.add.sprite(ranX, -10,'people', propList[this.type-1]+'.png');
    var self = this;
    prop.anchor.setTo(0.5,0.5);
    game.physics.arcade.enable(prop);
    prop.body.velocity.y = 100;
    prop.checkWorldBounds = true;
    prop.outOfBoundsKill = true;
    prop.type = this.type;
};

// 尖刺
var Spikes = function() {
    this.group = game.add.group();
    this.spikeSideNumber = 12; // 两边的尖刺最大数量
    this.move = false;
    var b;
    // 上下两边
    for (var a = 0; a < 9; a++) {
        for (var c = 0; c < 2; c++) {
            b = this.group.create(60 * a, (c == 0 ? 10 : 790), "spike");
            c == 0 ? (b.id = 100 + a) : (b.id = 100 + a + 9);
            this.initSpike(b)
        }
    }
    // 左右两边
    for (var d = 0; d < this.spikeSideNumber; d++) {
        for (var c = 0; c < 2; c++) {
            b = this.group.create((c == 0 ? 5 - 40 : 475 + 40), 60 * d + 10 + 60, "spike");
            c == 0 ? (b.id = d) : (b.id = d + this.spikeSideNumber);
            this.initSpike(b)
        }
    }
};
Spikes.prototype.initSpike = function(a) {
    a.anchor.setTo(0.5, 0.5);
    a.scale.setTo(0.5);
    game.physics.p2.enable(a, isDebug);
    a.body.angle = 45;
    a.body.kinematic = true;
    a.body.setCollisionGroup(collisionGroup.spikeCollisionGroup);
    a.body.collides([collisionGroup.pixelCollisionGroup, collisionGroup.limbCollisionGroup])
};
Spikes.prototype.setSpikes = function(c, d) {
    // 设置突出来的尖刺 c==1右边 c==0左边
    if (arguments[1] == undefined) {
        d = [];
        if (score <=3) {
            d = getRandomArray(this.spikeSideNumber, 1, 1);
        } else if(score <= 6) {
            d = getRandomArray(this.spikeSideNumber, 2, 2);
        } else if(score <= 9) {
            d = getRandomArray(this.spikeSideNumber, 3, 3);
        } else if(score <= 13) {
            d = getRandomArray(this.spikeSideNumber, 4, 4);
        } else if(score <= 17) {
            d = getRandomArray(this.spikeSideNumber, 5, 5);
        } else if(score <= 21){
            //移动
            this.move = true;
            d = getRandomArray(this.spikeSideNumber, 3, 3);
        } else if(score <= 24) {
            this.move = true;
            d = getRandomArray(this.spikeSideNumber, 4, 4);
        } else {
            this.move = true;
            d = getRandomArray(this.spikeSideNumber, 5, 5);
        }
    }
    // 播放凸出来的动画
    var self = this;
    for (var b = 0; b < d.length; b++) {
        var a = this.getSpike(d[b] + c * this.spikeSideNumber);
        game.add.tween(a.body).to({
            x: (c == 1 ? 475 : 5)
        }, 200, Phaser.Easing.Linear.None, true);
        //结束
        if(this.move) {
            !function(a){
                setTimeout(function(){
                    //速度
                    a.body.velocity.y = ((Math.random()*2>1)?1:-1) * 50;
                },200);
            }(a)
        }
    }
};
Spikes.prototype.recycleSpikes = function(c) {
    // 播放尖刺收回去的动画
    var self = this;
    for (var b = 0; b < this.spikeSideNumber; b++) {
        var a = this.getSpike(b + c * this.spikeSideNumber);
        game.add.tween(a.body).to({
            x: (c == 0 ? 5 - 40 : 475 + 40)
        }, 200, Phaser.Easing.Linear.None, true);
        //重置移动尖刺
        if(this.move) {
            setTimeout(function(){
                self.resetSpike(c);
            },200);
        }
    }
};
//重置
Spikes.prototype.resetSpike = function(tag) {
    this.move = false;
    for (var d = 0; d < this.spikeSideNumber; d++) {
        var id = (tag) ? (d+this.spikeSideNumber) : d;
        var spike = this.getSpike(id);
        spike.body.velocity.y = 0;
        spike.body.y = 60 * d + 10 + 60;
    }
}; 
Spikes.prototype.setAllSpikes = function() {
    // 显示全部尖刺
    var b = new Array(this.spikeSideNumber);
    for (var a = 0; a < this.spikeSideNumber; a++) {
        b[a] = a
    }
    this.setSpikes(0, b);
    this.setSpikes(1, b)
};
Spikes.prototype.getSpike = function(a) {
    // 获取尖刺对象
    return this.group.iterate("id", a, Phaser.Group.RETURN_CHILD)
};

// 获取随机数组
var getRandomArray = function(h, c, g) {
    var f = function(j, i) {
        return (Math.random() > 0.5 ? (-1) : 1)
    };
    if (arguments[1] == undefined || arguments[2] == undefined) {
        c = 2, g = 10
    }
    var b = Math.floor(Math.random() * (g - c)) + c;
    var d = new Array(h);
    for (var a = 0; a < h; a++) {
        d[a] = a
    }
    d.sort(f);
    return d.slice(0, b)
};
// 获取范围内随机数
var rand = function(d, c) {
    return Math.floor((c - d) * Math.random() + d)
};

// 像素分数面板
var PixelNumber = function(a, f, b, c, d) {
    this.numbers = game.add.group();
    this.x = a;
    this.y = f;
    this.numberWidth = 58;
    this.image = b;
    this.alpha = d;
    this.setNumber(c)
};
PixelNumber.prototype.setNumber = function(g) {
    this.remove();
    var a = g.toString();
    var d = g.toString().length;
    var b = this.x - (d / 2) * this.numberWidth + this.numberWidth / 2;
    for (var c = 0; c < a.length; c++) {
        var f = this.numbers.create(b + this.numberWidth * c, this.y, this.image);
        f.anchor.setTo(0.5, 0.5);
        f.alpha = this.alpha;
        f.frame = parseInt(a[c])
    }
};
PixelNumber.prototype.remove = function() {
    this.numbers.removeAll()
};