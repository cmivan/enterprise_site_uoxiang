// by  : cm.ivan
// blog: http://blog.163.com/cm.vian
// time: 2010-01-01

//add by cm.ivan
var cm_time = new Array();
function showNav(id){
document.getElementById("cm_Nav_"+id).style.display="block";
document.getElementById("pro_nav_"+id).className="on";
clearInterval(cm_time[id]);
}

function closeNav(id){
cm_time[id]=setTimeout("endNav("+id+")",100);
}
function endNav(id){
document.getElementById("cm_Nav_"+id).style.display="none";
document.getElementById("pro_nav_"+id).className="";
clearInterval(cm_time[id]);
}
