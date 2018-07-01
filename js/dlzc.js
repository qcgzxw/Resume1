window.onload = function()
{
	kapianqiehuan();
}

//卡片切换js
function kapianqiehuan(){
	var myTab = document.getElementById("tab"); 
	var myUl = myTab.getElementsByTagName("ul")[0]; 
	var myLi = myUl.getElementsByTagName("li");
	var myDiv = myTab.getElementsByTagName("div");
	
	for(var i = 0; i < myLi.length; i++){
		myLi[i].index = i;
		myLi[i].onclick = function(){
			for(var j = 0; j < myLi.length; j++){
				myLi[j].className = "off"; 
				myDiv[j].className = "hide";
			}
			this.className = "on"; 
			myDiv[this.index].className = "show";
		}
	}
}

//登陆按钮点击事件
function denglu(){
	var phonenum = document.getElementsByName("dl_phonenum")[0].value; 
	var password = document.getElementsByName("dl_password")[0].value;
	if(phonenum=="" || password == "")
	{
		alert("请填写完整信息！");
		return false;
	}
	if(window.XMLHttpRequest)
		var  myAjax   = new XMLHttpRequest();
	else
		var  myAjax   = new  ActivexObject("Microsoft.XMLHTTP");
	myAjax.open('Get','./core/user_login.api.php?phonenum='+phonenum+'&password='+password, true);
	myAjax.send();
	myAjax.onreadystatechange=function(){
		if(myAjax.readyState==4)
        {
            if(myAjax.status==200)
            {
            	var result = myAjax.responseText;
            	res = JSON.parse(result);
                if(res.state == "1")
            	{
                	if(res.time != "null")
                		alert("登陆成功！\n"+"你上次登陆时间为："+res.time);
                	else
                		alert("登陆成功！\n"+"你是首次登陆");
            	}
                	
                else if(res.state == "0")
                	alert("登陆失败！");
            }
            else
            {
                alert("网络未连接！");
            }
        }
	}
}

//注册按钮点击事件
function zhuce(){
	var phonenum = document.getElementsByName("zc_phonenum")[0].value; 
	var sexs = document.getElementsByName("zc_sex"); 
	for(var i = 0; i<sexs.length; i++){
		if(sexs[i].checked == true)
			var sex = document.getElementsByName("zc_sex")[i].value;
	}
	var password = document.getElementsByName("zc_password")[0].value;
	if(phonenum=="" || password == "" || sex =="")
	{
		alert("请填写完整信息！");
		return false;
	}
	if(window.XMLHttpRequest)
		var  myAjax   = new XMLHttpRequest();
	else
		var  myAjax   = new  ActivexObject("Microsoft.XMLHTTP");
	myAjax.open('Get','./core/user_register.api.php?phonenum='+phonenum+'&sex='+sex+'&password='+password, true);
	myAjax.send();
	myAjax.onreadystatechange=function(){
		if(myAjax.readyState==4)
        {
            if(myAjax.status==200)
            {
            	var res = myAjax.responseText;
                if(res == "1")
            	{
                	alert("注册成功！\n请点击登陆");
            	}
                else if(res == "0")
                {
                	alert("用户已存在，请重新注册");
                }
                else if(res == "-1")
                {
                	alert("未填写完整信息，请重新注册");
                }
                else if(res == "-2")
                {
                	alert("注册信息非法，请重新注册");
                }
                else if(res == "-3")
                {
                	alert("注册失败！");
                }
                location.reload();
            }
            else
            {
                alert("网络未连接！");
            }
        }
	}
}

//电话号码验证
function check_phone(){
	var phone = /^0?1[3|4|5|6|7|8][0-9]\d{8}$/;  
	var phonenum = document.getElementsByClassName("phonenum");
	if (!phone.test(phonenum[0].value) && !phone.test(phonenum[1].value)) {  
	    alert('请输入有效的手机号码！');  
	    return false;  
	}  
}