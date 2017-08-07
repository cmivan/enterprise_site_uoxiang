<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>huoduan.com</title>
<script type="text/javascript" src="<?php echo $style['jq_url'];?>"></script>
<style>
a{ color:#343434; text-decoration:none}
a:hover{color:#F00;text-decoration:underline}
img{border:0;}
h3{font-size:14px;}
ul,li{list-style:none;margin:0; padding:0;line-height:180%;}
.linklist li{height:20px; margin-bottom:3px; overflow:hidden; vertical-align:bottom; font-size:12px;}
.linklist li .num{display:inline-block; float:left; color:#333; margin-right:10px; letter-spacing:1px;}
.linklist li a{display:inline-block; float:left; color:#03C;}
.linklist li a:hover{color:#C30;}
.linklist li .status{display:inline-block; float:right;}
.linkcenter{color:red; text-align:center;}
</style>
</head>

<body>
<?php if(!empty($list)){?>

<?php
$i = 0;
$ifhtml = '';
foreach($list as $item){
  $link = str_replace('***',$domain,$item->url);
  $link = str_replace('\n','',$link);
  $link = str_replace('\r\n','',$link);
  $link = str_replace(' ','',$link);
  //-----------------------------------
  $ifhtml.= "<li><span class=\"num\">[".($i+1).".]</span><a target='_blank' href=\"".$link."\">".$link."</a><span class=\"status\">";
  $ifhtml.= "<iframe src='".site_url('tools/links/url')."?".$link."' height='20' width='20' marginwidth='0' marginheight='0' hspace='0'";
  $ifhtml.= "vspace='0' frameborder='0' scrolling='no'></iframe></span></li>";
  $i++;
}
?>

<div class="linkcenter">
（<?php echo $page.'/'.$this->paging->pageNum;?>）请不要关闭页面，<span id="endtime">10</span>秒后跳到下一页!
还有<span id="urling"><?php echo $i;?></span>项未完成!
</div>

<ul class="linklist"><?php echo $ifhtml;?></ul>
<?php }else{?>
  <div class="no-info"><strong class="linkcenter">工作完毕！</strong></div>
<?php }?>



<script language="javascript" type="text/javascript">
<!--
var lc = "10";
var p = "<?php echo $page+1;?>";
var k = "<?php echo $domain;?>";
var second=10;
var timer;
//判断列表是否全部检测完成
function istaskok(){
	var urling = parseInt( $('#urling').html() );
	if(urling<=0){
		return true;
	}else{
		return false;
	}
}
//逐减已完成数目
function taskoknum(){
	var urling = parseInt( $('#urling').html() );
	urling--;
	$('#urling').html(urling);
	return urling;
}
//修改显示倒计时
function change(){
	var taskok = istaskok();
	second--;
	if( (second>-1 && taskok==false) || (second<3 && second>-1 && taskok==true) ){
		timer = changeTime(second);
	}else if(second>2 && taskok==true ){
		second = 1;
		timer = changeTime(second);
		setTimeout('ourl()',second*1000);
	}else{
		clearTimeout(timer);
	}
}

//修改显示倒计时
function changeTime(sec){
	$('#endtime').html(sec);
	return setTimeout('change()',1000);
}
//跳转下一页面继续seo
function ourl(){
	location.href='<?php echo site_url('tools/links/seo');?>?page='+p+'&domain='+k;
}
//-----------
$(function(){
	timer = setTimeout('change()',1000); 
	setTimeout('ourl()',10000);
});
-->
</script>
</body>
</html>