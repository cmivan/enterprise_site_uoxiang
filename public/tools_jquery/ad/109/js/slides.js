var noobSlide=new Class({initialize:function(a){this.items=a.items;this.mode=a.mode||'horizontal';this.modes={horizontal:['left','width'],vertical:['top','height']};this.size=a.size||240;this.box=a.box.setStyle(this.modes[this.mode][1],(this.size*this.items.length)+'px');this.button_event=a.button_event||'click';this.handle_event=a.handle_event||'click';this.interval=a.interval||5000;this.buttons={previous:[],next:[],play:[],playback:[],stop:[]};if(a.buttons){for(var b in a.buttons){this.addActionButtons(b,$type(a.buttons[b])=='array'?a.buttons[b]:[a.buttons[b]])}}this.handles=a.handles||null;if(this.handles){this.addHandleButtons(this.handles)}this.fx=new Fx.Style(this.box,this.modes[this.mode][0],a.fxOptions||{duration:500,wait:false});this.onWalk=a.onWalk||null;this.currentIndex=a.startItem||0;this.previousIndex=null;this.nextIndex=null;this.autoPlay=a.autoPlay||false;this._auto=null;this.box.setStyle(this.modes[this.mode][0],(-this.currentIndex*this.size)+'px');if(a.autoPlay)this.play(this.interval,'next',true)},previous:function(a){this.currentIndex+=this.currentIndex>0?-1:this.items.length-1;this.walk(null,a)},next:function(a){this.currentIndex+=this.currentIndex<this.items.length-1?1:1-this.items.length;this.walk(null,a)},play:function(a,b,c){this.stop();if(!c){this[b](false)}this._auto=this[b].periodical(a,this,false)},stop:function(){$clear(this._auto)},walk:function(a,b){if($defined(a)){if(a==this.currentIndex)return;this.currentIndex=a}this.previousIndex=this.currentIndex+(this.currentIndex>0?-1:this.items.length-1);this.nextIndex=this.currentIndex+(this.currentIndex<this.items.length-1?1:1-this.items.length);if(b){this.stop()}this.fx.start(-this.currentIndex*this.size);if(this.onWalk){this.onWalk(this.items[this.currentIndex],(this.handles?this.handles[this.currentIndex]:null))}if(b&&this.autoPlay){this.play(this.interval,'next',true)}},addHandleButtons:function(a){for(var i=0;i<a.length;i++){a[i].addEvent(this.handle_event,this.walk.bind(this,[i,true]))}},addActionButtons:function(a,b){for(var i=0;i<b.length;i++){switch(a){case'previous':b[i].addEvent(this.button_event,this.previous.bind(this,true));break;case'next':b[i].addEvent(this.button_event,this.next.bind(this,true));break;case'play':b[i].addEvent(this.button_event,this.play.bind(this,[this.interval,'next',false]));break;case'playback':b[i].addEvent(this.button_event,this.play.bind(this,[this.interval,'previous',false]));break;case'stop':b[i].addEvent(this.button_event,this.stop.bind(this));break}this.buttons[a].push(b[i])}}});

	window.addEvent('domready',function(){
		var info6 = $('box6').getNext().setOpacity(0.65);
		var hs6 = new noobSlide({
			mode: 'vertical',
			box: $('box6'),
			items: slideItems,
			size: 180,
			handles: $ES('div','handles6_1'),
			handle_event: 'mouseenter',
            autoPlay: true,
			fxOptions: {
				duration: 1000,
				transition: Fx.Transitions.Back.easeOut,
				wait: false
			},
			onWalk: function(currentItem,currentHandle){
				info6.empty();
				new Element('h4').setHTML(currentItem.title).inject(info6);
				this.handles.setOpacity(0.3);
				currentHandle.setOpacity(1);
			}
		});
});
