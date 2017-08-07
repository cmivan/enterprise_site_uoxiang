<div class="articlebox">
<?php
if(!empty($articles_type)){
	$itemID = 0;
	foreach($articles_type as $item){
		$itemID++;
		$lists = $this->Articles_Model->lists($item->type_id,8);
		if(!empty( $lists )){
?>
<div class="article_item">
<div class="title_bg">
<div class="title"><a href="<?php echo site_url('articles/type/'.$item->type_id);?>" title="查看<?php echo $item->type_title;?>"><?php echo $item->type_title;?></a> <a href="<?php echo site_url('articles/type/'.$item->type_id.'/rss');?>" title="订阅<?php echo $item->type_title;?>" target="_blank">rss</a> <span>/ <?php echo $item->type_note;?></span></div>
<div class="more"><a href="<?php echo site_url('articles/type/'.$item->type_id);?>" title="了解更多<?php echo $item->type_title;?>" target="_blank"><img src="public/images/ico/more.gif" width="42" height="12" border="0" /></a></div>
<div class="clear"></div>
</div>
<div class="article_box">

<ul>
<div class="article_box_line">&nbsp;</div>
<?php foreach($lists as $lsitem){?>
<li><a href="<?php echo site_url('articles/view/'.$lsitem->id);?>" target="_blank"><?php echo cutstr($lsitem->title,19);?></a></li>
<?php }?>
</ul>

</div>
</div>
<?php if($itemID%3!=0){?>
<div class="article_line"></div>
<?php }?>

<?php }}?>

<div class="article_item">
<img src="public/images/uoxiang_code.jpg" border="0" />
</div>

<?php }?>
</div>

<div class="clear"></div>