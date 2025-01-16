// JavaScript Document
	function register(){
		let toname = list.toname.value;
		let remark = list.remark.value;
		if(toname==""){
			alert("您要为谁点歌？");
			list.toname.focus();
			return false;
		}
		else if(remark==""){
			alert("请填写您的祝语");
			list.remark.focus();
			return false;
		}
		else {
			list.submit();
		}			
	}