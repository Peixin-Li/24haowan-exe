$(document).ready(function(){

	var oBtn = document.getElementById('btn');
	var aA = oBtn.getElementsByTagName('a');
	// var aA = $('#btn a');
	var aImg = $('#img-contain ul img');
	var oUl = $('#img-contain ul')[0];
	var aLi = $('#img-contain ul li');
	var imgWidth = 1920;
	$('#img-contain ul').css('width',aImg.length*imgWidth+'px');

	function toReSize(){
		var viewWidth = document.documentElement.clientWidth;
		if(viewWidth > 1000){
			for(var i=0; i<aImg.length; i++){
				aImg[i].style.left = -(imgWidth - viewWidth)/2 + 'px';
			}
		}
	}

	toReSize();

	window.onresize = function(){
		toReSize();
	}

	for(var i=0; i<aA.length; i++){
		aA[i].index = i;
		aA[i].onclick = function(){
			for(var i=0; i<aA.length; i++){
				aA[i].className = '';
			}
			this.className = 'active';
			startMove(oUl,{left : -this.index * imgWidth});
		}
	}

	//计时器
	var iNow = 0;
	var iNow2 = 0;
	setInterval(toRun,5000);
	function toRun(){
		
		if(aLi[0].style.left.split('px')[0] == 7680){
			aLi[0].style.position = 'static';
			aLi[0].style.left = 0;
			oUl.style.left = 0;
			iNow2 = 0;
		}
		if(iNow == aA.length-1){
			aLi[0].style.position = 'relative';
			aLi[0].style.left = imgWidth * aLi.length + 'px';
			iNow = 0;
		}else{
			iNow++;
		}
		
		iNow2++;

		for(var i=0; i<aA.length; i++){
				aA[i].className = '';
		}
		aA[iNow].className = 'active';

		startMove(oUl,{left : - iNow2 * 1920}, function(){
			// if(iNow == 0){
			// 	aLi[0].style.position = 'static';
			// 	aLi[0].style.left = 0;
			// 	oUl.style.left = 0;
			// 	iNow2 = 0;
			// }
		});
	}
});