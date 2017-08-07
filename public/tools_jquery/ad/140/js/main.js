var i=0;
function sdiv(istr){
//$('Ajax_sInfo').style.top = document.documentElement.scrollTop;
$('Ajax_Out').style.height=document.documentElement.scrollHeight;
$('Ajax_sInfo').style.left = document.documentElement.clientWidth/2-(700/1.5);
if (istr){
Element.show("Ajax_Out");
Element.show("Ajax_sInfo");
if (i<60){
i=i+5;
$('Ajax_sInfo').style.top = document.documentElement.scrollTop+(i);
setTimeout("sdiv("+istr+");",1);
}else{
i=0;
}
}else{
Element.hide("Ajax_Out");
Element.hide("Ajax_sInfo");
}
}

function simg(str){
sdiv(true);
$('Ajax_sInfo').innerHTML='<h1><span class="aj_title">图片预览</span><span class="aj_clost" onclick="sdiv(false)"></span><div class="cleardiv"></div></h1><div class="aj_pic"><img src="/API/gd.php?x=684&Jy=450&Jurl='+str+'" style="display:block;"></div>';
}

function goreg(){
sdiv(true);
$('Ajax_sInfo').innerHTML='<h1><span class="aj_title">&#x4F1A;&#x5458;&#x6CE8;&#x518C;&#x901A;&#x9053;</span><span class="aj_clost" onclick="sdiv(false)"></span><div class="cleardiv"></div></h1><table cellpadding="0" cellspacing="0" width=800 align=center style="margin:10px; background:url(/skin/man/images/loading.gif) no-repeat;"><tr><td width="150" height=50 align=center><iframe src="/User/Register.aspx" scrolling="no" width="100%" height="530"></iframe></td></tr></table>';
}

function gogetpassword(){
sdiv(true);
$('Ajax_sInfo').innerHTML='<h1><span class="aj_title">&#x4F1A;&#x5458;&#x6CE8;&#x518C;&#x901A;&#x9053;</span><span class="aj_clost" onclick="sdiv(false)"></span><div class="cleardiv"></div></h1><table cellpadding="0" cellspacing="0" width=800 align=center style="margin:10px;background:url(/skin/man/images/loading.gif)"><tr><td width="150" height=50 align=center><iframe src="/User/GetPassword.aspx" scrolling="no" width="100%" height="530"></iframe></td></tr></table>';
}

function send(){
sdiv(true);
$('Ajax_sInfo').innerHTML='<h1><span class="aj_title">&#x4F1A;&#x5458;&#x6CE8;&#x518C;&#x901A;&#x9053;</span><span class="aj_clost" onclick="sdiv(false)"></span><div class="cleardiv"></div></h1><table cellpadding="0" cellspacing="0" width=800 align=center style="margin:10px;background:url(/skin/man/images/loading.gif)"><tr><td width="150" height=50 align=center><iframe src="/NodePage.aspx?NodeID=1" scrolling="no" width="100%" height="530"></iframe></td></tr></table>';
}

function dingo(){
var username = $('username').value;
var tel = $('tel').value;
var contents = $('contents').value;
if (username == ''){
	$('username').focus()
	alert('请输入联系人姓名...');
	return false;
}
if (tel == ''){
	$('tel').focus()
	alert('请输入联系电话...');
	return false;
}
if (contents == ''){
	$('contents').focus()
	alert('请输入详细说明...');
	return false;
}
getAjaxDATA("/cms/index.php?username="+username+"&tel="+tel+"&contents="+contents,"Ajax_sInfo");
}
//my ajax
//url -- 地址 Dviname-
function getAjaxDATA(url,Dviname){
new Ajax.Updater(
{success: Dviname},
url,
{
	method: 'get',
	onFailure: reportError(url)
}
	);
}
function reportError(url){
$("Ajax_sInfo").innerHTML = '<h1><span class="aj_title">正在操作中</span><span class="aj_clost" onclick="sdiv(false)"></span><div class="cleardiv"></div></h1><div style="padding:10px;">请稍等,数据提交过程中...</div>';
setTimeout("sdiv(false);",2000);
}
//显示处理ajax的string
document.writeln("<div id='Ajax_Out' style='display:none;'></div><div id='Ajax_sInfo' style='display:none;'></div>");