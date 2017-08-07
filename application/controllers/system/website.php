<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website extends HT_Controller {
	
	public $table = 'website';
	public $title = '网站';
	
	function __construct()
	{
		parent::__construct();
		//判断是否已经配置信息
		
		$this->data['dbtable'] = $this->table;
		$this->data['dbtitle'] = $this->title;
		
		$this->load->model('Website_Model');
		$this->load->helper('forms');

		$this->data['typeB'] = $this->Website_Model->types_box();
		$this->data['styleB'] = $this->Website_Model->style_box();
	}
	
	function index()
	{
		return $this->manage();
	}
	


/* ********** 管理 *********** */
	function manage()
	{
		$this->load->library('Paging');

		//操作
		$id = $this->input->get_or_post('id');
		$cmd = $this->input->get_or_post('cmd');
		switch($cmd)
		{
			//删除信息
			case 'del':
				  if( is_num($id) )
				  {
					  $this->db->where('id',$id);
					  $this->db->delete( $this->table );
				  }
				  elseif( is_array($id) )
				  {
					  $this->db->where_in('id',$id);
					  $this->db->delete( $this->table );	
				  }
			break;
			//移动信息
			case 'move':
				  if( is_array($id) )
				  {
					  $type_id = $this->input->post('type_id');
					  $T = $this->Website_Model->get_type_arr( $type_id );
					  $this->db->where_in('id',$id);
					  $this->db->update( $this->table , $T );
				  }
			break;
			//切换check状态
			case 'ok':
			case 'hot':
			case 'new':
			      $val = $this->input->get('val');
				  if( is_num($val) )
				  {
					  if( is_num($id) )
					  {
						  $val = get_num($val,0);
						  $this->Website_Model->check_change($id,$cmd,$val);
					  }  
				  }
			break;
		}


		//获取分类
		$typeB_id = $this->input->getnum('typeb_id');
		$typeS_id = $this->input->getnum('types_id');
		$styles_id = $this->input->getnum('styles_id');
		if( $typeB_id )
		{
			$this->data['typeS'] = $this->Website_Model->types_box( $typeB_id );
		}
		
		
		//生成查询
		$this->db->select('*');
		$this->db->from( $this->table );
		//搜索关键词
		$keyword = $this->input->get_or_post('keyword',TRUE);
		if($keyword!='')
		{
			$keylike_on[] = array( 'title'=> $keyword );
			$keylike_on[] = array( 'note'=> $keyword );
			$this->db->like_on($keylike_on);
		}
		//分类检索
		if ( $typeB_id )
		{
			$this->db->where('typeB_id',$typeB_id);
			if ( $typeS_id )
			{
				$this->db->where('typeS_id',$typeS_id);
			}
		}
		if ( $styles_id )
		{
			$this->db->where('styles_id',$styles_id);
		}
		
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		//读取列表
		$this->data["list"] = $this->paging->show( $listsql , 20 );
		
		$this->data['typeB_id'] = $typeB_id;
		$this->data['typeS_id'] = $typeS_id;
		$this->data['styles_id'] = $styles_id;
		$this->data['keyword'] = $keyword;
		$this->load->view_system('template/'.$this->table.'/manage',$this->data);
	}


/* ********** 添加/编辑 *********** */
	function edit()
	{
		$this->load->library('kindeditor');
		
		$id = $this->input->getnum('id');
		
		$this->data['rs'] = array(
			  'id' => $id,
			  'title' => '',
			  'pro_no' => '',
			  'url' => '',
			  'size_w' => '',
			  'size_h' => '',
			  'price' => '',
			  'price_vip' => '',
			  'note' => '',
			  'content' => '',
			  'pic_b' => '',
			  'pic_s' => '',
			  'note' => '',
			  'typeB_id' => 0,
			  'typeS_id' => 0,
			  'styles_id' => 0,
			  'add_time' => dateTime(),
			  'add_ip' => ip(),
			  'hits' => '',
			  'order_id' => 0,
			  'new' => 0,
			  'ok' => 0,
			  'hot' => 0
			  );
		
		if( $id )
		{
			$this->db->select('*');
			$this->db->from( $this->table );
			$this->db->where('id',$id);
			$rs = $this->db->get()->row();
			if( !empty($rs) )
			{
				$this->data['rs'] = array(
					  'id' => $rs->id,
					  'title' => $rs->title,
					  'pro_no' => $rs->pro_no,
					  'url' => $rs->url,
					  'size_w' => $rs->size_w,
					  'size_h' => $rs->size_h,
					  'price' => $rs->price,
					  'price_vip' => $rs->price_vip,
					  'note' => $rs->note,
					  'content' => $rs->content,
					  'pic_b' => $rs->pic_b,
					  'pic_s' => $rs->pic_s,
					  'note' => $rs->note,
					  'typeB_id' => $rs->typeB_id,
					  'typeS_id' => $rs->typeS_id,
					  'styles_id' => $rs->styles_id,
					  'add_time' => $rs->add_time,
					  'add_ip' => $rs->add_ip,
					  'hits' => $rs->hits,
					  'order_id' => $rs->order_id,
					  'new' => $rs->new,
					  'ok' => $rs->ok,
					  'hot' => $rs->hot
					  );
			}
		}
		$this->data['formTO']->url = site_system( $this->table . '/edit_save',1);
		$this->data['formTO']->backurl = site_system($this->table,1);
		$this->load->view_system('template/'.$this->table.'/edit',$this->data);
	}
	
	//保存产品添加/编辑
	function edit_save()
	{
		$id = $this->input->postnum('id');
		
		$title = $this->input->post('title');
		$pro_no = $this->input->post('pro_no');
		$url = $this->input->post('url');
		$size_w = $this->input->post('size_w');
		$size_h = $this->input->post('size_h');
		$price = $this->input->post('price');
		$price_vip = $this->input->post('price_vip');
		$note = $this->input->post('note');
		$content = $this->input->post('content');
		$pic_b = $this->input->post('pic_b');
		$pic_s = $this->input->post('pic_s');
		$note = $this->input->post('note');
		$type_id = $this->input->postnum('type_id',0);

		$T = $this->Website_Model->get_type_arr( $type_id );
		$typeB_id = $T['typeB_id'];
		$typeS_id = $T['typeS_id'];
		$styles_id = $this->input->postnum('styles_id',0);

		$add_time = $this->input->post('add_time');
		$add_ip = $this->input->post('add_ip');
		$hits = $this->input->postnum('hits',0);
		$order_id = $this->input->postnum('order_id',0);
		$new = $this->input->postnum('new',0);
		$ok = $this->input->postnum('ok',0);
		$hot = $this->input->postnum('hot',0);
		
		$data = array(
			  'title' => $title,
			  'pro_no' => $pro_no,
			  'url' => $url,
			  'size_w' => $size_w,
			  'size_h' => $size_h,
			  'price' => $price,
			  'price_vip' => $price_vip,
			  'note' => $note,
			  'content' => $content,
			  'pic_b' => $pic_b,
			  'pic_s' => $pic_s,
			  'typeB_id' => $typeB_id,
			  'typeS_id' => $typeS_id,
			  'styles_id' => $styles_id,
			  'add_time' => $add_time,
			  'add_ip' => $add_ip,
			  'hits' => $hits,
			  'order_id' => $order_id,
			  'new' => $new,
			  'ok' => $ok,
			  'hot' => $hot
			  );
		
		if( $id )
		{
			$this->db->where('id',$id);
			$this->db->update( $this->table ,$data);
			json_form_yes('更新成功！');
		}
		else
		{
			$this->db->insert( $this->table ,$data);
			json_form_yes('录入成功！');
		}
	}
	
	

/* ********** 分类管理页面 *********** */
	
	
	//分类页面
	function type()
	{
		//普通删除、数据处理
		$del_id = $this->input->getnum('del_id');
		if( $del_id )
		{
			$this->Website_Model->del_type($del_id);
			//重新获取分类
			$this->data['typeB'] = $this->Website_Model->types_box();
		}

		//(post)处理大类排序问题
		$go = $this->input->post('go');
		if($go=='yes')
		{
			$cmd = $this->input->post('cmd');
			$type_id = $this->input->postnum('type_id');
			
			if($cmd=='')
			{
				json_form_no('未知操作!');
			}
			elseif($type_id==false)
			{
				json_form_no('参数丢失,本次操作无效!');
			}
			
			$row = $this->Website_Model->get_type( $type_id );
			if(!empty($row))
			{
				//执行重新排序
				$this->load->helper('publicedit');
				$keys = array(
					  'table'=> $this->table . '_type',
					  'key'  => 'type_id',
					  'okey' => 'type_order_id',
					  'id'   => $row->type_id,
					  'oid'  => $row->type_order_id,
					  'type' => $cmd
					  );
				List_Re_Order($keys);
			}	
		}
		
		//表单配置
		$this->data['formTO']->url = site_system( $this->table . '/type',1);
		$this->data['formTO']->backurl = '';

		//输出界面效果
		$this->load->view_system('template/'.$this->table.'/type_manage',$this->data);
	}
	
	function type_edit()
	{
		$this->load->library('kindeditor');
		
		//接收Url参数
		$id = $this->input->getnum('id');
		
		//初始化数据
		$this->data['type_id'] = $id;
		$this->data['type_title'] = '';
		$this->data['type_note'] = '';
		$this->data['type_pic'] = '';
		$this->data['type_ids'] = 0;
		$this->data['type_order_id'] = 0;
		
		$this->data['action_name'] = "添加";
		if( $id )
		{
			$this->data['action_name'] = "编辑";
			$rs = $this->Website_Model->get_type($id);
			if(!empty($rs))
			{
				$this->data['type_title'] = $rs->type_title;
				$this->data['type_note'] = $rs->type_note;
				$this->data['type_pic'] = $rs->type_pic;
				$this->data['type_ids'] = $rs->type_ids;
				$this->data['type_order_id'] = $rs->type_order_id;
			}
		}
		
		//表单配置
		$this->data['formTO']->url = site_system( $this->table . '/type_save',1);
		$this->data['formTO']->backurl = site_system( $this->table . '/type',1);
		
		$this->load->view_system('template/'.$this->table.'/type_edit',$this->data);
	}
	
	
	//保存分类
	function type_save()
	{
		//接收提交来的数据
		$type_id = $this->input->postnum('type_id');
		$type_title = $this->input->post('type_title');
		$type_note = $this->input->post('type_note');
		$type_pic = $this->input->post('type_pic');
		$type_ids = $this->input->postnum('type_ids',0);
		$type_order_id = $this->input->postnum('type_order_id',0);

		//验证数据
		if($type_title=='')
		{
			json_form_no('请填写标题!');
		}
		elseif($type_order_id===false)
		{
			json_form_no('请在排序处填写正整数!');
		}
		
		//写入数据
		$data['type_title'] = $type_title;
		$data['type_note'] = $type_note;
		$data['type_pic'] = $type_pic;
		$data['type_ids'] = $type_ids;
		$data['type_order_id'] = $type_order_id;
		
		if($type_id==false)
		{
			//添加
			$this->db->insert($this->table . '_type',$data);
			//重洗分类排序
			$this->re_order_type();
			json_form_yes('添加成功!');
		}
		else
		{
			//修改
			$this->db->where('type_id',$type_id);
			$this->db->update($this->table . '_type',$data);
			//重洗分类排序
			$this->re_order_type();
			json_form_yes('修改成功!');
		}	
	}

	//重洗分类排序
	function re_order_type()
	{
		$re_row = $this->Website_Model->get_types();
		if(!empty($re_row))
		{
			$re_num = $this->Website_Model->get_types_num();
			foreach($re_row as $re_rs)
			{
				$data['type_order_id'] = $re_num;
				$this->db->where('type_id',$re_rs->type_id);
				$this->db->update( $this->table . '_type',$data);
				$re_num--;
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
/* ********** 风格管理页面 *********** */
	
	
	//风格页面
	function style()
	{
		//普通删除、数据处理
		$del_id = $this->input->getnum('del_id');
		if( $del_id )
		{
			$this->Website_Model->del_style($del_id);
			//重新获取风格
			$this->data['typeB'] = $this->Website_Model->style_box();
		}

		//(post)处理大类排序问题
		$go = $this->input->post('go');
		if($go=='yes')
		{
			$cmd = $this->input->post('cmd');
			$type_id = $this->input->postnum('type_id');
			
			if($cmd=='')
			{
				json_form_no('未知操作!');
			}
			elseif($type_id==false)
			{
				json_form_no('参数丢失,本次操作无效!');
			}
			
			$row = $this->Website_Model->get_style( $type_id );
			if(!empty($row))
			{
				//执行重新排序
				$this->load->helper('publicedit');
				$keys = array(
					  'table'=> $this->table . '_style',
					  'where'=> 'type_ids=0',
					  'key'  => 'type_id',
					  'okey' => 'type_order_id',
					  'id'   => $row->type_id,
					  'oid'  => $row->type_order_id,
					  'type' => $cmd
					  );
				List_Re_Order($keys);
			}	
		}
		
		//表单配置
		$this->data['formTO']->url = site_system( $this->table . '/style',1);
		$this->data['formTO']->backurl = '';

		//输出界面效果
		$this->load->view_system('template/'.$this->table.'/style_manage',$this->data);
	}
	
	function style_edit()
	{
		$this->load->library('kindeditor');
		
		//接收Url参数
		$id = $this->input->getnum('id');
		
		//初始化数据
		$this->data['type_id'] = $id;
		$this->data['type_title'] = '';
		$this->data['type_note'] = '';
		$this->data['type_pic'] = '';
		$this->data['type_ids'] = 0;
		$this->data['type_order_id'] = 0;
		
		$this->data['action_name'] = "添加";
		if( $id )
		{
			$this->data['action_name'] = "编辑";
			$rs = $this->Website_Model->get_style($id);
			if(!empty($rs))
			{
				$this->data['type_title'] = $rs->type_title;
				$this->data['type_note'] = $rs->type_note;
				$this->data['type_pic'] = $rs->type_pic;
				$this->data['type_ids'] = $rs->type_ids;
				$this->data['type_order_id'] = $rs->type_order_id;
			}
		}
		
		//表单配置
		$this->data['formTO']->url = site_system( $this->table . '/style_save',1);
		$this->data['formTO']->backurl = site_system( $this->table . '/style',1);
		
		$this->load->view_system('template/'.$this->table.'/style_edit',$this->data);
	}
	
	
	//保存风格
	function style_save()
	{
		//接收提交来的数据
		$type_id = $this->input->postnum('type_id');
		$type_title = $this->input->post('type_title');
		$type_note = $this->input->post('type_note');
		$type_pic = $this->input->post('type_pic');
		$type_ids = $this->input->postnum('type_ids',0);
		$type_order_id = $this->input->postnum('type_order_id',0);

		//验证数据
		if($type_title=='')
		{
			json_form_no('请填写标题!');
		}
		elseif($type_order_id===false)
		{
			json_form_no('请在排序处填写正整数!');
		}
		
		//写入数据
		$data['type_title'] = $type_title;
		$data['type_note'] = $type_note;
		$data['type_pic'] = $type_pic;
		$data['type_ids'] = $type_ids;
		$data['type_order_id'] = $type_order_id;
		
		if($type_id==false)
		{
			//添加
			$this->db->insert($this->table . '_style',$data);
			//重洗风格排序
			$this->re_order_style();
			json_form_yes('添加成功!');
		}
		else
		{
			//修改
			$this->db->where('type_id',$type_id);
			$this->db->update($this->table . '_style',$data);
			//重洗风格排序
			$this->re_order_style();
			json_form_yes('修改成功!');
		}	
	}

	//重洗风格排序
	function re_order_style()
	{
		$re_row = $this->Website_Model->get_styles();
		if(!empty($re_row))
		{
			$re_num = $this->Website_Model->get_style_num();
			foreach($re_row as $re_rs)
			{
				$data['type_order_id'] = $re_num;
				$this->db->where('type_id',$re_rs->type_id);
				$this->db->update( $this->table . '_style',$data);
				$re_num--;
			}
		}
	}
	



}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */