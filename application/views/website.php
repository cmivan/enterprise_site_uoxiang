<?php $this->load->view('public/header');?>
<script>
$(function(){
	
	$('#case-box').hover(
	function(){
		$(this).find('li').animate({"opacity":"0.6"},"slow");
		
	$('#case-box').find('li').hover(
	function(){ $(this).animate({"opacity":"1"},"slow"); },
	function(){ $(this).animate({"opacity":"0.6"},""); }
	);
		
		},
	function(){ $(this).find('li').animate({"opacity":"1"},"slow"); }
	);	

});
</script>
<link href="public/assets/css/bootstrap.css" rel="stylesheet" type="text/css">

<div class="mainWidth">

<?php /*?>
<div class="banner"><?php echo $banner;?></div>
<div class="clear"></div>
<?php */?>

<div id="page">

<div id="search-box">
<form class="form-search">
<input style="width:300px;" type="text" name="keyword" placeholder="可以在这里填写你想找的网站..." value="<?php echo $sBox['keyword'];?>" />
<button type="submit" class="btn"><span class="icon-search"></span>搜索一下</button>
</form>
<div class="clear"></div>

<div id="search-select-box">
<div id="search-select-items">
&nbsp;<?php if($sBox['keyword']!=''){?><span>"<?php echo $sBox['keyword'];?>"</span> 找到 <b><?php echo $listRows;?></b> 件相关商品
<?php }else{?>
<?php echo $site['sitename'];?> <span style="font-weight:lighter">能让您快速拥有属于自己的网站！</span>
<?php }?></div>
<a name="websiteBox"></a>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="table table-condensed">
<?php if(!empty($sBox['p_nav'])){?>
  <tr>
    <td width="80" align="right"><strong>已选择：</strong></td>
    <td><?php echo $sBox['p_nav'];?></td>
  </tr>
<?php }?>

<?php /*?>
<tr><td width="80" align="right"><strong>风格：</strong></td>
<td><?php echo $sBox['p_styles_html'];?></td></tr>
<?php */?>

  <tr>
    <td width="80" align="right"><strong>类型：</strong></td>
    <td><?php echo $sBox['p_types_html'];?></td>
    </tr>
    
<?php if(!empty( $sBox['p_types_use_html'] )){?>
  <tr>
    <td width="80" align="right"><strong>细分：</strong></td>
    <td><?php echo $sBox['p_types_use_html'];?></td>
  </tr>
<?php }?>
  

    
    </table>
</div>

</div>



<div class="left">
<div><strong>推荐案例</strong>(WebSite Design) - 优质服务，享你所想 - 网络互联，打造国内一流的设计、建站服务平台
...</div>
</div>

<div class="right">

<?php if(!empty($list)){?>

<div class="content" style="margin-bottom:0;">
<?php $this->paging->links(); ?>
</div>
<div class="clear"></div>

<ul id="case-box">
<?php
foreach($list as $item){
	//$view_url = site_url('website/view/'.$item->id);
?> 
    <li>
        <div class="l"><a href="<?php echo $item->url;?>" title="优享网络、<?php echo $item->title;?>" target="_blank"><img src="<?php echo $item->pic_s;?>" title="<?php echo $item->title;?>" width="210" height="160"></a></div>
        <div class="r">
        <p>名称：<a href="<?php echo $item->url;?>" target="_blank"><?php echo $item->title;?></a></p>
        <p>网址：<a href="<?php echo $item->url;?>" target="_blank"><?php echo $item->url;?></a></p>
        <p>简介：<?php echo $item->note;?></p>
        </div>
    </li>
<?php }?>
</ul>

<div class="clear"></div>
<div class="content">
<?php $this->paging->links(); ?>
</div>

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