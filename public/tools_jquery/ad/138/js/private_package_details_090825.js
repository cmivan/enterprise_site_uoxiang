//*****pic show begin*******
function $A(iterable) {
	var results = [];
	for (var i = 0; i < iterable.length; i++)results.push(iterable[i]);
	return results;
}
Function.prototype.bind = function() {
	var __method = this, args = $A(arguments), object = args.shift();
	return function() {
		return __method.apply(object, args.concat($A(arguments)));
	}
}
function Focus(){ this.initialize.apply(this, arguments) };

Focus.prototype = {
	initialize:function(imgObj){
		_this = this;
		this.sort = null;
		this.link = [];
		this.imgs_full = imgObj;
		this.len = this.imgs_full.length;
		this.up= $("up");
		this.down = $("down");
		this.start = 0 ;
		this.end = 3;
		this.range = this.end - this.start + 1;
		this.img= null;
		this.ul = null;
		this.list = [];
		this.hotelsHTML();
		
		this.down.onclick = function(){
			var sPic = $("sPic");
			if((_this.len - _this.start) > _this.range)	_this.roll(++_this.start,++_this.end,sPic);
			if (_this.list[_this.index])	_this.list[_this.index].className = "on";
		}
		this.up.onclick = function(){
			var sPic = $("sPic");
			if(_this.start >0)	_this.roll(--_this.start,--_this.end,sPic);
			if (_this.list[_this.index])	_this.list[_this.index].className = "on";
		}
	},
	hotelsHTML:function(){
		var bPic = $("bPic");
		var sPic = $("sPic");
		if(bPic){
			var picName = bPic.$("div")[0];
			this.img = $c("img");
			this.img.onload = appendImg.bind(null, bPic, this.img , this.index);
			this.img.src =  this.imgs_full[0] ? this.imgs_full[0].max : null;
			if(this.imgs_full[0]){	
				this.img.title = this.imgs_full[0].title;
				picName.innerHTML = this.imgs_full[0].title;
			}
		}
		if(sPic){
			this.roll(this.start,this.end,sPic);
			if(this.list[0])	this.list[0].className = "on";
		}
	},
	roll:function(m,n,parent){
		var sPic = $("sPic");
		var bPic = $("bPic");
		var del = sPic.$("ul")[0];
		var picName=bPic.$("div")[0];
		if(del && del.parentNode)	del.parentNode.removeChild(del);
		var len = this.imgs_full.length;
		var down = $('down');
		this.up.className ="player_up_on";
		this.down.className ="player_down_on";
		if(m <= 0)	this.up.className ="player_up_off";
		if((len - m) <= (n - m+1))	this.down.className = "player_down_off";
		this.ul = $c('ul');
		this.ul.className="slide_pic_list layoutfix";
		if(down){
			parent.insertBefore(this.ul, down);
		}
		for( var i = 0; i<len; i++){
			this.list[i] = $c('li');
			this.list[i].innerHTML='<img src="'+this.imgs_full[i].min+'" width="81px" height="45px;" title="'+this.imgs_full[i].title+'"; style="display:block" />';
			this.ul.appendChild(this.list[i]);
			if( i>n || i<m )	this.list[i].style.display = 'none';
			
			var _this = this;
			(function(t){
				_this.list[t].onclick = function(){ 

					if(t != _this.index)	_this.change(t,bPic,_this.imgs_full);
				}
			})(i);
		}
	},
	change:function(n,ob,image){
		var imgNum=n;
		var imgContent = image;
		if(this.img && this.img.parentNode == ob){
			ob.removeChild(this.img);
			this.img = $c("img");
			this.img.onload = appendImg.bind(null, ob, this.img, imgNum);
			this.img.src = imgContent[n].max;
			if(imgContent[n].title)	this.img.title = imgContent[n].title;
			for(var i = 0; i <imgContent.length;i++)
				this.list[i].className = '';
			this.index = n;	
			this.list[this.index].className = "on";
		}
		else if(this.img){
			this.img = $c("img");
			this.img.onload = appendImg.bind(null, ob, this.img, imgNum);
			this.img.src = imgContent[n].max;
			if(imgContent[n].title)	this.img.title = imgContent[n].title;
			for(var i = 0; i <imgContent.length;i++)
				this.list[i].className = '';
			this.index = n;	
			this.list[this.index].className = "on";
		}
	}
};

function appendImg(box, img ,imgNum){
	var info=$$.module.pkgInterface.pkgDetail.pic;
	img.style.display = 'block';
	var height = box.clientHeight;
	var width = box.clientWidth;
	if(img.width > width || img.height > height){
		if((img.width / width)  >= (img.height / height)){
			img.height = img.height / (img.width / width);
			img.width = width ;
		}
		else{
			img.width = img.width /(img.height / height);
			img.height = height;
		}
	}
	if(/MSIE/.test(navigator.userAgent)){
		img.style.marginTop = (height - img.height+10) / 2 +"px";
	}
	else{
		img.style.marginTop = (height - img.height) /2 +"px";
	}
	//img.style.marginLeft = (width - img.width) / 2 +"px";
	box.innerHTML = '<div id="picName" class="package_name"></div>';
	if(imgNum) $('picName').innerHTML=info[imgNum].title;
	else $('picName').innerHTML=info[0].title;
	box.appendChild(img);
}
function indexArr(id,arr){
	for(var b = 0; b< arr.length; b++) {
		if(id == arr[b])	return b;
	}
}

window.onload = function(){
	window.init = new Focus($$.module.pkgInterface.pkgDetail.pic);
}
//*****pic show end*******

//**********************************
//书页效果 cdchu 090911
//**********************************

//初始化行程信息
$r("domReady",function(){
	var pkgBook=$("pkgBook");
	if (!pkgBook)
		return;
	var previousPageLink=$("previousPageLink");
	var nextPageLink=$("nextPageLink");
	if ($$.browser.IE)
		pkgBook.style.zoom=1;
	var pkgBookBtn=[],pkgBookPanel=[],num=0;
	while (1){
		var tmpBtn=$("pkgBookBtn"+(num+1));
		var tmpPanel=$("pkgBookPanel"+(num+1));
		if (tmpBtn&&tmpPanel){
			var leftPanel=tmpPanel.$selNode("div.intro");
			var rightPanel=tmpPanel.$selNode("div.intro_right");
			if (leftPanel&&rightPanel){
				tmpPanel.leftPanel=leftPanel[0];
				tmpPanel.rightPanel=rightPanel[0];
				var tmpDiv=$c("div");
				if (tmpPanel.rightPanel.firstChild)
					tmpPanel.rightPanel.insertBefore(tmpDiv,tmpPanel.rightPanel.firstChild);
				else
					tmpPanel.rightPanel.appendChild(tmpDiv);
				tmpPanel.rightPanel.topPanel=tmpDiv;
				var tmpDiv=$c("div");
				tmpPanel.rightPanel.appendChild(tmpDiv);
				tmpPanel.rightPanel.bottomPanel=tmpDiv;
				pkgBookBtn.push(tmpBtn);
				pkgBookPanel.push(tmpPanel);
				if ($$.browser.IE)
					tmpPanel.style.zoom=1;
				num++;
			}
		}else
			break;
	}
	if (!num)
		return;
	var lastPage=null,nextPage=null,currentPage=null,trans=false;
	function showBookPage(i){
		return function(){
			if (trans){
				nextPage=i;
				return;
			}
			nextPage=null;
			if (lastPage==i)
				return;
			currentPage=i;
			previousPageLink.style.color=i==0?"#999":"#444";
			nextPageLink.style.color=i==num-1?"#999":"#444";
			trans=true;
			function transEnd(){
				lastPage=i;
				trans=false;
				if (nextPage)
					showBookPage(nextPage)();
			}
			if ($$.browser.IE){
				pkgBook.style.filter="progid:DXImageTransform.Microsoft.Fade(duration=1)";
				pkgBook.filters[0].apply();
				if (lastPage!==null)
					pkgBookPanel[lastPage].style.display="none";
				pkgBookPanel[i].style.display="";
				pkgBook.filters[0].play();
				transEnd();
			}else{
				function showPanel(){
					pkgBookPanel[i].style.display="";
					doAlphaTrans(i,0,100,transEnd);
				}
				if (lastPage!==null){
					doAlphaTrans(lastPage,100,0,function(){
						pkgBookPanel[lastPage].style.display="none";
						showPanel();
					});
				}else
					showPanel();
			}
		};
	}
	function moveToPage(i){
		return function(){
			pkgBookBtn[Math.min(Math.max(currentPage+i,0),num-1)].$click();
			showBookPage(Math.min(Math.max(currentPage+i,0),num-1));
		};
	}
	previousPageLink.$r("click",moveToPage(-1));
	nextPageLink.$r("click",moveToPage(1));
	function doAlphaTrans(i,a,b,callback){
		(function(){
			if (a<b)
				a=Math.min(a+10,b);
			else
				a=Math.max(a-10,b);
			pkgBookPanel[i].style.opacity=a/100;
			if (a==b)
				callback();
			else
				setTimeout(arguments.callee,20);
		})();
	}
	for (var i=0;i<num;i++){
		var nodes=pkgBookPanel[i].leftPanel.$("*");
		if (nodes){
			for (var j=0;j<nodes.length;j++)
				if (/^div$/i.test(nodes[j].tagName)){
					var align=nodes[j].getAttribute("align");
					if (/^top$/i.test(align))
						pkgBookPanel[i].rightPanel.topPanel.appendChild(nodes[j--]);
					if (/^bottom$/i.test(align))
						pkgBookPanel[i].rightPanel.bottomPanel.appendChild(nodes[j--]);
				}
		}
		pkgBookBtn[i].$r("click",showBookPage(i));
	}
	showBookPage(0)();
});

//传统模式，记事本模式
$r("domReady",function(){
	var traditional=$("traditional");
	var notebookVer=$("notebookVer");
	function setVer(ver){
		return function(){
			$$.cookie.expires=24*31;
			$setCookie("abTestingVer","detailNotebook",ver);
		}
	}
	if (traditional)
		traditional.$r("click",setVer("a"));
	if (notebookVer)
		notebookVer.$r("click",setVer("b"));
});