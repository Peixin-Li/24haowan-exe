$(document).ready(function(){
	$('#phone-right a').click(function(){

		if(window.screen.availHeight < 800){
			$('#form-contain').css('margin-top','-336px');
		}
		$('#mask').css('display','block');
		$('#form-contain').css('display','block');
		$('#contact-contain').css('display','block');
		// $('body').css('overflow','hidden');
	});
		
	$('#mask').click(function(){
		$('#mask').css('display','none');
		$('#form-contain').css('display','none');
		$('#contact-contain').css('display','none');
		$('body').css('overflow','visible');
	});

	$('#point li').click(function(){
		$('#point li').css('background','none');
		$(this).css('background','#fff');
	});

	$('#form-button a').click(function(){
		// alert(123);
		var phoneExp= /^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/;
		debugger;
		var contacts = $('.th2 input[name=contacts]').val();
		var phone = $('.th2 input[name=phone]').val();
		var qq = $('.th2 input[name=qq]').val();
		var description = $('.th2 textarea[name=description]').val();

		if(contacts	== ''){
			alert('请输入联系人!');
		}else if(phone == ''){
			alert('请输入联系电话!');
		}else if(!phone.match(phoneExp)){
			alert('请输入正确的手机号码！');
		}else
		{
			$.ajax({
        	type:'post',
        	dataType:'json',
        	url:'/ajax/addContactInfo',
        	data:{'name':contacts,'phone':phone,'items1':qq,'items2':description	},
        	success:function(result){
          		if(result.code == 0){
            	alert("信息提交成功！");
          		}else if(result.code == -1){
            	alert("信息提交失败！");
          		}
        	}
      	});
		}
		
	});
});