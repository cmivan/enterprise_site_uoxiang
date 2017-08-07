<!DOCTYPE html>
<!-- BEGIN html -->
<html lang="cn">
<!-- BEGIN head -->
<head>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="baidu-site-verification" content="3Dip1Lj55i" />
<meta name="author" content="cm.ivan@163.com"/>
<meta name="description" content="<?php echo $seo['description'];?>">
<meta name="keywords" content="<?php echo $seo['keywords'];?>">
<title><?php echo $seo['title']?></title>

<script type="text/javascript" src="<?php echo $style['jq_url'];?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/ajax.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/css/bootstrap.css"/>

<link media="screen and (min-width:1000px)" rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/style_moblie.css"/>

</head>
<body>

<div class="mainWidth">
<div id="page">

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
      <?php echo $qrcode; //二维码?>
      </div>
      
  </div>

  </div>
</div>
</div>
</div>


</body>
</html>