// by  : cm.ivan
// blog: http://www.5cmlabs.com
// time: 2012-11-25
$(function(){
	
	//顶部二级导航动画效果
/*	var _topNav2 = $('#topNav2');
	$('#topNav .nav2').mouseover(function(){
		var _l = $(this).offset().left;
		var _t = $(this).offset().top;
		_topNav2.show(0).animate({'left':_l});
	}).mouseout(function(){
		_topNav2.attr('out','true');
		setTimeout(function(){ var out = _topNav2.attr('out'); if(out=='true'){ _topNav2.hide(0); } },80);
	});
	_topNav2.mouseover(function(){
		_topNav2.attr('out','false');
	}).mouseout(function(){
		_topNav2.attr('out','true');
		setTimeout(function(){ var out = _topNav2.attr('out'); if(out=='true'){ _topNav2.hide(0); } },80);
	});*/

	//套餐切换
	var $taocanObj = $('#taocan').find('.left div');
	var $taocanTabObj = $('#taocan').find('.tab-box-item');
	$taocanObj.eq(1).attr('class','on');
	$taocanTabObj.eq(1).fadeIn(1000);
	$taocanObj.mouseover(function(){
		var thisIndex = $(this).index();
		$(this).parent().find('div').attr('class','');
		$(this).attr('class','on');	
		
		$taocanTabObj.fadeOut(0);
		$taocanTabObj.eq(thisIndex).fadeIn(0);
	});
	
	//文章边框变换颜色
/*	var $articleboxObj = $('.articlebox').find('.article_item');
	$articleboxObj.hover(
	function(){
		var borderColor = $(this).css('border-color');$(this).attr('border-color',borderColor);
		$(this).css({'border-color':'#FF3300'});
		},
	function(){
		var borderColor = $(this).attr('border-color');
		$(this).css({'border-color':borderColor});
		}
	);*/
});