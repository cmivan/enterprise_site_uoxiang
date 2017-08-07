var static_host = 'http://www.zoomla.cn';
var home_host = 'http://www.zoomla.cn/Article/news';
$(function () {
    if (supportSiteMode()) {
        //添加IE9特殊head
        set__Header();
        //判断是否已经固定网站
        if (window.external.msIsSiteMode()) {
            setInterval("get__Articles()", 30000);
        } else {
            //添加当前网址到开始菜单
            show__AddButton();
        }
    }
});
function set__Header() {

    var s1 = '<link rel="shortcut icon" type="image/x-icon" href="' + static_host + 'favicon.ico" />';
    var s2 = '<meta name="application-name" content="Zoomla!逐浪CMS" />';
    var s3 = '<meta name="msapplication-tooltip" content="Zoomla!逐浪CMS - 中国领先的CMS厂商" />';
    var s4 = '<meta name="msapplication-task" content="name=访问官网;action-uri=http://www.zoomla.cn/;icon-uri=' + static_host + 'favicon.ico" />';
    var s5 = '<meta name="msapplication-task" content="name=下载逐浪CMS;action-uri=http://www.zoomla.cn/pub;icon-uri=' + static_host + 'favicon.ico" />';
    var s6 = '<meta name="msapplication-task" content="name=浏览教程视频;action-uri=http://edu.zoomla.cn/;icon-uri=' + static_host + 'favicon.ico" />';
    var s7 = '<meta name="msapplication-task" content="name=技术论坛;action-uri=http://bbs.zoomla.cn/;icon-uri=' + static_host + 'favicon.ico" />';
    var s8 = '<meta name="msapplication-task" content="name=购买商业授权;action-uri=http://www.zoomla.cn/shop;icon-uri=' + static_host + 'favicon.ico" />';
    $('head').append($(s1)).append($(s2)).append($(s3)).append($(s4)).append($(s5)).append($(s6)).append($(s7)).append($(s8));
}
function show__AddButton() {
    var div = document.createElement('div');
    div.style.position = 'absolute';
    div.style.left = '0px';
    div.style.top = '0px';
    div.style.display = 'block';
    div.style.width = '100%';
    div.style.height = '26px';
    div.style.backgroundColor = '#ffffdd';
    div.style.textAlign = 'center';
    div.style.borderBottom = 'solid 1px #ccc';
    div.innerHTML = '<span style="font-size:14px;font-family:微软雅黑;">将Zoomla!逐浪CMS首页添加到您的开始菜单，实现快速访问。</span>'
        + '<input type="button" value="添加" style="font-size:12px;width:40px;" onclick="window.external.msAddSiteMode();" />'
        + '<a style="float:right;margin:-20px 10px 0 0;found-weight:bold;font-family:Verdana;" title="关闭" href="javascript:void(0);" onclick="javascript:this.parentNode.style.display=\'none\';return false;">X</a>';
    document.body.appendChild(div);
}
var art__ids = '';
function get__Articles() {
    $.getScript(home_host + 'http://www.zoomla.cn/Article/news');
}
function show__Articles(ret) {
    var ids = '';
    for (var i = 0; i < ret.length; i++) {
        ids += (ret[i].id);
    }
    if (ids && art__ids != ids) {
        art__ids = ids;

        window.external.msSiteModeClearJumpList();
        //创建一个自定义栏目
        window.external.msSiteModeCreateJumpList('最新推荐文章');
        for (var i = 0; i < ret.length; i++) {
            //为栏目添加条目
            window.external.msSiteModeAddJumpListItem(ret[i].title, ret[i].url, static_host + "favicon.ico");
        }
        //显示该栏目
        window.external.msSiteModeShowJumpList();
        //改变任务栏的图标
        //window.external.msSiteModeSetIconOverlay('', 'title');
        //图标闪烁
        window.external.msSiteModeActivate();
    }
}
function supportSiteMode() {
    try { return ('msIsSiteMode' in window.external); }
    catch (err) { return false; }
}