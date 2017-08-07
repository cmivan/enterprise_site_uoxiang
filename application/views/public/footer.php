
<div class="clear"></div>

<!--底部-->
<div class="bottom">

<!--友情链接-->
<div class="mainWidth">
<div class="link">

<?php /*?>
<div class="link_ico">
<img src="<?php echo base_url();?>public/images/link_buttom.gif" align="absmiddle" />
</div>
<?php */?>

<?php if(!empty($links)){?>
<div class="link_item">
<?php foreach($links as $link){?>
<a href="<?php echo $link->url;?>" target="_blank"><?php echo $link->title;?></a>
&nbsp;
|
&nbsp;
<?php }?>
</div>
<div class="clear"></div>
<?php }?>

</div>
</div>


<div class="mainWidth"><img src="<?php echo base_url();?>public/images/bottom_line_long.jpg" width="980" height="2" /></div>
<div class="mainWidth">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="157"><img src="<?php echo base_url();?>public/images/not7_logo_bottom.gif" /></td>
<td>
<div class="bottom_box">
<a href="<?php echo site_url('website');?>" target="_blank">广州网站建设</a><br />
<a href="<?php echo site_url('website');?>?p_type_id=22&v=1.0" target="_blank">外贸网站设计</a><br />
<a href="<?php echo site_url('tools');?>" target="_blank">实用在线工具</a>
</div>
<div class="bottom_box">
<a href="<?php echo site_url('howmuch');?>" target="_blank">网站建设报价</a><br />
<a href="javascript:void(0);" target="_blank">建站订单留言</a><br />
<a href="javascript:void(0);" target="_blank">网站排名优化</a>
</div>
<div class="bottom_box">
<a href="<?php echo site_url('website');?>?p_type_id=23&v=1.0" target="_blank">购物网站设计</a><br />
<a href="<?php echo site_url('howmuch');?>" target="_blank">付款方式</a><br />
<a href="<?php echo site_url('aboutus');?>" target="_blank">联系我们</a>
</div>
<div class="bottom_box copyright"><?php echo $modular['contact'];?><script src="http://s20.cnzz.com/stat.php?id=2506866&web_id=2506866&show=pic" language="JavaScript"></script></div>
</td>
    </tr>
</table>
</div>

<div class="mainWidth"><img src="<?php echo base_url();?>public/images/bottom_line_long.jpg" width="980" height="2" /></div>

<div class="mainWidth">
  <div class="share">
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
    <a class="bds_qzone"></a>
    <a class="bds_tsina"></a>
    <a class="bds_tqq"></a>
    <a class="bds_renren"></a>
    <a class="bds_t163"></a>
    <a class="bds_hi"></a>
    <a class="bds_diandian"></a>
    <a class="bds_tqf"></a>
    <span class="bds_more"></span>
    <a class="shareCount"></a>
    </div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=784917" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
    <!-- Baidu Button END -->
    <div class="clear"></div>
  </div>
</div>

</div>

<script type='text/javascript'>
(function() {
    var c = document.createElement('script'); 
    c.type = 'text/javascript';
    c.async = true;
    c.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.clicki.cn/boot/48845';
    var h = document.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(c, h);
})();
</script>

</body>
</html>