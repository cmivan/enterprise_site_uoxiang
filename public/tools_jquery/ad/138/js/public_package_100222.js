/***package public module ***/
/***author : feifei ***/
/***date : 2009-08-26 ***/

/***interface***/
$$.module.pkgInterface = {};

$$.module.pkgInterface =
{
	
	 addToCompare: function(arr){
		if($("ccontainer"))
			maskShow($("ccontainer"));
		compareClass.insertItem(arr);
	},
	beginCompare: function(isopen){
		if(compareClass.checkItem()){
			compareClass.updateItem();
			if($("ccontainer")){maskShow(null);}
			if(isopen){
				window.open($$.module.pkgInterface.compareLink);
			}else{
				location.replace($$.module.pkgInterface.compareLink);
			}
		}
		else
			return false;
	}
}

$$.module.pkgInterface.BaseInfo = {};


/***CompareList Class***/

function compareList(opt){
	this.initItems(opt);
}

compareList.prototype = {
	//set option
	option : {
		template : '<li id="cookie_{itemid}"><input type="checkbox" name="checkbox" {disabled}/> <a href="###">{content}</a><div class="base_price01"><dfn>&yen;{price}</dfn>起</div></li>',
		data: [
			[1,"三南山三南山" , 2999],
			[2,"青岛四日游" , 1580],
			[3,"三亚蜜月五日游" , 4890],
			[4,"三亚蜜月五日游" , 4890]
		],
		container : "compareBox",
		msgdiv : "compareMsg",
		message : [
			"只能收藏对比5个产品，<br />请删除后再添加。",
			"产品已经在对比栏中",
			"自由行产品不能进行对比",
			"请选择2到3个产品进行对比"
		],
		cookie: "packageCompare",
		max: 5
	},
	
	setOption : function(opt){
		for(var s in opt){
			this.option[s] = opt[s];
		}
	},
	
	//check if value is in the array
	//@ori: the existing value
	//@nval : the check value
	isInArray : function(ori , nval , isexact){
		for(var i=0,l=ori.length;i<l;i++){
			if((isexact&&nval==ori[i]) || (!isexact&&ori[i].indexOf(nval)) )
				return true;
		}
		return false;
	},
	
	//alert an error or warning message
	//@el : the message shows around the el element
	//@msg : the message content
	alertMsg : function(msg , isshow){
		var el = $(this.option.msgdiv);
		el.style.display = isshow?"":"none";
		if(msg)	el.innerHTML = msg;
		$(this.option.container).style.zoom=1;
	},

	//insert cookie
	//@key : primary key
	//@value : cookie value
	insertCookie: function(value){
		var Days = 1;
		var exp  = new Date();
		exp.setTime(exp.getTime() + Days*24*60*60*1000);
		__.cookie = this.option.cookie + "="+ escape (value) + ";expires=" + exp.toGMTString();
		return true;
	},

	//get Cookie
	//@key : primary key
	getCookie: function(){
		var arr = __.cookie.match(new RegExp("(^| )"+this.option.cookie+"=([^;]*)(;|$)"));
		if(arr != null) return unescape(arr[2]); return null;
	},

	//update cookie
	//@value: product id
	//@issel : whether in the compare page
	//@isinsert: whether insert or remove
	updateCookie: function(value , issel , isinsert){
		var str = this.getCookie();
		if(str==null&&isinsert){
			this.insertCookie(issel+":"+value+";");
			return true;
		}
		var re = new RegExp("([F|T]):"+value+";");
		var arr = str.match(re);
		if(isinsert){
			if(arr==null){  //not in the compare cookie
				str +=issel+":"+value+";";
				this.insertCookie(str);
			}
			else if(arr[1]==issel){  //already in the compare list
				this.alertMsg(this.option.message[1] , true);
				return false;
			}
			else if(arr[1]!=issel){  //modify the true|false state
				str = str.replace(re , issel+":"+value+";");
				this.insertCookie(str);
			}
			return true;
		}else{
			if(arr==null) return false;
			str = str.replace(re,"");
			this.insertCookie(str);
			return true;
		}
	},

	//init the item and its event
	initItems : function(opt){
		this.setOption(opt);
		if(!$(this.option.container)) return;
		//console.log(this.getCookie(this.option.cookie));
		/*this.option.data.each(function(item , index){
			$(this.option.container).innerHTML  += this.getItemHtml(item);
		}.bind(this));*/
		this.initEvent();
	},

	//get the item html by modify the html
	getItemHtml : function(arr){
		var dis = arr[3]==0?"":"disabled";
		return this.format(this.option.template , {
			itemid : arr[0],
			content : arr[1],
			price : arr[2],
			disabled: dis
		});
	},

	format : function(str,obj){
		return str.replace(/\{(\w+)\}/g, function(_, s){
			return s in obj ? obj[s] : _;
		});
	},

	//insert a new node
	//@ new dom to be inserted
	//@ direction: first / last
	insertItem : function(arr , direction){
		this.alertMsg("", false);
		if(this.option.itemNum>=this.option.max){
			this.alertMsg(this.option.message[0] , true);
			return;
		}
		if(this.updateCookie(arr[0] , "F" , true)){
			this.option.itemNum++;
			$(this.option.container).innerHTML += this.getItemHtml(arr);
			if(arr[2]==0){
				$("cookie_"+arr[0]).$("div")[0].innerHTML = "实时计价";
			}
			/*if(arr[3]==1)
				this.alertMsg(this.option.message[2] , true);*/
		}
	},
	
	//remove a node
	//@ the dom to be removed
	removeItem : function(removedom){
		if(!removedom) return;
		this.alertMsg("", false);
		var id = removedom.id.split('_')[1];
		if(this.updateCookie(id , "F" , false)){
			removedom.parentNode.removeChild(removedom);
			this.option.itemNum--;
			if($(this.option.msgdiv).style.display=="")
				$(this.option.msgdiv).style.display="none";
		}
	},

	//update a cookie
	updateItem: function(){
		var lis = $(this.option.container).$("li");
		for(var i=0,l=lis.length;i<l;i++){
			var id = lis[i].id.split("_")[1];
			var state = lis[i].$("input")[0].checked.toString().charAt(0).toUpperCase();
			this.updateCookie(id , state , true);
		}
	},
	
	//show delete button
	//add delete event
	initEvent : function(){
		var that=this;
		//show delete button
		$(this.option.container).$r("mouseover" , function(e){
			var el = $fixE(e).$target;
			if(el.tagName=="LI"){
				var s = $(that.option.container).$("span");
				if(s.length==1)	s[0].parentNode.removeChild(s[0]);
				var ns = $c("span");
				ns.className = "package_contrast_delete";
				el.insertBefore(ns , el.childNodes[1]);
			}
		});

		$(this.option.container).$r("mousedown" , function(e){
			var el = $fixE(e).$target;
			if(el.tagName=="SPAN" && el.className=="package_contrast_delete"){
				that.removeItem(el.parentNode);
			}
		});
		this.option.itemNum = $(this.option.container).$("li").length;
	},

	//check item
	checkItem: function(){
		var flag = 0;
		var lis = $(this.option.container).$("li");
		for(var i=0,l=lis.length;i<l;i++){
			if(lis[i].$("input")[0].checked == true){flag=flag+1;}
		}
		if(flag>=2&&flag<=3){return true;}
		this.alertMsg(this.option.message[3] , true);
		return false;
	}
};

var opt = {
	data: [
			[1,"三南山三南山" , 2999],
			[2,"青岛四日游" , 1580],
			[3,"三亚蜜月五日游" , 4890]
	],
	container : "compareBox"
}


//灰色浮出层提示框
//floatntc模块
Ctrip.module.floatntc = function(obj){
	obj.module.floatntc = new function(){
		this.enabled = true;
		this.tip = obj.getAttribute("mod_floatntc_tip");
		this.check = function(){return true;};
		this.isNull = function(){
			return obj.value.trim() == "" || obj.value == obj.module.floatntc.tip;
		}
		//this.x = posX(obj);
		//this.y = posY(obj);
	};

//	function posX(e){
//		var x = e.offsetLeft;
//		if(e.offsetParent!=null)	x+=posX(e.offsetParent);
//		return x;
//	}
//
//	function posY(e){
//		var y = e.offsetTop;
//		if(e.offsetParent!=null)	y+=posY(e.offsetParent);
//		return y;
//	}


	obj.$r("focus" , function(){
		var gt = $("graytips");
		var fo = obj.module.floatntc;
		if(fo.enabled == true && fo.isNull()){
			gt.style.display="";
			gt.$("ul")[0].$("li")[0].innerHTML = fo.tip;
			gt.style.width = obj.offsetWidth+"px";
			gt.$setPos(obj,"lb","lt");
			gt.$setIframe();
			gt.style.zIndex = 101;
		}
	} , 30);
	
	obj.$r("blur" , function(){
		var gt = $("graytips");
		if(obj.module.floatntc.enabled == true){
			gt.style.display="none";
			gt.$clearIframe();
		}
	} , 91);
}

//右侧价格改动显示
function priceBar(){
	this.initItem();
}

priceBar.prototype = {
	initItem: function(){
		this.pId = $("pricebar");
		this.pIdIE = $("pricebar_ie");
		if(this.pId&&typeof($$.module.pkgInterface.BaseInfo.pkgBase)=="number"){
			this.opdom = this.pId.$("dfn")[0];
			this.oppdom = this.pId.$("dfn")[1];
			this.opdomie = this.pIdIE.$("dfn")[0];
			this.oppdomie = this.pIdIE.$("dfn")[1];
			this.updateAmount = this.baseAmount = $$.module.pkgInterface.BaseInfo.pkgBase;
			this.opHash= {};
			this.setHtml();
		}
	},

	updatePrice: function(key , disprice){
		this.opHash[key] = disprice;
		var x = 0;
		for(var k in this.opHash){
			x +=this.opHash[k];
		}
		this.updateAmount = this.baseAmount+x;
		this.setHtml();
	},
	
	getPrice: function(){
		return this.updateAmount;
	},
	
	setHtml: function(){
		this.opdom.innerHTML = this.opdomie.innerHTML = parseInt(this.updateAmount);
		this.oppdom.innerHTML =  this.oppdomie.innerHTML = Math.ceil(this.updateAmount/$$.module.pkgInterface.BaseInfo.peoNum);
	}
}
	 

$r("domready" , function(){
	window.compareClass = new compareList(opt);
	window.priceBar = new priceBar();
});

window.onload = function(){
	function posX(e){
			var x = e.offsetLeft;
			if(e.offsetParent!=null)	x+=posX(e.offsetParent);
			return x;
	}
	
	if($("pricebar")){
			var obj = $("pricebar_ie");
		if(($$.browser.IE && $$.browser.IE6)||($$.browser.IE && window.screen.height==600 && window.screen.width==800)){
			obj.style.display='block';
			window.temptop=$('base_wrapper').offsetHeight-$('base_ft').offsetHeight-obj.offsetHeight-24;
			obj.style.position='absolute';				
			obj.style.marginTop=window.temptop+'px'		
			obj.style.marginLeft=$('base_main').offsetWidth+posX($('base_main'))-158+'px';
			obj.style.top = '0px';
			obj.style.left = '0px';
			obj.style.width="154px";
		
		}else{
			obj.style.display='none';
			function posY(e){
				var y = e.offsetTop;
				if(e.offsetParent!=null)	y+=posY(e.offsetParent);
				return y;
			}
			
			function magicScroll(){
				var st = ___.scrollTop||document.body.scrollTop;
				
				if(st > ot)
					$("pricebar").className = "base_box package_ptfix";
				else
					$("pricebar").className = "base_box";
			}

			var ot = posY($("base_main"));
			window.onscroll = magicScroll;
			
			magicScroll();
		}
	}
}
//*****************************
//推荐给朋友 cdchu 090911
//*****************************
$r("domReady",function(){
	var sendToFriendsDiv=$("sendToFriendsDiv");
	if (!sendToFriendsDiv||!$$.module.pkgInterface.sendToFriendsAjax)
		return;
	var sendToFriendsBtn=$("sendToFriendsBtn");
	var sendToFriendsTable=$("sendToFriendsTable");
	var sendToFriendsSucceed=$("sendToFriendsSucceed");
	var sendToFriendsFailed=$("sendToFriendsFailed");
	var username=$("username");
	var email=[];
	var ajaxFlag=false;
	var i=1;
	while (1){
		var tmpObj=$("email"+i);
		if (tmpObj){
			email.push(tmpObj);
			i++;
		}else
			break;
	}
	sendToFriendsBtn.$r("click",function(){
		var usernameStr=username.value.trim();
		if (!usernameStr){
			$alert(username,"请输入您的姓名",false);
			return false;
		}
		var arr=[];
		for (var i=0;i<email.length;i++){
			var tmpStr=email[i].isNull()?"":email[i].value.trim();
			if (tmpStr){
				if (!tmpStr.isEmail()){
					$alert(email[i],"电子邮箱地址格式错误<br />格式例如：name@ctrip.com",false);
					return false;
				}
				arr.push(tmpStr);
			}
		}
		if (!arr.length){
			$alert(email[0],"请输入至少一个电子邮箱地址",false);
			return false;
		}
		var str="username="+escape(usernameStr)+"&email="+escape(arr.join(";"))+"&"+($$.module.pkgInterface.sendToFriendsExt||"");
		sendToFriendsBtn.disabled=true;
		sendToFriendsSucceed.style.display="none";
		sendToFriendsFailed.style.display="none";
		ajaxFlag=true;
		$ajax($$.module.pkgInterface.sendToFriendsAjax,str,function(str){
			if (/^true$/i.test(str||"")){
				sendToFriendsTable.style.display="none";
				sendToFriendsSucceed.style.display="";
				for (var i=0;i<email.length;i++){
					email[i].value="";
					if (email[i].module.notice)
						email[i].module.notice.check();
				}
			}else
				sendToFriendsFailed.style.display="";
			sendToFriendsBtn.disabled=false;
			ajaxFlag=false;
		});
	});
	
	//关闭浮出层
	var sendToFriendsClose=$("sendToFriendsClose");
	sendToFriendsClose.$r("click",function(){
		maskShow();
	});

	//初始化链接
	var sendToFriendLink=$("sendToFriendLink");
	if (sendToFriendLink){
		sendToFriendLink.$r("click",function(){
			maskShow(sendToFriendsDiv,true);
			if (!ajaxFlag){
				sendToFriendsTable.style.display="";
				sendToFriendsSucceed.style.display="none";
				sendToFriendsFailed.style.display="none";
			}
		});
	}
});




/******过滤录入的信息*****/
function filterHTML(str){
	if (str){
		str=str.replace(/<[^>]+>/g,function(a){
			a=a.replace(/\s+(color|style|class|bgcolor|width|height)=[^\s]+?(?=((\/?>)|\s))/gi,"");
			return a;
		});
		str=str.replace(/<table[^>]*>/gi,function(a){
			a=a.replace(/\s+(border|cellpadding|cellspacing)=[^\s]+?(?=((\/?>)|\s))/gi,"");
			a=a.replace(/(<[^>]+?)(\/?>)/,function(a,b,c){
				return b+" class=\"pubGlobal_romList01\" cellpadding=\"0\" cellspacing=\"0\""+c;
			});
			return a;
		});
		return str;
	}
}

//配送的地址table
Ctrip.module.colorTab = function(obj){
	var selIndex=0;
	obj.$r("mouseover" , function(e){
		var trs = obj.rows;
		var el = $fixE(e).$target;
		var tr = el.$parentNode("tr");

		trs[selIndex].style.backgroundColor="#FFFFFF";
		tr.style.backgroundColor = "#E5EEFD";
		tr.style.cursor = "pointer";
		selIndex = tr.rowIndex;
	});

	obj.$r("mousedown" , function(e){
		var el = $fixE(e).$target;
		var tr = el.$parentNode("tr");
		var inps = tr.$("input")[0];
		if(inps && inps.type=="radio"){
			inps.checked = inps.checked=="checked"?"":"checked";
		}
	});
}














/*
 * CtripUI
 * by YCao@2009-09
 * 度假UI组件
 */
var CtripUI={};

CtripUI['Cmp'] = [];
CtripUI['getCmp'] = function(id) {
	for (var c = 0; c < CtripUI['Cmp'].length; c++) {
		if (CtripUI['Cmp'][c].id == id) {
			return CtripUI['Cmp'][c].cmp;
		}
	}
}
	
//手分琴
CtripUI.accordion = function() {
	this.initialize(arguments[0]);
	CtripUI['Cmp'].push({
		id: arguments[0]['id'] || 'CtripUI' + parseInt(Math.random() * 10000),
		cmp: this
	});
}
CtripUI.accordion.prototype = {
    setOption: function() {
        for (var opt in this.options) {
            this[opt] = this.options[opt];
        }
        for (var opt in arguments[0]) {
            this[opt] = arguments[0][opt];
        }
    },
    options: {
        target: null,
        defaultindex: null,
        listtag: '',
        titlecls: '',
        defaultcls: '',
        clickcls: '',
        hovercls: '',
        clickedcls: '',
        disablecls: ''
    },
    next: function(el) {
        var obj = el.nextSibling;
        while (obj && obj.nodeType != 1) {
            obj = obj.nextSibling;
        }
        return obj;
    },
    hasClass: function(obj, strName) {
        var reg = new RegExp('(\\s|^)' + strName + '(\\s|$)');
        return obj.className.match(reg);
    },
    addClass: function(obj, strName) {
        var temp = obj.className + ' ' + strName;
        obj.className = temp.trim();
    },
    removeClass: function(obj, strName) {
        if (this.hasClass(obj, strName)) {
            var reg = new RegExp('(\\s|^)' + strName + '(\\s|$)');
            obj.className = obj.className.replace(reg, ' ').trim();
        }
    },
    initialize: function() {
        this.setOption(arguments[0]);
        this.target = $(this.target);
        this.arrList = $(this.target).$g(this.listtag);
        this.bind();
    },
    bind: function() {
        this.arrList.each(function(item, index) {
            if (index === this.defaultindex) {
                this.setActive(index);
            }
            item.$r('click', this.click.bind(this, item));
            item.$r('mouseover', this.mouseover.bind(this, item));
            item.$r('mouseout', this.mouseout.bind(this, item));
        } .bind(this));
    },
    setActive: function(index) {
        this.click(this.arrList[index])
    },
    mouseover: function(obj) {
        if (this.hasClass(obj, this.disablecls)) {
            return;
        }
        if (this.hasClass(obj, this.clickedcls)) {
            return;
        }
        this.addClass(obj, this.hovercls);
    },
    mouseout: function(obj) {
        this.removeClass(obj, this.hovercls);
    },
    click: function(obj) {
        if (!this.hasClass(obj, this.disablecls)) {
            try {
                var cls = 'h4.' + this.titlecls;
                var temp = obj.$g(cls)[0];
                if (this.next(temp)) {
                    this.next(temp).style.display = '';

                }
            } catch (e) { }
        } else {
            return;
        }
        this.arrList.each(function(item2, j) {

            if (this.hasClass(item2, this.clickcls)) {
                if (!this.hasClass(item2, this.clickedcls)) {
                    this.addClass(item2, this.clickedcls);

                }
            }
            if (item2 == obj) {
                if (!this.hasClass(item2, this.clickcls)) {
                    this.addClass(item2, this.clickcls);
                    //alert('加' + feesConfig[j]);
                    if (this.callback) {
                        this.callback(j,+this.feesConfig[j]);
                    }
                }
            } else {
                if (!this.hasClass(item2, this.defaultcls)) {
                    this.addClass(item2, this.defaultcls);
                }


                if (this.hasClass(item2, this.clickcls)) {

                    this.removeClass(item2, this.clickcls);
                    //alert('减' + feesConfig[j]);
                    if (this.callback) {
                        this.callback(j,-this.feesConfig[j]);
                    }
                }

            }
        } .bind(this));
    }
}

CtripUI.cityselector = function() {
	this.initialize(arguments[0]);
	CtripUI['Cmp'].push({
		id: arguments[0]['id'] || 'CtripUI' + parseInt(Math.random() * 10000),
		cmp: this
	});
}
CtripUI.cityselector.prototype = {
    setOption: function() {
        for (var opt in this.options) {
            this[opt] = this.options[opt];
        }
        for (var opt in arguments[0]) {
            this[opt] = arguments[0][opt];
        }
    },
    options: {
        target: null,
        clsname: "departures",
        listtag: 'a'
    },
    next: function(el) {
        var obj = el.nextSibling;
        while (obj && obj.nodeType != 1) {
            obj = obj.nextSibling;
        }
        return obj;
    },
    initialize: function() {
        this.setOption(arguments[0]);
        this.target = $(this.target);
        this.contentDiv = $(this.next(this.target));
        this.contentDiv.className = this.clsname;
        this.bind();
    },
    css: function(obj, str) {
        var camelCase = str.replace(/\-(\w)/g, function(all, letter) {
            return letter.toUpperCase();
        });

        var css = obj.currentStyle || document.defaultView.getComputedStyle(obj, null);
        var cccss = str ? css[camelCase] : css;
        if (typeof (cccss) == 'undefined') {
            return obj.style[camelCase];
        } else {
            return cccss;
        };
    },
    _getLeft: function(el) {
        var o = el, iLeft = o.offsetLeft
        while (o.offsetParent) { o = o.offsetParent; iLeft += o.offsetLeft }
        return iLeft;
    },
    _getTop: function(el) {
        var o = el, iTop = o.offsetLeft
        while (o.offsetParent) { o = o.offsetParent; iTop += o.offsetTop }
        return iTop;
    },
    _getMarginLeft: function(el) {

        var o = el, iTop = parseInt(this.css(o, "margin-left"))
        while (o.offsetParent) { o = o.offsetParent; iTop += parseInt(this.css(o, "margin-left")) }

        return iTop;
    },
    _getPaddingLeft: function(el) {

        var o = el, iTop = parseInt(this.css(o, "padding-left"))
        while (o.offsetParent) {

            o = o.parentNode;
            iTop += parseInt(this.css(o, "padding-left"));
        }

        return iTop;
    },
    bind: function() {
        this.target.$r('focus', function(e) {
            var evt = e || window.event;
            var el = e.srcElement || e.target;
            //	var This=this.target;


            //this.contentDiv.style.position = 'absolute';
            //this.contentDiv.style.margin = '0';
            //  this.contentDiv.style.left = this._getLeft(this.target) - this._getMarginLeft(this.target) - this._getPaddingLeft(this.target) + 'px';
            this.contentDiv.style.display = 'block';
        } .bind(this));
        this.contentDiv.$r('mousedown', function(e) {
            var evt = e || window.event;
            var el = evt.target || evt.srcElement;
            while (el.parentNode) {
                if (el.tagName == this.listtag.toUpperCase()) {
                  if(this.callback){
                    this.callback.call(this,el);
                  }else{ 
                    this.target.value = el.innerHTML;
                    this.contentDiv.style.display = 'none';
                   
                  }
                   break;
                }
                el = el.parentNode;
            }

        } .bind(this));
        $(document.documentElement).$r('mousedown', function(e) {
            var evt = e || window.event;
            var el = evt.target || evt.srcElement;
            if (el == this.contentDiv) {
                return
            } else {
                this.contentDiv.style.display = 'none';
            }
        } .bind(this));
    }
}

//slider
CtripUI.slider = function() {
	this.initialize(arguments[0]);
	CtripUI['Cmp'].push({
		id: arguments[0]['id'] || 'CtripUI' + parseInt(Math.random() * 10000),
		cmp: this
	});
} 
CtripUI.slider.prototype = {
	setOption: function() {
		for (var opt in this.options) {
			this[opt] = this.options[opt];
		}
		for (var opt in arguments[0]) {
			this[opt] = arguments[0][opt];
		}
	},
	options: {
		url: null,
		rangeArr: [],
		activerange: [0, 100],
		headwidth:15/2,
		spacing:20,
		infotxt: '个产品符合价格范围',
		classname: 'package_price_select',
		rangetipsclass: 'price_sider',
		contentcalss: 'price_content',
		sliderrangeclass: 'slider_range',
		scaleclass: 'scale',
		headclass: 'go_left',
		tipsclass: 'price_top',
		infoclass: 'slider_range_right',
		target: null,
		beginBarIndex:98,
		endBarIndex:99,
		realtarget:null,
		minValue:null,
		maxValue:null,
		slider_callback: function() { }
	},
	initialize: function() {
		this.setOption(arguments[0]);
		this.target = $(this.target);
		if(this.url){
			$ajax(this.url,null,function(data){
				this.rangeArr=eval('('+data+')');
				this.minValue = Math.min.apply(null, this.rangeArr);
				this.maxValue = Math.max.apply(null, this.rangeArr);
				this.run();
				this.slider_callback();
			}.bind(this));
		}else{
			//this.minValue = Math.min.apply(null, this.rangeArr);
			//this.maxValue = Math.max.apply(null, this.rangeArr);
			this.minValue = this.minvalue;
			this.maxValue = this.maxvalue;
			this.run();
			this.slider_callback();
		}
	},
	next: function(el) {
        var obj = el.nextSibling;
        while (obj && obj.nodeType != 1) {
            obj = obj.nextSibling;
        }
        return obj;
    },
	addEvent: function(obj, evtType, fn, useCapture) {
		var capture = useCapture || false;
		if (obj.attachEvent) {
			obj.attachEvent('on' + evtType, fn);
			if (capture && obj.nodeType != 9) obj.setCapture();
		} else obj.addEventListener(evtType, fn, capture);
	},
	removeEvent: function(obj, evtType, fn, useCapture) {
		var capture = useCapture || false;
		if (obj.detachEvent) {
			obj.detachEvent('on' + evtType, fn);
			if (capture && obj.nodeType != 9) obj.releaseCapture();
		} else obj.removeEventListener(evtType, fn, capture);
	},
	_css:function(obj) {
		var camelCase = arguments[1].replace(/\-(\w)/g, function(all, letter) {
			return letter.toUpperCase();
		});
		var css = obj.currentStyle || document.defaultView.getComputedStyle(obj, null);
		var cccss = arguments[1] ? css[camelCase] : css;
		if (typeof (cccss) == 'undefined') {
			return obj.style[camelCase];
		} else {
			return cccss;
		}
	},
	_calc: function(val) {
		var obj = $(this.target).getElementsByTagName('div')[0];
		var temp = obj.getElementsByTagName('div')[0].offsetWidth * val / (this.maxValue - this.minValue);
		return temp
	},
	_getWidth: function() {
		//debugger;
		return $(this.target).getElementsByTagName('a')[1].offsetLeft - $(this.target).getElementsByTagName('a')[0].offsetLeft;
	},
	_getLeft: function(el) {
		var o = el, iLeft = o.offsetLeft

		while (o.offsetParent) { o = o.offsetParent; iLeft += o.offsetLeft }

		return iLeft;

	},
	run: function() {
		//创建起始结束价格区块
		var beginPic = $c('span');
		beginPic.innerHTML = this.minValue;
		beginPic.className = this.rangetipsclass;
		var endPic = beginPic.cloneNode(true);
		endPic.innerHTML = this.maxValue;
		this.target.appendChild(beginPic);
		
		//创建进度条区块
		var price_content = $c('div');
		price_content.className = this.contentcalss;
		var scale = $c('div');
		scale.className = this.scaleclass;
		price_content.appendChild(scale);
		this.target.appendChild(price_content);
		var slider_range = $c('div');

		this.contentRange = price_content;

		this.sliderRange = slider_range;

		slider_range.className = this.sliderrangeclass;
		slider_range.style.left = this._calc(this.activerange[0] - this.minValue) + 'px';
		var t = setTimeout(function() {
			clearTimeout(t);
			slider_range.style.width = this._getWidth() + 'px';
		} .bind(this), 0);

		price_content.appendChild(slider_range);

		setTimeout(function() {
			this.step = (this.maxValue - this.minValue) / this.spacing;
		} .bind(this), 0);

		//创建锚点区块
		var bar1 = $c('a');
		
		bar1.className = this.headclass;
		//head.id = 'head1';
		//head.innerHTML = 1;
		bar1.style.left = this._calc(this.activerange[0] - this.minValue) - this.headwidth + 'px';
		bar1.style.zIndex=this.beginBarIndex;
		var bar2 = bar1.cloneNode(true);
		bar2.style.left = this._calc(this.activerange[1] - this.minValue) - this.headwidth + 'px';
		bar2.style.zIndex=this.endBarIndex;
		// head2.innerHTML = 2;
		this.beginBar = bar1;
		this.endBar = bar2;
		this.beginValue = this.activerange[0];
		this.endValue = this.activerange[1];
		price_content.appendChild(bar1);
		price_content.appendChild(bar2);

		//创建显示符合信息区块
		var info = $c('div');
		info.className = this.infoclass;
		var infonum = $c('span');

		var infotxt = document.createTextNode(this.infotxt);
		info.appendChild(infonum);
		this.picNum = infonum;
		info.appendChild(infotxt);
		setTimeout(function() {
			infonum.innerHTML = (function() {
				
			var temparr = [];
			for (var i = 0; i < this.rangeArr.length; i++) {
				//console.log(this.rangeArr[i]);
				if (this.beginValue <= this.rangeArr[i] && this.endValue >= this.rangeArr[i] ) {
					temparr.push(this.rangeArr[i]);
				}
			}
			var temparr2 = [];
			for(var j=0;j<temparr.length;j++){
				if(temparr[j]>=this.minValue && temparr[j]<=this.maxValue){
					temparr2.push(temparr[j]);
				}
			}
			var realnum=0;
			
			if($(this.realtarget) && $(this.realtarget).checked){
				realnum=$(this.realtarget).getAttribute('num')*1;
			}
			
				return realnum+temparr2.length;
			} .bind(this))();
		} .bind(this), 0);

		//创建tips信息区块
		var tipsbegintxt = $c('span');
		tipsbegintxt.className = this.tipsclass;
		var tipsendtxt = tipsbegintxt.cloneNode(true);
		this.beginTip = tipsbegintxt;
		this.endTip = tipsendtxt;
		price_content.appendChild(tipsbegintxt);
		price_content.appendChild(tipsendtxt);

		setTimeout(function() {
			tipsbegintxt.innerHTML = this.activerange[0];
			tipsbegintxt.style.left = this._calc(this.activerange[0] - this.minValue) - tipsbegintxt.offsetWidth + 'px';
			tipsendtxt.innerHTML = this.activerange[1];
			tipsendtxt.style.left = this._calc(this.activerange[1] - this.minValue) + 'px';
		} .bind(this), 0);

		this.target.appendChild(endPic);
		this.target.appendChild(info);
		this.target.className = this.classname;
		this.target.style.visibility="visible";
		this.bind();
	},
	bind: function() {
		//true ie8会锁屏
		this.addEvent(document.documentElement, 'mousemove', this.mousemove.bind(this));
		this.addEvent(this.target, 'mouseout', this.mouseout.bind(this));
		this.addEvent(this.target, 'mousedown', this.mousedown.bind(this));
		this.addEvent(document.documentElement, 'mouseup', this.mouseup.bind(this));
		this.addEvent($(this.realtarget).parentNode, 'mouseup', this.realmouseup.bind(this));
		this.addEvent($(this.realtarget), 'click', this.realtargetChange.bind(this));
	},
	realtargetChange:function(e){
		var tag=$fixE(e).$target;
		this.next(tag.parentNode).style.visibility="";
	},
	realmouseup:function(e){
			var temparr = [];
			for (var i = 0; i < this.rangeArr.length; i++) {
				if (this.beginValue <= this.rangeArr[i] && this.endValue >= this.rangeArr[i]) {
					temparr.push(this.rangeArr[i]);
				}
			}
			var realnum=0;
			if($(this.realtarget) && !$(this.realtarget).checked){
				realnum=$(this.realtarget).getAttribute('num')*1;
			}
			this.picNum.innerHTML = temparr.length+realnum;
	},
	mouseout: function(e) {
		
	},
	mouseup: function(e) {
		//document.title=this.beginTip.innerHTML+""+this.endTip.innerHTML;
		//this.callback(this.target);
		this.beginValue = parseInt(this.beginTip.innerHTML);
		this.endValue = parseInt(this.endTip.innerHTML);
		this.bindcalcpicrange();
		this.slider_callback();
		this.__ondrag = false;
	},
	mousedown: function(e) {
		$stopEvent(e,-1);
		var evt = e || window.event;
		var el = e.srcElement || e.target;
		if (el == this.beginBar || el == this.endBar) {
			this.actionBar = el;
			this.__ondrag = true;
		}
	},
	changeIndex:function(){
		if(this.actionBar==this.beginBar){
			this.endBar.style.zIndex=this.beginBarIndex;
			this.actionBar.style.zIndex=this.endBarIndex;
		}else{
			this.beginBar.style.zIndex=this.beginBarIndex;
			this.actionBar.style.zIndex=this.endBarIndex;
		}
	},
	mousemove: function(e) {
		if (this.__ondrag) {
			this.callback(this.target);
			window.getSelection ? window.getSelection().removeAllRanges() : document.selection.empty();
			var evt = e || window.event;
			var el = e.srcElement || e.target;
			var x = (evt.pageX || evt.clientX);
			var iLeft = this._getLeft(this.contentRange);

			var pic = Math.round(parseInt(((x - iLeft + this.headwidth) * (this.maxValue - this.minValue)) / this.contentRange.offsetWidth));
			var xxx =  parseInt(Math.round(pic / this.step) * this.step);
			var resultValue = this._calc(xxx);
			this.changeIndex();
			if (this.actionBar == this.beginBar) {
				if (x+10 >= iLeft) {
					this.actionBar.style.left = resultValue - this.headwidth + 'px';
					this.sliderRange.style.left = resultValue + 'px';
					try{
						this.sliderRange.style.width = this.endBar.offsetLeft - this.beginBar.offsetLeft + 'px';
					}catch(err){
					}
					this.beginTip.style.left = x - iLeft - this.beginTip.offsetWidth + 'px';
					this.beginTip.innerHTML = xxx + this.minValue;
				}
				if (x == this.endBar.offsetLeft + iLeft) {
					//this.__ondrag = false;
				}
				if(x>this.endBar.offsetLeft + iLeft){
					this.actionBar.style.left = this.endBar.offsetLeft  + 'px';
					this.sliderRange.style.left = this.endBar.offsetLeft + 'px';
					try{
						this.sliderRange.style.width = this.endBar.offsetLeft - this.beginBar.offsetLeft + 'px';
					}catch(err){
					
					}
					this.beginTip.style.left = this.endBar.offsetLeft - this.beginTip.offsetWidth + 'px';
					this.beginTip.innerHTML = this.endValue;
				}
			}
			if (this.actionBar == this.endBar) {
				if (x <= iLeft + this.contentRange.offsetWidth) {
					this.actionBar.style.left = resultValue - this.headwidth + 'px';
					this.sliderRange.style.left = this.beginBar.offsetLeft+this.headwidth + 'px';
					try{
						this.sliderRange.style.width = this.endBar.offsetLeft - this.beginBar.offsetLeft + 'px';
					}catch(err){
					
					}
					this.endTip.style.left = resultValue + 'px';
					this.endTip.innerHTML = xxx + this.minValue;
				}
				if (x == this.beginBar.offsetLeft + iLeft) {
					// this.__ondrag = false;
				}
			//	console.log(x,this.beginBar.offsetLeft + iLeft);
				if(x<this.beginBar.offsetLeft + iLeft+this.headwidth){
					this.actionBar.style.left = this.beginBar.offsetLeft   + 'px';
					this.sliderRange.style.left = this.beginBar.offsetLeft + 'px';
					 this.sliderRange.style.width = this.endBar.offsetLeft - this.beginBar.offsetLeft + 'px';
					 this.endTip.style.left = this.beginBar.offsetLeft +this.headwidth + 'px';
					this.endTip.innerHTML = this.beginValue;

				}
			}
		}
	},
	bindcalcpicrange: function() {
		if (this.__ondrag) {
			var temparr = [];
			for (var i = 0; i < this.rangeArr.length; i++) {
				if (this.beginValue <= this.rangeArr[i] && this.endValue >= this.rangeArr[i] ) {
					temparr.push(this.rangeArr[i]);
				}
			}
			var temparr2 = [];
			for(var j=0;j<temparr.length;j++){
				if(temparr[j]>=this.minValue && temparr[j]<=this.maxValue){
					temparr2.push(temparr[j]);
				}
			}
			var realnum=0;			
			if($(this.realtarget) && $(this.realtarget).checked){
				realnum=$(this.realtarget).getAttribute('num')*1;
			}
			this.picNum.innerHTML = temparr2.length+realnum;
		}
	}
}
		
//数字文本框
CtripUI.numinput = function() {
    this.initialize(arguments[0]);
    CtripUI['Cmp'].push({
        id: arguments[0]['id'] || 'CtripUI' + parseInt(Math.random() * 10000),
        cmp: this
    });
}
CtripUI.numinput.prototype = {
    setOption: function() {
        for (var opt in this.options) {
            this[opt] = this.options[opt];
        }
        for (var opt in arguments[0]) {
            this[opt] = arguments[0][opt];
        }
    },
    options: {
        target: null,
        maxvalue: 0,
        regexp: /^(-|\+)?(\d)*$/,
        typeerrortext: '输入错误',
        overflowerrortext: '超过使用张数',
        tipinfo: '<div class="delivery_yellowtips"><div class="delivery_yellowtips_content"></div></div>'
    },
    next: function(el) {
        var obj = el.nextSibling;
        while (obj && obj.nodeType != 1) {
            obj = obj.nextSibling;
        }
        return obj;
    },
    hasClass: function(obj, strName) {
        var reg = new RegExp('(\\s|^)' + strName + '(\\s|$)');
        return obj.className.match(reg);
    },
    addClass: function(obj, strName) {
        obj.className = obj.className + " " + strName;
    },
    createTip: function(errortext) {
        var d = $c('div');
        d.className = 'delivery_yellowtips';
        var d2 = $c('div');
        d2.className = 'delivery_yellowtips_content';
        d2.innerHTML = errortext;
        d.appendChild(d2);
        return d;
    },
    removeClass: function(obj, strName) {
        if (this.hasClass(obj, strName)) {
            var reg = new RegExp('(\\s|^)' + strName + '(\\s|$)');
            obj.className = obj.className.replace(reg, ' ');
        }
    },
    initialize: function() {
        this.setOption(arguments[0]);
        this.target = $(this.target);
        this.bind();
    },
    bind: function() {
		var that=this;
        this.target.$r('keyup', function(e) {
			
            this.calc();
        } .bind(this));
        this.target.$r('focus', function(e) {
            this.clock = setInterval(function() {
                this.calc();
            } .bind(this), 200);
        } .bind(this));
        this.target.$r('blur', function(e) {
            clearInterval(this.clock);
            this.calc();
        } .bind(this));
    },
    calc: function() {
        if (!this.regexp.test(this.target.value)) {
            if (this.target.parentNode.getElementsByTagName('div').length > 1) {

            } else {
                this.target.parentNode.appendChild(this.createTip(this.typeerrortext));
            }
            return;
        }
        if (this.target.value > parseInt(this.next(this.target.parentNode).innerHTML)) {
            if (this.target.parentNode.getElementsByTagName('div').length > 1) {

            } else {
                this.target.parentNode.appendChild(this.createTip(this.overflowerrortext));
            }
            return;
        }
        this.change_callback();
        try {
            this.target.parentNode.removeChild(this.next(this.target));
        } catch (e) { 
            
        }
    }
}		
		
//注册mod		
Ctrip.module.slider = function(obj){
	var parms=(eval('('+obj.getAttribute("mod_params")+')')||{})[['slider']||{}];
	parms.target=obj;
	obj.module.slider =  new CtripUI.slider(parms);
}
Ctrip.module.cityselector = function(obj) {
    var parms = (eval('(' + obj.getAttribute("mod_params") + ')') || {})['cityselector'] || {};
    parms.target = obj;
    obj.module.vacations = new CtripUI.cityselector(parms);
}

//显示 隐藏信息
function showItem(el , type){
	var i = el.$parentNode("TR").rowIndex;
	if(type==0)
		el.$parentNode("TABLE").rows[i+1].style.display=el.$parentNode("TABLE").rows[i+1].style.display==""?"none":"";
	else
		el.$parentNode("TR").style.display = el.$parentNode("TR").style.display==""?"none":"";
}