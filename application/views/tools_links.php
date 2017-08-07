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
<style>
h3{font-size:14px;}
ul,li{list-style:none;margin:0; padding:0;line-height:180%;}
p,form,div,h1,h2,h3,h4,h5,h6{margin:0; padding:0}
.center{text-align:center;}

.input{padding:3px 5px;  height:18px; line-height:18px; font-size:14px;}
.btn{height:26px; line-height:18px; padding:0px 5px;}

#topbar{height:22px;background-color:#FBFBFB; line-height:22px;}
#topbar .con{width:960px; margin:0 auto;}

#header{height:80px; width:960px; margin:5px auto;}
#logo{height:70px; width:350px; float:left; display:inline;}
#adbanner{width:600px; float:right; display:inline; height:70px; text-align:right;}

#menu{height:38px; background:url(menubg.gif) repeat-x 0 bottom;margin:0 auto;}
#menu .con{ width:960px; margin:0 auto;}
#menu a{color:#333; margin:0px 5px 0 5px; height:38px;line-height:38px; display:inline-block; float:left; font-size:14px; width:103px; text-align:center; }
#menu a:hover{color:#F00;}
#menu a.this{line-height:38px; color:#FFF;background:url(this.gif) repeat-x;}


#main{ width:960px; overflow:hidden; margin:5px auto; font-size:14px;}

.cbox{ border:1px solid #C1C1C1; margin-bottom:7px; padding-bottom:8px; overflow:hidden;word-break:break-all;}
.cbox .head{height:28px; border-bottom:1px solid #CCC; background:#FFEFDB url(tbg.gif) repeat-x; overflow:hidden; line-height:28px; padding:0 12px;}
.cbox .head h1{float:left; display:inline; font-size:14px; font-weight:normal; letter-spacing:2px; overflow:hidden; }
.cbox .con{padding:8px 10px; overflow:hidden; line-height:200%; overflow:hidden;}

.linklist li{height:20px; margin-bottom:3px; overflow:hidden; vertical-align:bottom; font-size:12px; width:80%;}
.linklist li .num{display:inline-block; float:left; color:#333; margin-right:10px; letter-spacing:1px;}
.linklist li a{display:inline-block; float:left; color:#03C;}
.linklist li a:hover{color:#C30;}
.linklist li .status{display:inline-block; float:right;}

#footer{width:960px; margin:10px auto 0 auto; clear:both; text-align:center; padding:10px 0;}
</style>

<script type="text/javascript" src="<?php echo $style['jq_url'];?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/ajax.js"></script>
<script type="text/javascript">
function cgurl(obj,url){
	obj.href=url;
}
function ck_dn(str){
	if(!/^([\w-]+\.)+((com)|(net)|(org)|(gov\.cn)|(info)|(cc)|(me)|(asia)|(com\.cn)|(net\.cn)|(org\.cn)|(name)|(biz)|(tv)|(cn)|(la))$/.test(str)){
		return false;
	}else{
		return true;	
	}
}

$(function(){   
	$("#linkbtn").click(function(){
		$domain = $("#domain").val();
		if($domain==""){
			alert("请输入域名");	
		}else if(ck_dn($domain)){
			$("#linkshow").show();
			$("#linklist").html("<iframe src='<?php echo $thisUrl;?>?page=1&domain="+$domain+"' height='270' width='900' marginwidth='0' marginheight='0' hspace='0' vspace='0' frameborder='0' scrolling='no'></iframe>");
		}else{
			alert("请输入正确的域名");
		}					 
	});
});
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/style.css"/>

</head>

<body>

<?php $this->load->view('public/top_tools_nav');?>


<div class="mainWidth">
<div class="banner"><img src="<?php echo base_url();?>public/banner/images/aws.jpg" width="980" height="180" /></div>
<div class="clear"></div>
<div id="page">
<div class="left">
<div><strong>疑问解答？</strong>，优质服务，享你所想 - 网络互联，打造国内一流的设计、建站服务平台
...</div>
</div>
<div class="clear"></div>
<div class="right">

<div id="main">
  <div class="cbox">
     <div class="head"><h1>超级SEO外链</h1></div>
     <div class="con">
        <div align="center">
         请输入你要刷外链的网址：
         http://
         <input type="text" ID="domain" value="<?php echo $domain;?>" class="input" name="domain" style="width:350px" />
         <input name="" class="btn" id="linkbtn" type="submit" value="开始执行"  />
         </div>
     </div><!--con-->
     <div style="clear:both"></div>
  </div><!--cbox-->
  
 
<div style="<?php if(strlen($domain)==0){echo 'display:none';}?>" class="cbox" id="linkshow" >
<div class="head"><h1>正在访问的链接</h1></div>
<div class="con" id="linklist">
<?php
if(strlen($domain)>3){
	echo "<iframe src='".$thisUrl."?page=1&domain=".$domain."' height='270' width='940' marginwidth='0' marginheight='0' hspace='0' vspace='0' frameborder='0' scrolling='no'></iframe>";
}
?>
</div><!--con-->
<div style="clear:both"></div>
</div><!--cbox--> 

  <div class="cbox">
     <div class="head"><h1>工具介绍</h1></div>
     <div class="con">
     <strong>超级外链快速增加网站外链的原理：</strong><br />
     &nbsp;&nbsp;&nbsp;&nbsp;超级外链由本站精心收集了数个ip查询 Alexa排名查询，pr查询等站长常用查询网站，由于这些网站大多有查询记录显示功能，而且查询记录可以被百度，谷歌，搜狗等搜索引擎快速收录，这样就形成了外链。<br />
     <br />
     &nbsp;&nbsp;&nbsp;&nbsp;经过长时间观察发现这种外链有很大一部分还是比较稳定，所以可以用来进行seo利用，因为这是正常的查询产生的外链，所以这种外链对SEO效果还是很明显的！
把复杂的友情链接交换过程交给电脑，交给批量而自动化的外链工具，节省我们的时间、健康、人力、金钱和脑细胞。<br />
<br />
&nbsp;&nbsp;&nbsp; 现在开始，体验和享受功能强大、轻松便捷而免费的网站推广过程吧。根据最新的科学艺术预测：现如今人类的一切重复性劳动，在未来都可以被机器和工具替代，人可以腾出手来，从事自己喜爱的创造性的事情。<br />
<br />
&nbsp;&nbsp;&nbsp; 就让我们先行一步吧，把网站的宣传推广工作交由机器来完成。</div><!--con-->
     <div style="clear:both"></div>
  </div><!--cbox-->

</div>

</div>
</div>
</div>

<br>



<?php $this->load->view('public/footer');?>