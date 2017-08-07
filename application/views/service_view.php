<?php $this->load->view('public/header');?>
<div class="mainWidth">
<div class="banner"><?php echo $banner;?></div>
<div class="clear"></div>
<div id="page">
<div class="left">

<div class="content-where">
<?php echo $site['where'];?>
：
<?php echo getnav($nav,'index', $site['sitename'] );?>
 / 
<?php echo '<a href="'.site_url( $type_link['link'] ).'">'.$type_link['name'].'</a>';?>
</div>

</div>
<div class="clear"></div>
<div class="right">
  <div class="content">
  
<div class="content-text">
<div class="content-text-note">
    <h1><span class="icon-qrcode" title="温馨提示：文章【<?php echo $view->title;?>】支持使用二维码直接扫描到手机！">&nbsp;</span>&nbsp;<?php echo $view->title;?></h1>
    <?php if(!empty($view->note)){?><span><strong><?php echo $site['note'];?>：</strong><?php echo $view->note;?><?php }?></span>
</div>
<div class="content-view"><?php echo $view->content;?></div>
<div class="content-text-note">&nbsp;</div>
<div class="content-text-note">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><img src="<?php echo $titleurl_md5?>"/></td>
    <td valign="top" style="padding-left:20px;">
	<?php echo $titleurl;?><br />
    <span style="color:#999; font-size:12px;">温馨提示：以上内容可以拿起你的手机，使用二维码扫描工具，把文章记录到手机上！</span>

<div style="padding-top:8px;">
<a href="http://weibo.com/u/1937807260?s=6uyXnP" target="_blank"><img src="http://service.t.sina.com.cn/widget/qmd/1937807260/629c02a7/1.png" width="369" height="103" border="0"/></a>
</div>
    </td></tr>
  </table>
</div>
</div>

  </div>
</div>
</div>
</div>
<?php $this->load->view('public/footer');?>