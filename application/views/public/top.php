<body>
<?php /*?>
<div style="position:absolute;right:0;top:0;">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="65" height="118">
<param name="movie" value="<?php echo base_url();?>public/banner/open.swf" />
<param name="wmode" value="transparent" />
<param name="quality" value="high" />
<embed src="<?php echo base_url();?>public/banner/open.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="65" height="118"></embed>
</object>
</div>
<?php */?>
<div class="mainWidth mainTop">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td width="186"><a href="<?php echo site_url('index');?>" id="logo"><img src="<?php echo base_url();?>public/images/not7_logo.png" width="186" height="75" border="0" /></a></td>
    <td>
<div class="pinpai">
<?php echo $modular['slogan'];?>
</div>
</td><td align="right" valign="middle">
<?php echo $modular['onlineQQ'];?>
</td></tr>
</table>
</div>

<div id="topNav">
<div class="mainWidth NavBG">
<ul>
<li><a href="<?php echo site_url('index');?>"><font class="cn">网站首页</font><font class="en">Home Page</font></a></li>
<li class="nav2"><a href="<?php echo site_url('aboutus');?>" title="我们是谁？这里将让您进步一了解优享网络是怎样的一个团队！"><font class="cn">了解我们</font><font class="en">About Us</font></a></li>
<li><a href="<?php echo site_url('website');?>" title="广州网站建设、天河网站建设、东莞网站建设、中山网站建设、开平网站建设、佛山网站建设,找优享网络(UoXiang)"><font class="cn">网站建设</font><font class="en">WebSite Building</font></a><span class="ico-hot">&nbsp;</span></li>
<li><a href="<?php echo site_url('website/mofine');?>" title="广州网站模板、天河网站模板、东莞网站模板、中山网站模板、开平网站模板、佛山网站模板,用模板做网站,模板建站,找优享网络(UoXiang)"><font class="cn">模板建站</font><font class="en">Mofine WebSite</font></a></li>
<?php /*?>
<li><a href="<?php echo site_url('domain');?>"><font class="cn">空间域名</font><font class="en">Web Domain</font></a></li><?php */?>
<li><a href="<?php echo site_url('howmuch');?>"><font class="cn">&nbsp;&nbsp;怎么收费？</font><font class="en">How Much</font></a></li>
<li><a href="<?php echo site_url('common');?>" title="广州网站改版、天河网站改版、东莞网站改版、中山网站改版、开平网站改版、佛山网站改版,找优享网络(UoXiang)"><font class="cn">建站博文</font><font class="en">WebSite Blog</font></a></li>

<li><a href="<?php echo site_url('tools');?>" title="广州网站改版、天河网站改版、东莞网站改版、中山网站改版、开平网站改版、佛山网站改版,找优享网络(UoXiang)"><font class="cn">在线工具</font><font class="en">Tools Online</font></a></li>

<?php /*?>
<li><a href="http://www.5cmlabs.com" target="_blank" title="技术实验室又名CM实验室，由优享网络成员CM创建，主要用于对技术的学习分享和交流！"><font class="cn">技术实验室</font><font class="en">CM Labs</font></a></li>
<?php */?>

</ul>
</div>
</div>

<?php /*?>
<div id="topNav2">
<div id="navBox">
<!--下拉菜单-->
<?php include('downNav.php');?>
</div>
</div>
<?php */?>