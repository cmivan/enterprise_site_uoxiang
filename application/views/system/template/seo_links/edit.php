<?php $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<tbody><tr class="forumRaw"><td align="center"><?php echo $dbtitle;?> 更新/录入</td>
</tr></tbody></table>

<form class="validform" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2">
<tbody><tr class="forumRow">
    <td align="right">网站名称：</td><td><input name="title" type="text" id="title" value="<?php echo $rs['title']?>" size="45">
</td></tr>

<tr class="forumRow">
  <td align="right" style="">链接地址：</td><td><input name="url" type="text" id="url" value="<?php echo $rs['url']?>" size="75"></td></tr>

<tr class="forumRow"><td align="right">排序：</td>
  <td><input type="text" name="order_id" id="order_id" value="<?php echo $rs['order_id'];?>"></td>
</tr>

<tr class="forumRaw">
  <td width="88" align="right" valign="top">
    <input name="id" type="hidden" value="<?php echo $rs['id']?>">
    <input name="edit" type="hidden" value="ok">
    </td>
  <td><input name="submit" type="submit" value="&nbsp;" id="save_but"></td>
</tr>

</tbody>
</table>
</form>

</td></tr></tbody></table>
</body></html>