<?php $this->load->view('public/header');?>
<div class="mainWidth">
<div class="banner"><?php echo $banner;?></div>
<div class="clear"></div>
<div id="page">
<div class="left">
<div><strong>了解我们</strong>，优质服务，享你所想 - 网络互联，打造国内一流的设计、建站服务平台
...</div>
</div>

<div class="right">
  <div class="content content-about">
  
<?php if(!empty($columns)){?>
   <?php foreach($columns as $item){?>
    <table border="0" cellpadding="0" cellspacing="0"><tr><td class="page-content-title"><div><?php echo $item->title;?></div></td></tr></table>
    <div class="page-content-note"><?php echo $item->content;?></div>
   <?php }?>
<?php }?>

  </div>
</div>
</div>
</div>
<?php $this->load->view('public/footer');?>