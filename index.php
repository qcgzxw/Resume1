<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'/>
	<title>简单的注册登陆页面</title>
	<script src="js/dlzc.js"></script>
<style type="text/css">
.hide{display: none;}
#tab ul{list-style:none; display:;height:30px;line-height:30px;}
#tab ul li{list-style:none; display:;height:30px;float:left;}
#tab ul li.on{border-bottom:2px solid Saddlebrown;}
.two .on{
	margin:0 10px;
}

.two li{
	box-sizing:border-box;
}
.one{
	border: 1px solid #000;
}
.four{
		border: 1px solid #000;
}

</style>
</head>
<body>
<div id="tab" class="two">
	<ul>
		<li class="on">用户登录</li>
		<li class="off">用户注册</li>
	</ul>
    <div id="dl" class = "show">
        <table cellpadding="10px" cellspacing="5px" class="one">
            <tr >
                <td>电话号码:</td>
                <td><input type="number" class = "phonenum" onblur = "check_phone()" name="dl_phonenum"/> *</td>
            </tr>
            <tr>
                <td>密码:</td>
                <td><input type="password" name="dl_password"/> *</td>
            </tr> 
            <tr >
                <td colspan="2" align="center"><button id = "denglu" type = "button" onclick="denglu()">登陆</button></td>
            </tr>
        </table>
    </div>
    
    <div id = "zc" class = "hide">
        <table cellpadding="10px" cellspacing="5px" class="four">
            <tr >
                <td>电话号码:</td>
                <td><input type="number" class = "phonenum" onblur = "check_phone()" name="zc_phonenum"/> *</td>
            </tr>
            <tr >
                <td>性别:</td>
                <td><input type="radio" name="zc_sex" value="0" checked="checked"/> 男
                <input type="radio" name="zc_sex" value="1"/> 女
                </td>
            </tr>
            <tr>
                <td>密码:</td>
                <td><input type="password" name="zc_password"/> *</td>
            </tr> 
            <tr >
                <td colspan="2" align="center"><button id = "zhuce" type = "button" onclick="zhuce()">注册</button></td>
            </tr>
        </table>
    </div>
    
</div>    
</body>
</html>