<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $cm_pro['name'];?> v<?php echo $cm_pro['version'];?> By:<?php echo $cm_pro['author'];?></title>
<link href="<?php echo $style['css_url'];?>system_theme/style/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?php echo $style['css_url'];?>system_theme/style/jquery.1.4.js"></script>
<script language="javascript" src="<?php echo $style['css_url'];?>system_theme/style/jquery.edit.style.js"></script>
<script language="javascript">
$(function(){
	$(".menu").find("dl").find("dt").find("a").click(function(){
		$(this).parent().parent().parent().find("dd").css({"display":"none"});
		$(this).parent().parent().find("dd").css({"display":"block"});
	});
	$(".menu").find("dl").eq(0).find("dd").css({"display":"block"});
});
</script>
<style type="text/css">
*{margin:0px;}
body{
	background-color:#9E9C92;
	background-image:url(<?php echo $style['css_url'];?>system_theme/left_top_bg.gif);
	background-position:left top;background-repeat:repeat-y;overflow-x:hidden;
}
</style>
<base target="main">
</head>


<body>
<div class="menu">
<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">网站信息</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('system_user/index');?>">管理员管理</a></li>
<li><a target="main" href="<?php echo site_system('system_user/edit');?>">添加管理员</a></li>
<li><a target="main" href="<?php echo site_system('cm_stat/index');?>">访问统计</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">网站展示</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('website/manage');?>">网站管理</a></li>
<li><a target="main" href="<?php echo site_system('website/edit');?>">添加网站</a></li>
<li><a target="main" href="<?php echo site_system('website/type');?>">分类管理</a></li>
<li><a target="main" href="<?php echo site_system('website/style');?>">风格管理</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<?php /*?><dl>
<dt><a href="javascript:void(0);">栏目管理</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('columns/manage');?>">项目管理</a></li>
<li><a target="main" href="<?php echo site_system('columns/edit');?>">添加项目</a></li>
<li><a target="main" href="<?php echo site_system('columns/type');?>">栏目管理</a></li>
</ul></dd></dl><?php */?>

<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">信息管理</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('news/manage');?>">新闻管理</a></li>
<li><a target="main" href="<?php echo site_system('news/edit');?>">添加新闻</a></li>
<li><a target="main" href="<?php echo site_system('news/type');?>">分类管理</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<?php /*?><dl>
<dt><a href="javascript:void(0);">下载中心</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('download/manage');?>">下载管理</a></li>
<li><a target="main" href="<?php echo site_system('download/edit');?>">添加下载</a></li>
<li><a target="main" href="<?php echo site_system('download/type');?>">分类管理</a></li>
</ul></dd></dl><?php */?>

<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">栏目管理</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('columns/manage');?>">项目管理</a></li>
<li><a target="main" href="<?php echo site_system('columns/edit');?>">添加项目</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">友情链接</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('links/manage');?>">友情链接管理</a></li>
<li><a target="main" href="<?php echo site_system('links/edit');?>">添加友情链接</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">SEO链接</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('seo_links/manage');?>">SEO链接管理</a></li>
<li><a target="main" href="<?php echo site_system('seo_links/edit');?>">添加SEO链接</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">Banner图</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('banner/manage');?>">首页Banner管理</a></li>
<li><a target="main" href="<?php echo site_system('banner/edit');?>">添加首页Banner</a></li>

<li><a target="main" href="<?php echo site_system('banner_page/manage');?>">页面Banner管理</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">其他模块</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('modular/manage');?>">模块管理</a></li>
<li><a target="main" href="<?php echo site_system('modular/edit');?>">添加模块</a></li>
</ul></dd></dl>


<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">文章管理</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('articles/manage');?>">文章管理</a></li>
<li><a target="main" href="<?php echo site_system('articles/edit');?>">添加文章</a></li>
<li><a target="main" href="<?php echo site_system('articles/type');?>">分类管理</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<dl>
<dt><a href="javascript:void(0);">业务管理</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('service/manage');?>">业务管理</a></li>
<li><a target="main" href="<?php echo site_system('service/edit');?>">添加业务</a></li>
</ul></dd></dl>

<!-- Item Strat -->
<?php /*?><dl>
<dt><a href="javascript:void(0);">会员信息</a></dt>
<dd style="display: none; "><ul>
<li><a target="main" href="<?php echo site_system('users/manage');?>">会员管理</a></li>
<li><a target="main" href="<?php echo site_system('users/edit');?>">添加会员</a></li>
</ul></dd></dl><?php */?>

<dl class="copyright">
<dt><a>版权信息</a></dt><dd style="display: none; "><ul>
<li>
<a href="http://www.qxad.com/" target="_blank" style=" color:#333333;line-height:20px;padding:3px; padding-left:12px; margin:0; text-indent:0; background:none; border-left:#CCCCCC 1px solid; border-top:#CCCCCC 1px solid; width:136px;">开发：齐翔<br>联系：cm.ivan@163.com<br>官网：齐翔广告<br></a>
</li>
</ul></dd></dl>


<dl>
<dt><a href="<?php echo site_system('system_defaults/out');?>" target="_top">退出管理</a></dt></dl>
<!-- Item End -->
</div>

</body></html>