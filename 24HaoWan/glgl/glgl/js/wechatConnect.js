var xhr;
var date;
function getCode() {
	var code = location.href.split('?')[1].split('&')[0].split('=')[1];
	// alert(new Date().getTime() + ':' + code);
	// alert(url);
	// location.href = url;
	var url = "http://www.inyyj.com/games/GLGL/postDate.php?type=1&code=" + code;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		getDate(applyPeople);
	};
	xhr.open("get",url,true);
	xhr.send(null);
}

function applyRefresh() {
	date = JSON.parse(xhr.responseText);
	var url = "http://www.inyyj.com/games/GLGL/postDate.php?type=2&refresh_token=" + date['refresh_token'];
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		//
	};
	xhr.open("get",url,true);
	xhr.send(null);
}

function applyPeople() {
	date = JSON.parse(xhr.responseText);
	var url = "http://www.inyyj.com/games/GLGL/postDate.php?type=3&access_token=" + date['access_token'] + "&openid=" + date['openid'];
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		getDate(function(){
			// xhr.responseText
			/*数据全部在这里*/
		});
	};
	xhr.open("get",url,true);
	xhr.send(null);
}


function getDate(callback) {
	if(xhr.readyState == 4) {
		if(xhr.status == 200) {
			callback();
		} else {
			alert(new Date().getTime() + ':' + xhr.status);
		}
	}
}

