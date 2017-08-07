(function($){
$.fn.slideshow=function(){
	if($('#layers').length==0){var $layers=$('<div id="layers"></div>').prependTo("body")}
	else{var $layers=$('#layers');}
	$slidefront=$('<div id="slidefront"><a class="slideclose"></a><div class="slidetitle"></div><div class="slidemain"></div></div>').appendTo($layers);
	$slidefront.find(".slideclose").hover(function(){$(this).css("backgroundPosition","0 -20px")},function(){$(this).css("backgroundPosition","0 0")}).mousedown(function(){$(this).css("backgroundPosition","0 -40px")}).mouseup(function(){$(this).css("backgroundPosition","0 -20px")}).click(function(){
			$slideshadow.animate({left:($("body").width()-$slidefront.width())/2+20+"px",opacity:"hide"},300);
			$slidefront.animate({left:($("body").width()-$slidefront.width())/2+20+"px",opacity:"hide"},300);
	});
	$slideshadow=$('<div id="slideshadow"></div>').appendTo($layers);
	return this.each(function(i){
		$(this).click(function(){
			openslide(i,this);
		return false;})
	})
};
})(jQuery);

function openslide(i,t){
	$("#slidefront").css({left:"-2000px",top:"-2000px"});
	$("#slidefront").find(".slidetitle").html($(t).text().replace(/\>/g,"").replace(/点击进入/g,""));
	$("#slidefront").find(".slidemain").html($("#newsdata div").eq(i).html());
	$("#slideshadow").css({width:$slidefront.width()+"px",height:$slidefront.height()+"px",left:($("body").width()-$slidefront.width())/2-20+"px",top:($(window).height()-$slidefront.height())/2+$(window).scrollTop()+"px"})
	$("#slidefront").css({left:($("body").width()-$slidefront.width())/2-20+"px",top:($(window).height()-$slidefront.height())/2+$(window).scrollTop()+"px"});
			
	$("#slideshadow").css({display:"none"}).animate({left:($("body").width()-$slidefront.width())/2+"px",opacity:"show"},300);
	$("#slidefront").css({display:"none"}).animate({left:($("body").width()-$slidefront.width())/2+"px",opacity:"show"},300);
}