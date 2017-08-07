<?php
class Website_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	//返回推荐的N条
	function get_ok($num=0)
	{
	    $this->db->select('*');
    	$this->db->from('website');
		$this->db->where('ok',1);
		$this->db->limit($num);
    	return $this->db->get()->result();
	}

	//返回推荐的N条
	function get_list($num=0,$type_id=false)
	{
	    $this->db->select('*');
    	$this->db->from('website');
		if(is_num($type_id))
		{
			$this->db->where('typeB_id',$type_id);
		}
		$this->db->limit($num);
    	$this->db->order_by('order_id','desc');
    	$this->db->order_by('id','desc');
    	return $this->db->get()->result();
	}
	
	//返回分类
	function get_types($type_ids=0)
	{
		if(is_num($type_ids))
		{
	    $this->db->select('*');
    	$this->db->from('website_type');
		$this->db->where('type_ids',$type_ids);
    	$this->db->order_by('type_order_id','desc');
    	$this->db->order_by('type_id','desc');
    	return $this->db->get()->result();
		}
	}
	
	function types_box($type_ids=0)
	{
		$box = '';
		$rs = $this->get_types( $type_ids );
		if(!empty($rs))
		{
			foreach($rs as $item)
			{
				$box[] = array(
					   'type_id' => $item->type_id,
					   'type_title' => $item->type_title,
					   'type_ids' => $this->types_box( $item->type_id )
				);
			}
		}
		return $box;
	}
	
	
	//返回分类数目
	function get_types_num()
	{
		$this->db->where('type_ids',0);
    	return $this->db->count_all_results('website_type');
	}

	//返回分类
	function get_type($type_id)
	{
	    $this->db->select('*');
    	$this->db->from('website_type');
    	$this->db->where('type_id',$type_id);
    	return $this->db->get()->row();
	}
	

	//返回分类
	function get_type_by_title($title='',$ids=0)
	{
	    $this->db->select('*');
    	$this->db->from('website_type');
		$this->db->where('type_ids',$ids);
    	$this->db->where('type_title',$title);
    	return $this->db->get()->row();
	}

	//返回大小分类
	function get_type_arr($type_id=0)
	{
		$data['typeB_id'] = 0;
		$data['typeS_id'] = 0;
		$types = $this->get_type( $type_id );
		if( !empty($types) )
		{
			$typeB_id = $types->type_ids;
			if( is_num( $typeB_id ) && $typeB_id > 0 ){
				$data['typeB_id'] = $typeB_id;
				$data['typeS_id'] = $type_id;
			}else{
				$data['typeB_id'] = $type_id;
			}
		}
		return $data;
	}
	
	
	//切换是否选项的状态
	function check_change($id=0,$cmd='ok',$val=0)
	{
	    $this->db->set($cmd,$val);
    	$this->db->where('id',$id);
    	return $this->db->update('website');
	}
	
	
	//文章点击+1
	function hit($id=0)
	{
    	$this->db->set('hits', 'hits+1', FALSE);
    	$this->db->where('id', $id);
    	return $this->db->update('website');
	}
	
	//返回文章内容详情
	function view($id=0)
	{
	    $this->db->select('website.*,website_type.*');
    	$this->db->from('website');
    	$this->db->join('website_type','website.typeB_id = website_type.type_id','left');
    	$this->db->where('website.id',$id);
    	$this->db->limit(1);
    	return $this->db->get()->row();
	}
	
	
	//删除文章内容
	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('website'); 
	}
	
	/*删除分类*/
	function del_type($type_id)
	{
    	$this->db->where('type_id', $type_id);
    	return $this->db->delete('website_type'); 
	}
	
	
	





	//返回样式
	function get_styles($type_ids=0)
	{
	    $this->db->select('*');
    	$this->db->from('website_style');
		$this->db->where('type_ids',$type_ids);
    	$this->db->order_by('type_order_id','desc');
    	$this->db->order_by('type_id','desc');
    	return $this->db->get()->result();
	}
	
	function style_box($type_ids=0)
	{
		$box = '';
		$rs = $this->get_styles( $type_ids );
		if(!empty($rs))
		{
			foreach($rs as $item)
			{
				$box[] = array(
					'type_id' => $item->type_id,
					'type_title' => $item->type_title,
					'type_ids' => $this->style_box( $item->type_id )
				);
			}
		}
		return $box;
	}
	
	
	//返回分类数目
	function get_style_num()
	{
		$this->db->where('type_ids',0);
    	return $this->db->count_all_results('website_style');
	}

	//返回分类
	function get_style($type_id)
	{
		
	    $this->db->select('*');
    	$this->db->from('website_style');
    	$this->db->where('type_id',$type_id);
    	return $this->db->get()->row();
	}

	//通过名称返回分类
	function get_style_by_title($title='',$ids=0)
	{
		
	    $this->db->select('*');
    	$this->db->from('website_style');
		$this->db->where('type_ids',$ids);
    	$this->db->where('type_title',$title);
		$this->db->limit(1);
    	return $this->db->get()->row();
	}
	
	/*删除分类*/
	function del_style($type_id)
	{
    	$this->db->where('type_id', $type_id);
    	return $this->db->delete('website_style'); 
	}

}
?>