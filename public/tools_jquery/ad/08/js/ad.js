function winload()
{
layer1.style.top=20;
layer1.style.left=5;
layer2.style.top=20;
layer2.style.right=5;
}

if(document.body.offsetWidth>800){	
	{
	document.write("<div id=layer1 style='position: absolute;visibility:visible;z-index:1'><EMBED src='apple.swf' quality=high  WIDTH=100 HEIGHT=300 TYPE='application/x-shockwave-flash' id=ad wmode=opaque></EMBED></div>"
	+"<div id=layer2 style='position: absolute;visibility:visible;z-index:1'><EMBED src='apple.swf' quality=high  WIDTH=100 HEIGHT=300 TYPE='application/x-shockwave-flash' id=ad wmode=opaque></EMBED></div>");
	}
  winload()
}