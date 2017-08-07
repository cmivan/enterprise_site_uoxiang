<?php $this->load->view('public/header');?>

<link href="public/assets/css/bootstrap.css" rel="stylesheet" type="text/css">

<div class="mainWidth">
<div class="banner"><?php echo $banner;?></div>
<div class="clear"></div>
<div id="page">
<div class="right">

<?php if(!empty($list)){?>

<ul id="case-box">
<?php foreach($list as $item){
	$view_url = site_url('service/view/'.$item->id); ?> 
    <li>
        <div><a href="<?php echo $view_url;?>" title="优享网络、<?php echo $item->title;?>" target="_blank"><img src="<?php echo $item->pic_s;?>" title="<?php echo $item->title;?>" width="210" height="160"></a></div>
        <p><a href="<?php echo $view_url;?>"><?php echo $item->title;?></a></p>
    </li>
<?php }?>
</ul>

<div class="clear"></div>
<br />

<?php }else{?>

<div class="no-info">
<strong><?php echo $pro['noinfo'];?>,
可以先看看我们</strong>
<a style="text-decoration:underline;" href="<?php echo site_url('website');?>"><span class="icon-search"></span>其他的网站</a>
</div>

<?php }?>


</div>
</div>
</div>

<?php $this->load->view('public/footer');?>