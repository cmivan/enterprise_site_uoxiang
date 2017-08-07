<?php $this->load->view('public/header');?>

<?php $this->load->view('service_mob');?>

<div class="mainWidth">
<div id="page">
<div class="left">

<div class="content-where">
<?php echo $site['where'];?>
：
<?php echo getnav($nav,'index', $site['sitename'] );?>
 / 
<?php echo '<a href="'.site_url( $type_link['link'] ).'">'.$type_link['name'].'</a>';?>
 / 
<?php echo '<a href="'.site_url( $type_link['link1'] ).'">'.$type_link['name1'].'</a>';?>
</div>

</div>
<div class="clear"></div>
<div class="right">
  <div class="content">
  
<div class="info-list" style="padding-top:15px;">
  <?php if(!empty($list)){?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
  <?php
  $i = 1;
  foreach($list as $item){
      $i++; if($i%2==0){ $iclass = "news_item news_item_hr"; }else{ $iclass = "news_item"; }
  ?>
  <tr class="<?php echo $iclass;?>"><td width="4"></td>
  <td class="title"><i class="icon-chevron-right">&nbsp;</i>&nbsp;&nbsp;<a target="_blank" href="<?php echo site_url($type_link['link'].'/view/'.$item->id);?>" title="<?php echo $item->title;?>"><?php echo $item->title;?></a></td>
  <td width="165" class="time"><?php echo dateTime($item->add_time);?></td></tr>
  <?php }?>
  </table>
  <div class="clear"></div>
  <?php $this->paging->links(); ?>
  <?php }else{?>
  <div class="no-info"><strong><?php echo $type_link['name'];?>还没有内容！</strong></div>
  <?php }?>
</div>

  </div>
</div>
</div>
</div>
<?php $this->load->view('public/footer');?>