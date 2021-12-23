var xmlHttp;

function createXmlHttpRequest() {
	if(window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	}else if(window.ActiveXObject) {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function sent() {
	createXmlHttpRequest();
	var email = document.getElementById("em").value;
	var url = "./vc.php";
	xmlHttp.open("POST", url, true);
	xmlHttp.onreadystatechange = handleResult;
	xmlHttp.sendRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xmlHttp.send("action=login&em=" + email);
}

function handleResult() {
	if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		var response = xmlHttp.responseText;
		var json = eval('(' + response + ')');
		if(json['login_result']) {
			alert("Login successfully!");
		}else{
			innerHtml("Wrong email or password!");
		}
	}
}

function innerHtml(message) {
	document.getElementById("tip").innerHTML = "<span>" + message + "</span>";
}