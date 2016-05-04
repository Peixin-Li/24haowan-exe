<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>抽奖页面</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0, user-scalable=no" >
	<meta name="renderer" content="webkit">
	<style>
	* { margin: 0; padding: 0;}
	body {
	    background-color: #fdd22e;
	    font-family: "Microsoft YaHei";
	    height: 100%;
	}
	html, body {
		height: 100%;
	}
	#dowebok {
		/*width: 300px;
		height: 300px;*/
		z-index: 91;
		position:absolute;
		top: 50%;
		left: 50%;
		-webkit-transform:translateY(-50%) translateX(-50%);
		transform:translateY(-50%) translateX(-50%);
		background:url(http://24haowan-cdn.shanyougame.com/lucky_gift_images/ly-plate-c.gif) no-repeat center center;
		background-size: cover;
	}
	.plate {
		position: relative;
		width: 100%;
		height: 100%;
		margin: 0 auto;
		background:url(http://24haowan-cdn.shanyougame.com/lucky_gift_images/lyplate.png) no-repeat center center;
		background-size: cover;
	}
	#plateBtn {
		position: absolute;
	    top: 23%;
	    left: 22%;
	    width: 55%;
	    height: 55%;
		margin: 0 auto;
		background:url(http://24haowan-cdn.shanyougame.com/lucky_gift_images/rotate-static.png) no-repeat center center;
		background-size: cover;
		transition: all 3s ease-in-out 0;
	}
	</style>
</head>
<body>
	<div id="mask"></div>
	<!-- //转盘 -->
	<div id="dowebok">
		<div class="plate">
			<div id="plateBtn" href="javascript:" title="开始抽奖" style=""></div>
		</div>
	</div>
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
</body>
</html>
	<script type="text/javascript">
		var innerWidth = (window.innerWidth<window.innerHeight)?window.innerWidth:window.innerHeight;
		//抽奖页面适应屏幕宽度
		innerWidth = (innerWidth>document.body.clientWidth)?document.body.clientWidth:innerWidth;
		$('#dowebok').css({'width':innerWidth*0.9,'height':innerWidth*0.9});

		var gift_list = <?php echo $gift_list ?>;
		var user_gift = '<?php echo $user_gift ?>';
		var time = '<?php echo empty($time)?"":$time ?>';
		var star = true;
		var hasDraw = false;
		if(!!gift_list.length && !!user_gift.trim()) {
			star = false;
			//玩家未关注公众号
		} else if(!!!gift_list.length && !!user_gift.trim()) {
			hasDraw = true;
			//玩家已经抽过奖品
		}
		//抽奖页面适应屏幕宽度
		var diwebokWidth = $('#dowebok').width();
		$('#dowebok').css('height',diwebokWidth);
		var cantap = true; //监控当前是否可以重复点击
		var transitionEvent = whichTransitionEvent(); //兼容前缀
		
		$('#plateBtn').on(transitionEvent,function(){
			cantap = true;
		}); //动画完成后可继续点击

		var tip = localStorage.tip,items = ['口袋机战超值礼包','合金先锋纪念笔','高达机甲扭蛋','手机指环支架','口袋机战专属VIP账号'];
		$('#plateBtn').on('tap',function(){
			if(cantap) {
				if(star) {
					if(hasDraw == true) {
						alert('你已经抽过奖了哟,奖品是:' + items[user_gift||tip] + ((time)?(' 抽奖时间：' + time):""));
					} else {
						hasDraw = true;
						var dom = $(this);
						tip = getReward();
						while(parseInt(gift_list[tip]) <= 0) {
							tip = getReward();
						}
						var rotate = getRotate(tip) + 180; //初始位置是180度
						time = new Date().toLocaleString();
						localStorage.setItem('HasDraw','true');
						localStorage.setItem('tip',tip);
						cantap = false;
						dom.css({'transition':'none','-webkit-transform':'rotate(0deg)'});
						$('body').height();//强制刷新css
						dom.css({'transition':'all 5s ease-in-out','-webkit-transform':'rotate(' + rotate + 'deg)'});
						$.ajax({
							url:"/ajax/SendLuckyGift",
							data:{"num":tip},
							dataType:"json", 
							type:"POST",
							success:function(data){
								if(data['code']==0){
									setTimeout(function(){
										alert(time + ' 你的奖品是:' + items[tip]);
									},5000);
								} 
							},
							error:function(err){
								console.log(err);
							}
						});
					}
				} else {
					alert('请先关注公众号再抽奖');
				}
			}
		});
		function getReward() {
			var random = Math.random();
			if (random <= 0.35) { // 合金先锋纪念笔
				return 1;
			} else if (random <= 0.5) { // 高达机甲扭蛋  
				return 2;
			} else if (random <= 0.7) { // 手机指环支架 
				return 3;
			} else if (random <= 0.8) { // 口袋机战专属VIP账号
				return 4
			} else { // 口袋机战超值礼包
				return 0;
			}
			// return 0;
		}
		var minRotate = 360*5;
		function getRotate(num) {
			switch (num) {
				case 1 :
				return minRotate + getRandom(-20,20);
				break;
				case 2 :
				return minRotate + getRandom(40,80);
				break;
				case 3 :
				return minRotate + getRandom(100,140);
				break;
				case 4 :
				return minRotate + getRandom(160,200);
				break;
				case 0 :
				return minRotate + getRandom(220,260);
			}
		}
		function getRandom(min,max) {
			return Math.floor(Math.random()*(max-min) + min) ;
		}
		function whichTransitionEvent(){
		    var t;
		    var el = document.createElement('fakeelement');
		    var transitions = {
		      'transition':'transitionend',
		      'OTransition':'oTransitionEnd',
		      'MozTransition':'transitionend',
		      'WebkitTransition':'webkitTransitionEnd'
		    }

		    for(t in transitions){
		        if( el.style[t] !== undefined ){
		            return transitions[t];
		        }
		    }
		}

	</script>