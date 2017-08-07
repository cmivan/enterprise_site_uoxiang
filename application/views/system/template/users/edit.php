<?php $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>

<?php $this->load->view_system('template/'.$dbtable.'/nav');?>

<form class="validform" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<tbody>

<?php if( is_num($rs['id']) ){?>
<tr class="forumRaw">
<td colspan="5" align="center"><strong class="red">基本信息</strong></td>
</tr>
<?php }?>

<tr class="forumRow">
<td align="right">称呼：</td><td><input name="nicename" type="text" id="nicename" value="<?php echo $rs['nicename']?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right">用户名：</td>
<td><input name="username" type="text" id="username" value="<?php echo $rs['username']?>" size="45">
<span class="red">（用于登录的）</span>
</td></tr>

<tr class="forumRow">
<td align="right">邮箱：</td>
<td><input name="email" type="text" id="email" value="<?php echo $rs['email']?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right">手机：</td>
<td><input name="mobile" type="text" id="mobile" value="<?php echo $rs['mobile']?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right">固话：</td><td>
<input name="tel" type="text" id="tel" value="<?php echo $rs['tel']?>" size="45">
</td></tr>

<?php /*?>
<tr class="forumRow">
  <td align="right" style="">头像：</td>
  <td style="">
  <?php echo $this->kindeditor->up_img('face','face_btu',200,200);?>
  <input readonly name="face" id="face" type="text" value="<?php echo $rs['face']?>" size="45" maxlength="255"><input type="button" value="浏览图片" class="button1" id="face_btu"/>
  &nbsp;&nbsp;宽：200px 高：200px </td>
</tr>
<?php */?>

  
<tr class="forumRow">
  <td align="right">设置：</td>
  <td height="24">
    &nbsp;<?php echo cm_form_checkbox('封锁','ok',$rs['ok']);?>&nbsp;
    ( <span class="red">打上勾后，这个用户就不能登录了</span> )
  </td></tr>

<tr class="forumRow">
<td align="right">简述：</td><td>
<textarea name="note" cols="45" rows="4" id="note" style="width:460px;"><?php echo $rs['note'];?></textarea>
</td></tr>

<tr class="forumRaw">
  <td width="88" align="right" valign="top">
    <input name="id" type="hidden" value="<?php echo $rs['id']?>">
    <input name="edit" type="hidden" value="ok">
    </td>
  <td><input name="submit" type="submit" value="&nbsp;" id="save_but">
  <span class="red">( 注：在这里添加的用户，默认登录密码是：PFT0002012)</span>
  </td>
</tr>

</tbody>
</table>
</form>

</td></tr></tbody></table>
</body></html>