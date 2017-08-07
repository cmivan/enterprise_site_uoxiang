<?php $this->load->view('public/header');?>
<div class="mainWidth">
<div class="banner">
<!--BEGIN #slider .clearfix -->
<?php $this->load->view('public/banner');?>
</div>
<div class="clear"></div>

<?php $this->load->view('service_mob');?>

<div class="not7_left">

<div class="index-about">
<div class="index-about-title">&nbsp;</div>
<div class="index-about-content">
<div class="index-about-note">
<?php echo $modular['aboutus'];?>
</div>
<div class="clear"></div>
<div class="index-news-list">
<?php if(!empty($top_news)){?>
<div class="top_news">
<ul>
<?php foreach($top_news as $item){?>
<li><a href="<?php echo site_url('news/view/'.$item->id);?>" title="<?php echo $item->title;?>"><?php echo cutstr($item->title,24);?></a><span>| <?php echo dateDDD($item->add_time,1);?></span></li>
<?php }?>
</ul>
</div>
<div class="clear"></div>
<?php }?>
</div>
</div>
</div>

</div>


<div class="not7_right">

<?php /*?>
<div class="right_domain">
<TABLE id=Table_01 cellSpacing=0 cellPadding=0 width=222 
      border=0>
        <TBODY>
        <TR>
          <TD>
<form action="http://www.gzidc.com/domain_new.php" method="post" name="frm_Whois" target="_blank" id="frm_Whois" style=" padding:0px; margin:0px;">
<input name="dowhois" type="hidden" value="1">
<input type="hidden" name="module" value="dowhois">
<input type="hidden" name="domain_lang" value="ENG">
<input type="hidden" name="domain_encoding" value="ASCII">
<TABLE width=0 border=0 align="center" cellPadding=0 cellSpacing=0 style="width:80%;">
              <TBODY>
              <TR>
                <TD colSpan=2 height=12>&nbsp;</TD></TR>
              <TR>
                <TD colSpan=2><strong>国际域名查询</strong></TD></TR>
              <TR>
                <TD colSpan=2> www.
                  <INPUT id=domainname maxLength=32 size=8 name=domainname>
                  <INPUT class="btn" type=submit value=查询 name=submit></TD></TR>
              <TR>
                <TD width=80><input type="checkbox" name="tld0" value=".com" id="en_tld0" checked=""> .com</TD>
                <TD width=90><input type="checkbox" name="tld2" value=".net" id="en_tld2" checked="checked" /> 
                  .net</TD></TR>
              <TR>
                <TD><input type="checkbox" name="tld10" value=".cc" id="en_tld10" /> 
                  .cc</TD>
                <TD><input type="checkbox" name="tld6" value=".org" id="en_tld6" /> 
                  .org</TD></TR>
              <TR>
                <TD><input type="checkbox" name="tld9" value=".info" id="en_tld9" /> 
                  .info</TD>
                <TD><input type="checkbox" name="tld8" value=".biz" id="en_tld8" /> 
              .biz</TD></TR>
              <TR>
                <TD>&nbsp;</TD>
                <TD>&nbsp;</TD>
              </TR>
<TR><TD colSpan=2><strong>国内域名查询</strong></TD></TR>
<TR>
                <TD width=80><input type="checkbox" name="tld1" value=".cn" id="en_tld1" checked="checked" />
                  .cn</TD>
                <TD width=90><input type="checkbox" name="tld3" value=".com.cn" id="en_tld3" />
                  .com.cn</TD></TR></TBODY></TABLE></FORM>

</TD>
        </TR>
</TBODY></TABLE>
</div>

<div class="right_contact"><a href="http://sighttp.qq.com/authd?IDKEY=322001ae77b47bfd98f7d104d6f29331143a339131bd96c6" target="_blank"><img src="public/images/contact_info_buttom.jpg" alt="点击可以在线交谈，了解更多关于网站建设方面的服务流程!" width="207" height="61" border="0" /></a></div>

<?php */?>


<div class="right_weibo">
<script type="text/javascript">document.write('<iframe width="300" height="315" frameborder="0" scrolling="no" src="http://widget.weibo.com/relationship/bulkfollow.php?language=zh_cn&uids=3205743943,2862175032&wide=0&color=F5F5F5,F5F5F5,0082CB,666666&showtitle=0&showinfo=1&sense=1&verified=1&count=6&refer='+encodeURIComponent(location.href)+'&dpc=1"></iframe>');</script>
</div>

</div>

</div>

<div class="clear"></div>

<div class="mainWidth">
<!-- 文章列表开始 -->
<div class="articlebox">
<?php $this->load->view('articles_mob');?>
</div>

<div id="footer-icos"><img src="../../public/images/icos/home_asia.jpg" width="72" height="35" /><img src="../../public/images/icos/home_verisign.jpg" width="107" height="48" /><img src="../../public/images/icos/home_best_web.jpg" width="60" height="57" /><img src="../../public/images/icos/home_cmmi5.jpg" width="56" height="59" /><img src="../../public/images/icos/home_cnnic.jpg" width="85" height="41" /><img src="../../public/images/icos/home_cnnic_wing.jpg" width="65" height="52" /><img src="../../public/images/icos/home_icann.jpg" width="56" height="56" /><img src="../../public/images/icos/home_idc.jpg" width="64" height="62" /><img src="../../public/images/icos/home_me.jpg" width="75" height="55" /><img src="../../public/images/icos/home_mobi.jpg" width="87" height="44" /><img src="../../public/images/icos/home_tel.jpg" width="51" height="59" /></div>

</div>

<script type='text/javascript' src="<?php echo base_url();?>public/js/slides.min.jquery.js"></script>
<script type="text/javascript">
		jQuery(document).ready(function() {
			if (jQuery().slides) {
				jQuery("#slider").slides({
					preload: true,
					effect: 'fade',
					fadeSpeed: 250,
					play: 5000,
					crossfade: true,
					generatePagination: false,
					autoHeight: true
				});
			}
		});
</script>

<!-- BEGIN #footer-container -->
<?php $this->load->view('public/footer');?>