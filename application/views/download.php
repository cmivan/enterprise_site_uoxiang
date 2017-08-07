<?php $this->load->view('public/header');?>
<!-- BEGIN body -->
<body class="page page-id-109 page-template-default ie layout-2cr">

	<!-- BEGIN #container -->
	<div id="container">
		<!-- BEGIN #header -->
		<?php $this->load->view('public/top');?>
		<!--BEGIN #content -->
		<div id="content" class="clearfix">		
			<div class="page-title">中国个性原木家居领航者</div>
            
            <div class="clear"></div>
            
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
            		
							
				<!--BEGIN .hentry -->
				<div class="hentry">	
                
					<!--BEGIN .clearfix -->
                    <div class="clearfix">		
    
                      <!--BEGIN .entry-content -->
                      <div class="entry-content">
                      
<?php if(!empty($list)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php
$i = 1;
foreach($list as $item){
	$i++; if($i%2==0){ $iclass = "news_item news_item_hr"; }else{ $iclass = "news_item"; }
?>
<tr class="<?php echo $iclass;?>"><td class="ico">&nbsp;</td>
<td class="title"><?php echo $item->title;?></td>
<td align="center" class="time"><a href="<?php echo site_url('download/view/'.$item->id);?>" target="_blank"><span class="icon-download">&nbsp;</span>下载该文档</a></td></tr>
<?php }?>
</table>
<div class="clear"></div>
<?php $this->paging->links(); ?>
<?php }else{?>

<div class="no_info"><strong>下载中心还没有内容！</strong><br><br></div>

<?php }?>
                      
                      <!--END .entry-content -->
                      </div>
                        
                    <!--END .clearfix -->
				    </div>     
                          
				<!--END .hentry-->  
				</div>
                <!--END #primary .hfeed-->
			</div>

		<!--BEGIN #sidebar .aside-->
		<?php $this->load->view('public/right');?>
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