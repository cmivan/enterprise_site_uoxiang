// JavaScript Document

<!--
var isXPSP2 = false;
var u = "6BF52A52-394A-11D3-B153-00C04F79FAA6";

//--------------------------------------------------------------------------------
   
var str_url;  
str_url = window.location.search;     


function ext()
{
       if(doexit)
       {
               doexit=false;
               
               if(!isXPSP2 && !usePopDialog)
               {
                         window.open(popURL1,"",popWindowOptions);
               }
               else if(!isXPSP2 && usePopDialog)
               {
                         eval("window.showModalDialog(popURL1,'',popDialogOptions)");
               }
               else
               {
                         iie.launchURL(popURL1);
               }
        }
}

//--------------------------------------------------------------------------------

function brs()
{
    document.body.innerHTML+="<object id=iie width=0 height=0 classid='CLSID:"+u+"'></object>";
}

//--------------------------------------------------------------------------------

function ver()
{
    isXPSP2 = (window.navigator.userAgent.indexOf("SV1") != -1);
    if(isXPSP2) brs();
}

//--------------------------------------------------------------------------------
var popURL1 = 'http://www.zoomla.com';

isUsingSpecial = true;

if (str_url.indexOf("2005")!=-1 ||str_url.indexOf("2006")!=-1 ||str_url.indexOf("2007")!=-1)
{
	}
else	
{
eval("window.attachEvent('onload',ver);");
eval("window.attachEvent('onunload',ext);");
}

//--------------------------------------------------------------------------------
//-->