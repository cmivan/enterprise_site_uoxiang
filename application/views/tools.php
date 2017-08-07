<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- BEGIN head -->
<head>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<meta name="author" content="cm.ivan@163.com"/>
<meta name="description" content="<?php echo $seo['description'];?>">
<meta name="keywords" content="<?php echo $seo['keywords'];?>">
<title><?php echo $seo['title']?></title>

<script type="text/javascript" src="<?php echo $style['jq_url'];?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/ajax.js"></script>

<script language="javascript" type="text/javascript"> 
function autofixhight(){
	var winHeight = parseInt($(window).height());
	$('#toolsBox').height(winHeight);
	$('#iframeBoxTop').height(153);
	var ifrHeight = winHeight - 153;
	$('#ifm').height( ifrHeight );
}
$(function(){
	autofixhight();
	$(window).resize(function(){ setTimeout(function(){ autofixhight(); },200) });
});
</script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/style.css"/>
<style type="text/css">
*{overflow:hidden;}
html{overflow:hidden;}
body{overflow:hidden;}
</style>

</head>

<body>

<table id="toolsBox" width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td id="iframeBoxTop">
<?php $this->load->view('public/top_tools_nav');?>
</td></tr>
<tr><td id="iframeBox" style="background-color:#0C6;">
<iframe scrolling="auto" id="ifm" width="100%" height="100%" src="<?php echo $toolsUrl;?>" frameborder="1"></iframe>
</td></tr>
</table>
</body>
</html>