<?php if(!empty($service)){?>
<div class="mainWidth">

<div id="top-service">
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="236">
<tbody><tr><td class="left">&nbsp;</td>
<td valign="top" class="center">
<table width="100%" height="124" border="0" align="center" cellpadding="0" cellspacing="0">
<tbody><tr>
<?php foreach($service as $item){?>
<td><table align="center" border="0" cellpadding="0" cellspacing="0" width="220">
        <tbody><tr><td width="238" height="140" align="center">        <img src="<?php echo $item->pic_s;?>" border="0" width="200" height="120" /></td></tr>
        <tr><td valign="top" width="238">
        <div align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="200"><tbody><tr><td valign="top">
          <strong><?php echo $item->title;?></strong><br />
          <span><?php echo $item->note;?></span>
          </td></tr></tbody></table>
          </div></td></tr>
        </tbody>
      </table></td>
<?php }?>

</tr></tbody></table>
</td>
<td class="right">&nbsp;</td>
</tr></tbody></table>
</div>
<div class="clear"></div>

</div>

<?php }?>