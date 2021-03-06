<?php

//重写css Url
function site_url_css($url)
{
	return site_url_fix($url,'css');
}

function site_url_js($url)
{
	return site_url_fix($url,'js');
}

function site_url_htm($url)
{
	return site_url_fix($url,'htm');
}


/**
 * 重写url后缀
 * 
 * @access: public
 * @author: mk.zgc
 * @param: string,$url，要替换的网址
 * @param: string,$fix，要替换成的后缀
 * @return: string 
 */
function site_url_fix($url,$fix)
{
	$CI = &get_instance();
	$urlfix = $CI->config->item('url_suffix');
	if(str_replace('http://','',$url)==$url){
		$url = site_url($url);
	}
	$url = str_replace($urlfix,'.'.$fix,$url);
	return $url;
}


/*重组JS、CSS,的数组文件*/
function site_arrfile($arrfile)
{
	$items = 'cm';
	if(!empty($arrfile))
	{
		foreach($arrfile as $item){$items = $items.','.$item;}
	}
	return $items;
}

/*重组JS、CSS,的数组文件*/
function site_system($url='',$type=0)
{
	$CI = &get_instance();
	$thisUrl = $CI->config->item("admin_url") . $url;
	if($type==0){
	   return site_url( $thisUrl );
	}else{
	   return $thisUrl;
	}
}



/*
 * 返回各上传文件的目录路径(便于调用)
 */
function img_face($img='')
{
	$CI = &get_instance();
	return $CI->config->item('face_url').$img;
}

function img_uploads($img='')
{
	$CI = &get_instance();
	return $CI->config->item('uploads_url').$img;
}



?>