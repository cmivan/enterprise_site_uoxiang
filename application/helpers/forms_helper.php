<?php
/**
 * 创建表单样式
 *
 * @access: public
 * @author: mk.zgc
 * @param : string，$str，提示消息
 * @return: string
 * @eq    : json_form_no("要提示消息"); 
 */
function cm_form_select($formID,$itemarr,$valuekey,$titlekey,$selectedkey,$style='')
{
	if(empty($formID)||$formID==''){return '未设置select框的ID!';}
	if(empty($valuekey)||$valuekey==''){return '请给select框的value绑定值!';}
	if(empty($titlekey)||$titlekey==''){return '请给select框的title绑定值!';}
	$selectbox = '';
	$selectbox.= '<select id="'.$formID.'" name="'.$formID.'" '.$style.' >';
	foreach($itemarr as $item){
		if($item->$valuekey==$selectedkey){
			$selectbox.= '<option value="'.$item->$valuekey.'" selected style="background-color:#F60; color:#FFF">'.$item->$titlekey.'</option>';
		}else{
			$selectbox.= '<option value="'.$item->$valuekey.'">'.$item->$titlekey.'</option>';
		}	
	}
	$selectbox.= '</select>';
	return $selectbox;
}



//应用于编辑页面
function cm_form_checkbox($Title='选择',$ID='checkid',$Val='0')
{
	if( $Val == 1 )
	{
		return '<label><input type="checkbox" name="'.$ID.'" id="'.$ID.'" value="1" checked>'.$Title.'</label>';
	}
	else
	{
		return '<label><input type="checkbox" name="'.$ID.'" id="'.$ID.'" value="1">'.$Title.'</label>';
	}
}

//应用于管理页面
function cm_form_check($key='ok',$id=0,$Val='0',$T0='×',$T1='√')
{
	if( (int)$Val == 1 )
	{
		return '<a href="'.reUrl('cmd='.$key.'&val=0&id='.$id).'" class="green"><b>'.$T1.'</b></a>';
	}
	else
	{
		return '<a href="'.reUrl('cmd='.$key.'&val=1&id='.$id).'" class="red"><b>'.$T0.'</b></a>';
	}
}





function cm_form_type_select($data='',$typeB_id=0,$typeS_id=0,$formID='type_id',$style='')
{
	$selectbox = '<select id="'.$formID.'" name="'.$formID.'" '.$style.' >';
	if(!empty($data))
	{
		foreach($data as $rsB)
		{
			if( $typeB_id == $rsB['type_id'] )
			{
				$selectbox.= '<option value="'.$rsB['type_id'].'" style="background-color:#F63;color:#fff" selected>'.$rsB['type_title'].'</option>';
			}
			else
			{
				$selectbox.= '<option value="'.$rsB['type_id'].'">'.$rsB['type_title'].'</option>';
			}
			
			if( !empty($rsB['type_ids']) )
			{
				$type_ids = $rsB['type_ids'];
				foreach($type_ids as $rsS)
				{
					if( $typeS_id == $rsS['type_id'] )
					{
						$selectbox.= '<option value="'.$rsS['type_id'].'" style="background-color:#C2740A;color:#fff" selected> ├ '.$rsS['type_title'].'</option>';
					}
					else
					{
						$selectbox.= '<option style="color:#666" value="'.$rsS['type_id'].'"> ├ '.$rsS['type_title'].'</option>';
					}
				}
			}
		}
	}
	$selectbox.= '</select>';
	return $selectbox;
}


function cm_form_type_edit_select($data='',$typeB_id=0,$typeS_id=0,$formID='type_ids',$style='')
{
	$selectbox = '<select id="'.$formID.'" name="'.$formID.'" '.$style.' >';
	if(!empty($data))
	{
		$selectbox.= '<option value="0">一级分类</option>';
		foreach($data as $rsB)
		{
			if( $typeB_id == $rsB['type_id'] )
			{
				$selectbox.= '<option value="'.$rsB['type_id'].'" selected>'.$rsB['type_title'].'</option>';
			}
			else
			{
				$selectbox.= '<option value="'.$rsB['type_id'].'">'.$rsB['type_title'].'</option>';
			}
		}
	}
	$selectbox.= '</select>';
	return $selectbox;
}





function auto_save_image($body){
    $img_array = array();
	
	//微信图片专用
	$body = @ereg_replace('/0"','/0.jpg"', $body);
	
	preg_match_all("/(src)=[\"|\'| ]{0,}(http:\/\/(.*)\.(gif|jpg|jpeg|bmp|png|peg))[\"|\'| ]{0,}/isU", $body, $img_array);
	//print_r($img_array);
	//exit;
	
    $img_array = array_unique($img_array[2]);
    set_time_limit(0);
    $imgPath = "/public/up/uploads/".date("Ym")."/";
	$imgPathS = ".".$imgPath;
    $milliSecond = strftime("%H%M%S",time());
    if(!is_dir($imgPathS)){ @mkdir($imgPathS,0777); }
    foreach($img_array as $key =>$value)
    {
		$value = trim($value);
		$get_file = @file_get_contents($value);
		//$rndFileName = $imgPath."/".$milliSecond.$key.".".substr($value,-3,3);
		$rndFileName = $imgPath."/".$milliSecond.$key.".gif";
		if($get_file)
		{
			$fp = @fopen('.'.$rndFileName,"w");
			@fwrite($fp,$get_file);
			@fclose($fp);
		}
		$body = @ereg_replace($value, $rndFileName, $body);
    }
	//json_form_no('录入成功！');
    return $body;
}
 

?>