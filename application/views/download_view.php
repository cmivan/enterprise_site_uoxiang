<?php $this->load->view('public/header');?>
<body>
<div id="container" style="padding:50px;text-align:center;">
<h2>下载文档：《<?php echo $view->title;?>》</h2>
<br><br>

<form class="form-inline" method="post">
<input type="password" value="<?php echo $password;?>" name="password" placeholder="请在这里填写密码!"/>
<input type="hidden" value="down" name="action"/>
<button type="submit" class="btn"><i class="icon-download"></i>下载</button>
</form>

<?php if($errtip!=''){?>
<span class="red">温馨提示：<?php echo $errtip;?></span>
<?php }?>

</div></body></html>