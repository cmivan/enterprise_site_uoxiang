<?php $this->load->view('public/header');?>

<!-- BEGIN body -->
<body class="page page-id-4527 page-template page-template-template-portfolio-php ie layout-2cr">

	<!-- BEGIN #container -->
	<div id="container">

		<!--BEGIN #content -->
		<div id="content" class="clearfix">

            <div class="page-title">艺术木境&nbsp;-&nbsp;意象随形</div>
            <div class="clear"></div>

            <!--BEGIN #recent-portfolio  .home-recent -->
            <div id="recent-portfolio" class="home-recent portfolio-recent clearfix">
            	
<!--BEGIN .sidebar -->
<div class="sidebar sidebarTop">
  <?php $this->load->view('public/left');?>
  <!--END .sidebar -->
</div>
                                
<!--BEGIN .recent-wrap -->
<div class="recent-wrap wrapTop">

<div id="content-box" class="products-view">
<div class="content-text">
<div class="content-where">
<?php echo $site['where'];?>
：
<?php echo getnav($nav,'index', $site['sitename'] );?>
 / 
<?php echo getnav($nav,'products');?>
 / 
<a href="<?php echo site_url('products').'?p_type_id='.$view->typeB_id;?>"><?php echo $view->type_title;?></a>
 / 
<a href="<?php echo site_url('products/view/'.$view->id);?>"><?php echo $view->title;?></a>
</div>
<div>
<div class="content-text-left">
<div class="content-view-pic"><img src="<?php echo $view->pic_b;?>" width="295" /></div>
<div></div>
</div>

<div class="content-text-right">
<br>
<h3>&nbsp;<i class="icon-tag"></i><?php echo $view->title;?></h3>
 <?php /*?><h2><?php echo $view->note;?></h2><?php */?>
 <table border="0" cellpadding="1" cellspacing="1" class="table" style="background-color:#FFF;">
  <tr>
    <td width="60" align="left" bgcolor="#FFFFFF"><?php echo $pro['no'];?>：</td>
    <td colspan="2" bgcolor="#FFFFFF"><?php echo $view->pro_no;?></td>
    </tr>
  <tr>
    <td align="left" bgcolor="#FFFFFF"><?php echo $pro['size_z'];?>：</td>
    <td bgcolor="#FFFFFF"><?php echo $view->size_z;?></td>
    <td bgcolor="#FFFFFF">cm</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#FFFFFF"><?php echo $pro['size_w'];?>：</td>
    <td bgcolor="#FFFFFF"><?php echo $view->size_w;?></td>
    <td bgcolor="#FFFFFF">cm</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#FFFFFF"><?php echo $pro['size_h'];?>：</td>
    <td bgcolor="#FFFFFF"><?php echo $view->size_h;?></td>
    <td bgcolor="#FFFFFF">cm</td>
  </tr>
<?php if(!empty($user_power)){?>
<tr>
    <td align="left" bgcolor="#FFFFFF"><?php echo $pro['price'];?>：</td>
    <td bgcolor="#FFFFFF"><?php echo $view->price;?></td>
    <td bgcolor="#FFFFFF"><?php echo $pro['unit'];?></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#FFFFFF"><?php echo $pro['price_vip'];?>：</td>
    <td bgcolor="#FFFFFF"><?php echo $view->price_vip;?></td>
    <td bgcolor="#FFFFFF"><?php echo $pro['unit'];?></td>
</tr>
<?php }else{?>
<tr class="red"><td colspan="3" align="center" bgcolor="#FFFFFF"><?php echo $pro['notlogintip'];?></td></tr>
<?php }?>

</table>

</div>
</div>

<div class="clear"></div>

<?php if(!empty($view->content)){?>
<div class="content-view-title"><?php echo $pro['title_note'];?>：</div>
<div class="content-view"><?php echo $view->content;?></div>
<?php }?>

<div class="clear"></div>


<?php /*?>

<div id="content-left" class="content-related">
<div class="content-view-title"><?php echo $pro['title_related'];?>：</div>
<?php if(!empty($list)){?>
<?php foreach($list as $item){
	$view_url = site_url('products/view/'.$item->id); ?> 
<div class="picture-boxes-container">
<div class="picture-boxes"><a href="<?php echo $view_url;?>"><img class="pbox_img_grow" src="<?php echo $item->pic_s;?>" name="<?php echo $item->title;?>"  title="<?php echo $item->title;?>" border="0"></a></div>
</div>
<?php }}?>
<div class="clear"></div>
</div>

<?php */?>


</div>
</div>                     

<!--END .recent-wrap -->
</div>
<!--END #recent-portfolio .home-recent -->
</div>
<!-- END #content -->
</div>
<!-- END #container -->
</div> 	
    
<!-- BEGIN #footer-container -->
<?php $this->load->view('public/footer');?>
<!--END body-->
</body>
<!--END html-->
</html>