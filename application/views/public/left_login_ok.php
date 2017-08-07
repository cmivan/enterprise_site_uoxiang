<?php if(!empty($user_power)){?>
<div class="sidebar_left">
<div><strong><?php echo $logbox['control'];?></strong></div>

<div style="padding-top:7px; text-decoration:underline;"><b><?php echo $user_power['nicename'];?> , <?php echo greetings();?></b></div>
<div><?php echo $site['welcome'];?><?php echo $site['sitename'];?> !</div>
<div class="hr">&nbsp;</div>
<div style="padding-top:4px;"><?php echo getnav($nav,'user');?> | <?php echo getnav($nav,'user/out','','login_out');?></div>
<br />
<div class="clear"></div>
</div>
<?php }?>