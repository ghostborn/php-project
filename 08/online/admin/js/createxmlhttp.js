// JavaScript Document
function changetype(type){
	var xmlhttp = false;
	if(window.ActiveXObject){
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}else if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	xmlhttp.open("GET","changetype.php?type="+type,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById("style").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send(null);
}
