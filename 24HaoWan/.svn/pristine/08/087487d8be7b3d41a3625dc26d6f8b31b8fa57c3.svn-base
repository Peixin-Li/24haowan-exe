<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title><?php echo empty($this->game_name)?"24好玩游戏":$this->game_name ?></title>
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/game.css">
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/over.css">
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/over-btn.css">
	<link rel="stylesheet" href="http://24haowan-cdn.shanyougame.com/platform/css/rank.css">
	<link rel="stylesheet" type="text/css" href="http://24haowan-cdn.shanyougame.com/platform/css/GameOver.css">
	<script type="text/javascript" src="http://24haowan-cdn.shanyougame.com/public/js/zepto.js"></script>
	<script type="text/javascript" src = "http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
	<div class="start-img">
		<span class="start-text">每24小时，一款精彩小游戏</span>
	</div>
	<footer class="foot">
		<div class="bg"></div>
		<div class="foot-box">
			
		</div>
	</footer>
	
	<?php echo $content; ?>

	<!-- 结束页面 -->
	<div class="over-box">
		<div class="top-hint">
			<img src="http://24haowan-cdn.shanyougame.com/platform/images/share.png" alt="">点击右上角，炫耀我找到的单身狗
		</div>
		<div class="data-box">
			<div class="pic-box">
				<img class="over-bg" src="http://24haowan-cdn.shanyougame.com/platform/images/over-box.png" alt="">
				<img class="badge" src="http://24haowan-cdn.shanyougame.com/platform/images/badge_1.png"></img>
				<div class="left-box">
					<div class="headImg" style=""></div>
					<span class="badge-text"></span>
				</div>
				<div class="right-box">
					<div class="label-score">得分</div>
					<div class="score"></div>
					<div class="label-max-score">最高分</div>
					<div class="max-score"></div>
				</div>
				<span class="data-text"></span>
			</div>

		</div>
		<div class="menu">
			<span class="play-again"><img src="http://24haowan-cdn.shanyougame.com/platform/images/playagain.png" alt=""></span>
			<span class="rankBtn"><img src="http://24haowan-cdn.shanyougame.com/platform/images/rank.png" alt=""></span>
			<span class="more-game"><img src="http://24haowan-cdn.shanyougame.com/platform/images/more.png" alt=""></span>
		</div>
	</div>
	<!-- 结束页面2 -->
	<!-- 背景蒙版 -->
	<div class="background-box"></div>
	<div id="over_box">
		<div class="top-text"></div>
		<div class="over_menu">
			<div class="head_img">
				<img class="headimg" src="" alt="">
				<img class="img_border" src="" alt="">
			</div>
			<div class="score_box">
				<div class="center_box">
					<p class="score"></p>
					<p class="best"></p>
					<p class="win"></p>
				</div>
			</div>
		</div>
		<!-- 结束页面的按钮 -->
		<div class="over-btn-container">
			<div class="over-btn-replay"></div>
			</br>
			<div class="over-btn-more"></div>
			<div class="over-btn-rank"></div>
		</div>
	</div>

	

	<!-- 背景蒙版 -->
	<div class="background-box"></div>
	<!-- 排行榜组件 -->
	<div class="rank-box" >
		<div class="rank">
			<div class="close"></div>
			<div class="myself">
				<h3>我的排名</h3>
				<div class="data-box">
					<span class="rank-num"></span>
					<span class="headImg"><img src="" alt=""></span>
					<div class="data">
						<span class="name"></span>
						<span class="score"></span>
						<span class="win"></span>
					</div>
				</div>
			</div>
			<div class="player-list">
				<h3 class="player-num"></h3>
				<ol id="player-box"></ol>
			</div>
		</div>
	</div>
	
	<!-- 分享文案 -->
	<div class="share-text">
		点击右上角<br/>
		即可分享给你的微信朋友或朋友圈
	</div>
	
	<script type="text/javascript">

		

		//初始化参数
		var gameId = '<?php echo empty($this->game_id)?"":$this->game_id ?>'; //游戏id
		var user_result = '<?php echo empty($this->user_result)?"":$this->user_result ?>'; //该游戏的用户数据
		var max_score = ''; //最大分数
		var headImgUrl = '<?php echo  empty($this->headimgurl)?"":$this->headimgurl?>'; //用户头像链接
		var max_badge = '<?php echo empty($this->badge)?"":$this->badge ?>'; // 该游戏用户奖牌最高等级
		var borderColor = '#000'; //默认头像边框颜色。
		var device_type = '';
		var isAttention = '<?php echo empty($this->is_attention)?"":$this->is_attention ?>';
		if(user_result != 'null') {
			var stage = JSON.parse(user_result).stage?JSON.parse(user_result).stage:1;
			var last_score = JSON.parse(user_result).last_score?JSON.parse(user_result).last_score:0;
		}

		if(headImgUrl) {
			new Image().src=headImgUrl;
		}
		$(function() {
			function judgeBowser() {
				var ua = navigator.userAgent.toLowerCase();
				if (ua.match(/MicroMessenger/i)=="micromessenger" && ua.indexOf('iphone') > 0) { 
			         // alert("iPhone 微信浏览器");
			         device_type = 'wx_ios';
			    }else if (ua.match(/MicroMessenger/i)=="micromessenger" && ua.indexOf('android') > 0) { 
			         // alert("Android 微信浏览器");
			         device_type = 'wx_android';
			    }
			    else if( ua.indexOf('iphone') > 0) { //需对所有 iOS 系统 UA 信息进行判断 
			         // alert("iPhone 浏览器");
			         device_type = 'iphone_browser';
			    }else if (ua.indexOf('android') > 0) { //需对所有 Android 系统 UA 信息进行判断 
			         // alert("Android 浏览器");
			         device_type = 'android_browser';
			    }else{ 
			         // alert("未识别");
			         device_type = 'do not judge';
			    } 
			}


			//初始化底部菜单数据
			function init() {
				judgeBowser();
				var str = '';
				borderColor = changeBorderColor(max_badge);
				// alert(user_result);
				if(user_result != 'null' && user_result['score'] != 0) {
					//存在历史记录
					user_result = JSON.parse(user_result);
					max_score = user_result['score'];
					str += '<span class="foot-headImg" style="background-image: url(' + headImgUrl + ');border-color:' + borderColor +'"></span>';
					str += '<span class="max-score">最高分:' + max_score + '</span>';
					if(user_result['persent'] != 0) {
						str += '<span class="win">打败了' + user_result['persent'] + '%的人</span>';
					}
					$('.foot-box').append(str);
				} else {
					//不存在历史记录
					$('.foot').css('display','none');
				}
			}
			init();
			//修改头像边框颜色
			function changeBorderColor(badge) {
				badge = badge || 0;
				if( badge == 1) {
					return "#f8e71c";
				} else if(badge == 2) {
					return "#dcdfe3";
				} else if(badge == 3) {
					return "#ba6e40";
				}
			}
			//排行榜出现与隐藏交互
			//排行榜隐藏
			$('.rank-box .close').on('click',function() {
				$('.rank-box').animate({"margin-top":"20px","opacity":0},200,'ease-in',function(){
					var bgbox = $('.background-box');
					if($('.over-box').css('display') == 'block') {
						bgbox.css('z-index','65');
					} else {
						bgbox.css({'display':'none','z-index':'65'});
					}
					$('.rank-box').css('display','none');
				});
			});
			//排行榜出现
			$('.rankBtn').on('click',function() {
				showRankBox();
			});
			//再玩一次事件触发
			$('.play-again').on('click',function(){
				againFun && againFun();
				$('.background-box').hide();
				$('.over-box').hide();
			});

			function loadImg(src) {
				var loadImage = new Image();
				loadImage.src = src;
			}

			var ImgSrc = ['http://24haowan-cdn.shanyougame.com/platform/images/badge_1.png','http://24haowan-cdn.shanyougame.com/platform/images/badge_2.png','http://24haowan-cdn.shanyougame.com/platform/images/badge_3.png'];
			ImgSrc.forEach(function(key){loadImg(key);});
		});
		//开始游戏隐藏上下标签的接口 
		function hiddenLabel() {
			$('.foot').animate({'bottom':-$('.foot').height()},500,'ease-in');
		}

		//再玩一次游戏接口
		var againFun;
		function setFunction(obj) {
			againFun = obj || null;
		}

		//提交分数ajax接口
		var currentScore = 0;
		function setScore(score,badge) {
			
			var borderColor = '#000';
			var obj = {
				default: "快来聚集单身狗力量，寻找节日主角！",
				title: "",
				desc:"你眼中只有恩！爱！狗！",
				imgUrl:"http://24haowan-cdn.shanyougame.com/FindSingle/subject_logo.png"
			}
			//将狗头根据分数修改，将
			if(badge == 1) {
				borderColor = '#f8e71c';
				$('.badge-text').text('金牌');
				$('.over-box .badge').attr('src','http://24haowan-cdn.shanyougame.com/platform/images/badge_1.png');
				obj.desc = '骚年，过来亲一口！';
			} else if(badge == 2) {
				borderColor = '#DCDFE3';
				$('.badge-text').text('银牌');
				$('.over-box .badge').attr('src','http://24haowan-cdn.shanyougame.com/platform/images/badge_2.png');
				obj.desc = '哎哟！不错哦！';
			} else  if(badge == 3) {
				borderColor = '#BA6E40';
				$('.badge-text').text('铜牌');
				$('.over-box .badge').attr('src','http://24haowan-cdn.shanyougame.com/platform/images/badge_3.png');
			} else {
				$('.over-box .badge').attr('src','http://24haowan-cdn.shanyougame.com/platform/images/badge_3.png');
			}
			$('.over-box .score').text(score);
			$('.over-box .headImg').css({'background-image':'url(' + headImgUrl + ')','border-color':borderColor});
			$.ajax({
				url: '/ajax/commitscore',
				dataType: "json",
				data: {"game_score":score,"game_id":gameId,"badge":badge,"device_type":device_type},
				type:"post",
				success:function(data) {
					var data = data['data'];
					//数据显示
					var str = '';
					if(data['is_new_recode']) {
						$('.over-box .label-max-score').css('background-image','url(http://24haowan-cdn.shanyougame.com/platform/images/new.png)');
						$('.over-box .max-score').text(score);
					} else {
						$('.over-box .max-score').text(max_score);
					}
					var dataText = '';
					if(data['persent'] != 0) {
						dataText = '打败' + data['persent'] + '%人,';
					}
					$('.over-box .data-text').text(dataText + '当前排名：'+data['rank']);
					// $('.background-box').show();
					$('.over-box').show();

					// 设置分享标题
					currentScore = score;
					if(parseInt(score) == 0) {
						var text = '快来聚集单身狗力量，寻找节日主角！';
					} else {
						var text = '我找到了' + currentScore +'只单身狗，打败了全国'+data['persent']+'%的人，快来聚集单身狗力量！'
					}
					obj.title = text;
					wxReady(obj);
				},
				error:function(err) {
					console.log('error' + err);
				}
			});
		}

		function setGameScore(score,badge,obj,level, update) { 
			/*
				obj = {
					share:"",
					default:"",
					title:"{score}  {persent},  " //{score}替换成分数 {persent}替换成百分比
					desc:"描述",  无替换
					link:"",
					imgUrl:"",
				}
			*/
			level = level || null;
			obj = obj || {};
			$.ajax({
				url: '/ajax/commitscore',
				dataType: "json",
				data: {"game_score":score,"game_id":gameId,"badge":badge,"device_type":device_type,"stage":level},
				type:"post",
				success:function(data) {
					var data = data['data'];
					//数据显示
					$('#over_box .headimg').attr('src',headImgUrl);
					var str = '';
					$('#over_box .top-text').text(obj.share || '点击右上角可以了解最新游戏哟~');
					if(data['is_new_recode']) {
						badge && $('#over_box .img_border').attr('src','http://24haowan-cdn.shanyougame.com/CubeAdventure/squareImage/mobile/over/border_' + badge + '.png');
						$('#over_box .best').text(score);
					} else {
						$('#over_box .best').text(max_score);
					}
					//更新分数
					if(update != false) {  
						$('#over_box .score').text(score);
						$('#over_box .win').text(data['persent']);
						if(parseInt(score) == 0) {
							obj.title = obj.default;
						} else {
							obj.title = obj.title.replace('{score}',score).replace('{persent}',data['persent']);
						}
						wxReady(obj);
					}
					var dataText = '';
					currentScore = score;
					
				},
				error:function(err) {
					console.log('error' + err);
				}
			});
		}

		//隐藏开始页面
		function hiddenImg() {
			$('.start-img').animate({'opacity':0},500,'ease-in',function(){
				$('.start-img').css('display','none');
			});
		}
		//微信接口
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
				    link:  location.href.slice(0,(location.href.indexOf('?')>-1)?location.href.indexOf('?'):location.href.length) + '?from_user=<?php echo Yii::app()->session["user_id"] ?>', // 分享链接
				    imgUrl: imgUrl, // 分享图标
				    success: function () { 
				       // 用户确认分享后执行的回调函数
				       var data = "openid="+openid+"&type=cfriend";
				       var url = "http://glgl-dev.shanyougame.com/ajax/commitShare";
				       var xhr = new XMLHttpRequest();
					   xhr.open('post',url,true);
					   //that's ok
					   xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					   xhr.onreadystatechange = function() {
					       if(xhr.readyState == 4) {
					           if(xhr.status == 200) {
					           } else {
					           }
					       }
					   }
					   xhr.send(data);
				    },
				    cancel: function () { 
				    }
				});
			    
			    //分享朋友
				wx.onMenuShareAppMessage({
				    title: text, // 分享标题
				    desc: desc, // 分享描述
				    link: location.href.slice(0,(location.href.indexOf('?')>-1)?location.href.indexOf('?'):location.href.length) + '?from_user=<?php echo Yii::app()->session["user_id"] ?>', // 分享链接
				    imgUrl: imgUrl, // 分享图标
				    type: 'link', // 分享类型,music、video或link，不填默认为link
				    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
				    success: function () {
				        // 用户确认分享后执行的回调函数
				       var data = "openid="+openid+"&type=friend";
				       var url = "http://glgl-dev.shanyougame.com/ajax/commitShare";
				       var xhr = new XMLHttpRequest();
					   xhr.open('post',url,true);
					   //that's ok
					   xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					   xhr.onreadystatechange = function() {
					       if(xhr.readyState == 4) {
					           if(xhr.status == 200) {
					               // alert('1'+xhr.responseText);
					           } else {
					               // alert('2'+xhr.status);
					           }
					       }
					   }
					   xhr.send(data);
				    },
				    cancel: function () { 
				        // 用户取消分享后执行的回调函数
				    }
				});
			  });
		  }

		  $('.more-game').on('click',function(){
		  	location.href="http://mp.weixin.qq.com/s?__biz=MzI1MDA3NDY1OQ==&mid=400789457&idx=1&sn=125f862c70b6b55c843d00201829ec75#rd";
		  });
		  function showRankBox() {
		  	addRankBox(gameId);
			$('.background-box').css({'z-index':$('.rank-box').css('z-index')-1,'display':'block'});
			$('.rank-box').css('display','block').animate({"margin-top":"40px","opacity":1},200,'ease-in');
		  }
		  //排行榜ajax接口
			function addRankBox(gameId) {
				$.ajax({
					url: '/ajax/GetRank',
					dataType:"json",
					data: {'game_id': gameId},
					type: "post",
					success:function(data) {
						if (!data['code']) {
							data = data['data'];
							var user_result = data['user_result'];
							var rank_list = data['rank_list'];
							$('.player-num').text('共' + data['total_count'] + '名玩家');
							//我的排名
							$('.myself .rank-num').text(user_result['rank']);
							$('.myself .headImg img').attr('src',user_result['headimgurl']);
							$('.myself .name').text(user_result['name']);
							$('.myself .score').text(user_result['score']).css('top','40%');
							$('.myself .win').text('前' + (100-parseInt(user_result['persent'])) + '%').css('bottom','20%');
							//玩家排名列表
							var str = '';
							for(var i=0,len=rank_list.length;i<len;i++) {
								var obj = rank_list[i];
								str += '<li><div class="data-box"><span class="rank-num">' + (i+1) + '</span>';
								str += '<span class="headImg"><img src="' + obj['headimgurl'] + '" alt=""></span>';
								str += '<div class="data"><span class="name">' + obj['name'] + '</span>';
								str += '<span class="score">' + obj['score'] +'</span></div></div></div>';
							}
							$('.player-list ol').empty().append(str);

						}
					},
					error: function(err) {
						console.log('error:' + err);
					}
				});
			}
	</script>
</body>
</html>