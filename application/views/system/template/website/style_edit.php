<?php $this->load->view_system('public/header');?>
<link href="<?php echo base_url();?>public/plugins/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css">
</head>
<body style="overflow:hidden">
<br />
<form class="validform" method="post">
<TABLE border="0" align="center" cellpadding="0" cellspacing="10" class="forum1" style="width:auto;"><tr><td>
<table width="100%" border="0" align=center cellpadding=1 cellspacing=1 class="forum2">
<tr class="forumRaw edit_item_frist"><td colspan="2" align="center"><?php echo $action_name?>风格</td></tr>
<tr class="forumRow">
<td width="100" align="right">&nbsp;&nbsp;&nbsp;所属：</td>
<td width="250"><?php echo cm_form_type_edit_select( $typeB,$type_ids );?></td></tr>

<tr class="forumRow">
  <td align="right">&nbsp;&nbsp;&nbsp;名称：</td>
<td><input type="text" name="type_title" id="type_title"  value="<?php echo $type_title?>"/>&nbsp;</td></tr>

<tr class="forumRow">
  <td align="right">预览图：</td>
<td>
<?php echo $this->kindeditor->up_img('type_pic','pic_btu',200,200);?>
<input type="text" name="type_pic" id="type_pic"  value="<?php echo $type_pic?>"/><input type="button" value="浏览图片" class="button1" id="pic_btu"/>
</td></tr>

<tr class="forumRow">
  <td align="right">简述：</td>
<td><textarea name="type_note" id="type_note"><?php echo $type_note?></textarea></td></tr>

<tr class="forumRow"><td align="right">&nbsp;&nbsp;&nbsp;排序：</td>
<td><input type="text" name="type_order_id" id="type_order_id"  value="<?php echo $type_order_id?>"/>&nbsp;</td></tr>
<tr class="forumRow">
  <td align="right" class="red">注：</td>
  <td class="red">&nbsp;排序数字越大越靠前 </td>
  </tr>
<tr class="forumRaw">
<td align="center">
  <input type="button" class="button" value="返回" id="edit_back"/>
  <input type="hidden" name="type_id" id="type_id"  value="<?php echo $type_id?>"/></td>
<td><input type="submit" class="button" id="save_but" value="&nbsp;"/></td>
</tr>
</table>
</td></tr></table>
</form>
</body>
</html>