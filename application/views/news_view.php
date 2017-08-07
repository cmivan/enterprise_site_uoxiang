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
 / 
<a href="<?php echo site_url('news/view/'.$view->id);?>"><?php echo $view->title;?></a>
</div>
</div>


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
<?php $this->load->view('public/footer');?>