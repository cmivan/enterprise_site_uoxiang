document.writeln("");
document.writeln("<style type=\'text\/css\'>");
document.writeln("<!--");
document.writeln("a:visited{text-decoration:none;color:slategray;}");
document.writeln("a:hover{text-decoration:underline;color:slategray;}");
document.writeln("a:link{text-decoration:none;color:slategray;}");
document.writeln("-->");
document.writeln("<\/style>");
document.writeln("<script language=JScript>");
document.writeln("<!--");
document.writeln("\/\/���Դ��Ϊjs�ļ�;");
document.writeln("var x0=0,y0=0,x1=0,y1=0;");
document.writeln("var offx=6,offy=6;");
document.writeln("var moveable=false;");
document.writeln("var hover=\'orange\',normal=\'slategray\';\/\/color;");
document.writeln("var index=10000;\/\/z-index;");
document.writeln("\/\/��ʼ�϶�;");
document.writeln("function startDrag(obj)");
document.writeln("{");
document.writeln(" if(event.button==1)");
document.writeln(" {");
document.writeln("  \/\/����������;");
document.writeln("  obj.setCapture();");
document.writeln("  \/\/�������;");
document.writeln("  var win = obj.parentNode;");
document.writeln("  var sha = win.nextSibling;");
document.writeln("  \/\/��¼���Ͳ�λ��;");
document.writeln("  x0 = event.clientX;");
document.writeln("  y0 = event.clientY;");
document.writeln("  x1 = parseInt(win.style.left);");
document.writeln("  y1 = parseInt(win.style.top);");
document.writeln("  \/\/��¼��ɫ;");
document.writeln("  normal = obj.style.backgroundColor;");
document.writeln("  \/\/�ı���;");
document.writeln("  obj.style.backgroundColor = hover;");
document.writeln("  win.style.borderColor = hover;");
document.writeln("  obj.nextSibling.style.color = hover;");
document.writeln("  sha.style.left = x1 + offx;");
document.writeln("  sha.style.top  = y1 + offy;");
document.writeln("  moveable = true;");
document.writeln(" }");
document.writeln("}");
document.writeln("\/\/�϶�;");
document.writeln("function drag(obj)");
document.writeln("{");
document.writeln(" if(moveable)");
document.writeln(" {");
document.writeln("  var win = obj.parentNode;");
document.writeln("  var sha = win.nextSibling;");
document.writeln("  win.style.left = x1 + event.clientX - x0;");
document.writeln("  win.style.top  = y1 + event.clientY - y0;");
document.writeln("  sha.style.left = parseInt(win.style.left) + offx;");
document.writeln("  sha.style.top  = parseInt(win.style.top) + offy;");
document.writeln(" }");
document.writeln("}");
document.writeln("\/\/ֹͣ�϶�;");
document.writeln("function stopDrag(obj)");
document.writeln("{");
document.writeln(" if(moveable)");
document.writeln(" {");
document.writeln("  var win = obj.parentNode;");
document.writeln("  var sha = win.nextSibling;");
document.writeln("  var msg = obj.nextSibling;");
document.writeln("  win.style.borderColor     = normal;");
document.writeln("  obj.style.backgroundColor = normal;");
document.writeln("  msg.style.color           = normal;");
document.writeln("  sha.style.left = obj.parentNode.style.left;");
document.writeln("  sha.style.top  = obj.parentNode.style.top;");
document.writeln("  obj.releaseCapture();");
document.writeln("  moveable = false;");
document.writeln(" }");
document.writeln("}");
document.writeln("\/\/��ý���;");
document.writeln("function getFocus(obj)");
document.writeln("{");
document.writeln(" if(obj.style.zIndex!=index)");
document.writeln(" {");
document.writeln("  index = index + 2;");
document.writeln("  var idx = index;");
document.writeln("  obj.style.zIndex=idx;");
document.writeln("  obj.nextSibling.style.zIndex=idx-1;");
document.writeln(" }");
document.writeln("}");
document.writeln("\/\/��С��;");
document.writeln("function min(obj)");
document.writeln("{");
document.writeln(" var win = obj.parentNode.parentNode;");
document.writeln(" var sha = win.nextSibling;");
document.writeln(" var tit = obj.parentNode;");
document.writeln(" var msg = tit.nextSibling;");
document.writeln(" var flg = msg.style.display==\"none\";");
document.writeln(" if(flg)");
document.writeln(" {");
document.writeln("  win.style.height  = parseInt(msg.style.height) + parseInt(tit.style.height) + 2*2;");
document.writeln("  sha.style.height  = win.style.height;");
document.writeln("  msg.style.display = \"block\";");
document.writeln("  obj.innerHTML = \"0\";");
document.writeln(" }");
document.writeln(" else");
document.writeln(" {");
document.writeln("  win.style.height  = parseInt(tit.style.height) + 2*2;");
document.writeln("  sha.style.height  = win.style.height;");
document.writeln("  obj.innerHTML = \"2\";");
document.writeln("  msg.style.display = \"none\";");
document.writeln(" }");
document.writeln("}");
document.writeln("\/\/�ر�;");
document.writeln("function cls(obj)");
document.writeln("{");
document.writeln(" var win = obj.parentNode.parentNode;");
document.writeln(" var sha = win.nextSibling;");
document.writeln(" win.style.visibility = \"hidden\";");
document.writeln(" sha.style.visibility = \"hidden\";");
document.writeln("}");
document.writeln("\/\/����һ������;");
document.writeln("function xWin(id,w,h,l,t,tit,msg)");
document.writeln("{");
document.writeln(" index = index+2;");
document.writeln(" this.id      = id;");
document.writeln(" this.width   = w;");
document.writeln(" this.height  = h;");
document.writeln(" this.left    = l;");
document.writeln(" this.top     = t;");
document.writeln(" this.zIndex  = index;");
document.writeln(" this.title   = tit;");
document.writeln(" this.message = msg;");
document.writeln(" this.obj     = null;");
document.writeln(" this.bulid   = bulid;");
document.writeln(" this.bulid();");
document.writeln("}");
document.writeln("\/\/��ʼ��;");
document.writeln("function bulid()");
document.writeln("{");
document.writeln(" var str = \"\"");
document.writeln("  + \"<div id=xMsg\" + this.id + \" \"");
document.writeln("  + \"style=\'\"");
document.writeln("  + \"z-index:\" + this.zIndex + \";\"");
document.writeln("  + \"width:\" + this.width + \";\"");
document.writeln("  + \"height:\" + this.height + \";\"");
document.writeln("  + \"left:\" + this.left + \";\"");
document.writeln("  + \"top:\" + this.top + \";\"");
document.writeln("  + \"background-color:\" + normal + \";\"");
document.writeln("  + \"color:\" + normal + \";\"");
document.writeln("  + \"font-size:10px;\"");
document.writeln("  + \"font-family:Verdana;\"");
document.writeln("  + \"position:absolute;\"");
document.writeln("  + \"cursor:default;\"");
document.writeln("  + \"border:2px solid \" + normal + \";\"");
document.writeln("  + \"\' \"");
document.writeln("  + \"onmousedown=\'getFocus(this)\'>\"");
document.writeln("   + \"<div \"");
document.writeln("   + \"style=\'\"");
document.writeln("   + \"background-color:\" + normal + \";\"");
document.writeln("   + \"width:\" + (this.width-2*2) + \";\"");
document.writeln("   + \"height:20;\"");
document.writeln("   + \"color:white;\"");
document.writeln("   + \"\' \"");
document.writeln("   + \"onmousedown=\'startDrag(this)\' \"");
document.writeln("   + \"onmouseup=\'stopDrag(this)\' \"");
document.writeln("   + \"onmousemove=\'drag(this)\' \"");
document.writeln("   + \"ondblclick=\'min(this.childNodes[1])\'\"");
document.writeln("   + \">\"");
document.writeln("    + \"<span style=\'width:\" + (this.width-2*12-4) + \";padding-left:3px;\'>\" + this.title + \"<\/span>\"");
document.writeln("    + \"<span style=\'width:12;border-width:0px;color:white;font-family:webdings;\' onclick=\'min(this)\'>0<\/span>\"");
document.writeln("    + \"<span style=\'width:12;border-width:0px;color:white;font-family:webdings;\' onclick=\'cls(this)\'>r<\/span>\"");
document.writeln("   + \"<\/div>\"");
document.writeln("    + \"<div style=\'\"");
document.writeln("    + \"width:100%;\"");
document.writeln("    + \"height:\" + (this.height-20-4) + \";\"");
document.writeln("    + \"background-color:white;\"");
document.writeln("    + \"line-height:14px;\"");
document.writeln("    + \"word-break:break-all;\"");
document.writeln("    + \"padding:3px;\"");
document.writeln("    + \"\'>\" + this.message + \"<\/div>\"");
document.writeln("  + \"<\/div>\"");
document.writeln("  + \"<div style=\'\"");
document.writeln("  + \"width:\" + this.width + \";\"");
document.writeln("  + \"height:\" + this.height + \";\"");
document.writeln("  + \"top:\" + this.top + \";\"");
document.writeln("  + \"left:\" + this.left + \";\"");
document.writeln("  + \"z-index:\" + (this.zIndex-1) + \";\"");
document.writeln("  + \"position:absolute;\"");
document.writeln("  + \"background-color:black;\"");
document.writeln("  + \"filter:alpha(opacity=40);\"");
document.writeln("  + \"\'>by wildwind<\/div>\";");
document.writeln(" document.body.insertAdjacentHTML(\"beforeEnd\",str);");
document.writeln("}");
document.writeln("\/\/-->");
document.writeln("<\/script>");
document.writeln("");
document.writeln("<script language=\'JScript\'>");
document.writeln("<!--");
document.writeln("function initialize()");
document.writeln("{");
document.writeln(" var a = new xWin(\"1\",800,200,0,0,\"��ӭ���ղر����ҳ�棡\",\"��ӭ����<br><a href=http:\/\/www.1th.cn\/wildcity target=_blank>http:\/\/www.1th.cn<\/a><br>AD����\");");
document.writeln("}");
document.writeln("window.onload = initialize;");
document.writeln("\/\/-->");
document.writeln("<\/script>");
document.writeln("");
document.writeln("")