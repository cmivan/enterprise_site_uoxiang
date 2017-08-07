<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		//3.网站案例
		$this->load->model('Website_Model');
		//$this->data["products_types"] = $this->Website_Model->get_types();
		//$this->data["p_types"] = $this->data["products_types"];
		$this->data["p_types"] = $this->Website_Model->get_types();
		$this->data["p_styles"] = $this->Website_Model->get_styles();
		
		$this->load->model('Banner_page_Model');
		$this->data['banner'] = $this->Banner_page_Model->banner(11);
	}
	
	
	
	//产品分类导航
	function p_nav_html($data,$key)
	{
		$htm = '';
		$sel = '';
		$key_val = $this->input->getnum($key);
		foreach($data as $type){
			if( $key_val == $type->type_id ){
				$htm.= '<span class="label">'.$type->type_title.'</span>';
				$sel = array('title'=>$type->type_title,'key'=>$key);
			}else{
				if($key=='p_type_id'){
					$htm.= '<a href="'.reUrl($key.'='.$type->type_id.'&p_types_use_id=null&page=null').'">'.$type->type_title.'</a>';
				}else{
					$htm.= '<a href="'.reUrl($key.'='.$type->type_id.'&page=null').'">'.$type->type_title.'</a>';
				}
			}
			$htm.= '&nbsp;&nbsp;';
		}
		$d['htm'] = $htm;
		$d['sel'] = $sel;
		return $d;
	}
	
	//“已选择” 项HTML
	function p_nav_item_html($title,$key){
		$html = '<span class="label label-success">'.$title;
		$html.= '<a class="icon-remove" href="'.reUrl($key.'=null&page=null',1).'">&nbsp;<!--[if IE 6]>×<![endif]-->&nbsp;</a>';
		$html.= '</span>';
		$html.= '&nbsp;';
		return $html;
	}
	//“已选择” 项输出
	function p_nav_item($data){
		$html = '';
		if(!empty($data)){ $html = $this->p_nav_item_html($data['title'],$data['key']); }
		return $html;
	}
	
	
	
	

	function index($news='')
	{
		//Seo设置
		$this->data['seo']['title'] = '网站建设' . $this->data['seo']['space'] . '网站制作' . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		//关键词处理**************
		$p_nav = '';
		$keyword = noHtml($this->input->get('keyword'));
		if($keyword!=''){ $p_nav.= $this->p_nav_item_html($keyword,'keyword'); }
		
		//产品分类-风格类**************
		$p_styles_html = '';
		$p_styles_id = $this->input->getnum('p_styles_id');
		$p_styles = $this->data["p_styles"];
		$p_styles_html = $this->p_nav_html($p_styles,'p_styles_id');
		if( $p_styles_id ){ $p_nav.= $this->p_nav_item($p_styles_html['sel']); }
		
		//产品分类-大类**************
		$p_type_id = $this->input->getnum('p_type_id');
		$p_types = $this->data['p_types'];
		$p_types_html = '';
		$p_types_html = $this->p_nav_html($p_types,'p_type_id');
		if( $p_type_id ){ $p_nav.= $this->p_nav_item($p_types_html['sel']); }
		
		//产品分类-功能类**************
		$p_types_use_html = '';
		$p_types_use_id = $this->input->getnum('p_types_use_id');
		$p_types_use = $this->Website_Model->get_types($p_type_id);
		if( $p_type_id ){
			$p_types_use_html = $this->p_nav_html($p_types_use,'p_types_use_id');
			if( $p_types_use_id ){ $p_nav.= $this->p_nav_item($p_types_use_html['sel']); }
		}else{
			$p_types_use_html['htm'] = '';
		}

		//--------------
		$this->data['sBox'] = array(	 
					  'keyword' => $keyword,	
					  'p_nav' => $p_nav,
					  'p_types_html' => $p_types_html['htm'],
					  'p_types_use_html' => $p_types_use_html['htm'],
					  'p_styles_html' => $p_styles_html['htm']
					  );

		$this->data['type_id'] = '';
		$this->data['type_title'] = '';
		$this->data['type_note']  = '';
		if( $p_type_id )
		{
			//读取该分类的基本信息
			$type = $this->Website_Model->get_type($p_type_id);
			if(!empty($type))
			{
				$this->data['type_id'] = $type->type_id;
				$this->data['type_title'] = $type->type_title;
				$this->data['type_note'] = $type->type_note;
			}
			
			$this->db->where('typeB_id',$p_type_id);
			if($p_types_use_id)
			{
				$this->db->where('typeS_id',$p_types_use_id);
			}
		}
		
		if($p_styles_id){ $this->db->where('styles_id',$p_styles_id);}
		if(!empty($keyword)){ $this->db->like('title',$keyword); }
		if($news=='news'){ $this->db->where('new',1); }

		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from('website');
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,6);
		$this->data["listRows"] = $this->paging->listRows;

		//输出到视窗
		$this->load->view('website',$this->data);
	}
	
	
	
	function mofine(){
		$this->load->view('website_mofine',$this->data);
	}
	

	function news()
	{
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav']['website/news'] . $this->data['seo']['space'] . $this->data['seo']['title'];

		//关键词处理**************
		$p_nav = '';
		$keyword = noHtml($this->input->get('keyword'));
		if($keyword!=''){ $p_nav.= $this->p_nav_item_html($keyword,'keyword'); }
		
		//产品分类-风格类**************
		$p_styles_html = '';
		$p_styles_id = $this->input->getnum('p_styles_id');
		$p_styles = $this->data["p_styles"];
		$p_styles_html = $this->p_nav_html($p_styles,'p_styles_id');
		if( $p_styles_id ){ $p_nav.= $this->p_nav_item($p_styles_html['sel']); }
		
		//产品分类-大类**************
		$p_type_id = $this->input->getnum('p_type_id');
		$p_types = $this->data['p_types'];
		$p_types_html = '';
		$p_types_html = $this->p_nav_html($p_types,'p_type_id');
		if( $p_type_id ){ $p_nav.= $this->p_nav_item($p_types_html['sel']); }
		
		//产品分类-功能类**************
		$p_types_use_html = '';
		$p_types_use_id = $this->input->getnum('p_types_use_id');
		
		//$p_types_use = $this->Website_Model->get_types($p_type_id);
		$this->db->from('website_type');
		$this->db->join('website','website_type.type_id = website.typeS_id','left');
		$this->db->where('website.new',1);
		$this->db->group_by('website_type.type_id');
		$p_types_use = $this->db->get()->result();
		
		$p_types_use_html = $this->p_nav_html($p_types_use,'p_types_use_id');
		if( $p_types_use_id ){ $p_nav.= $this->p_nav_item($p_types_use_html['sel']); }

		//--------------
		$this->data['sBox'] = array(	 
					  'keyword' => $keyword,	
					  'p_nav' => $p_nav,
					  'p_types_html' => $p_types_html['htm'],
					  'p_types_use_html' => $p_types_use_html['htm'],
					  'p_styles_html' => $p_styles_html['htm']
					  );

		$this->data['type_id'] = '';
		$this->data['type_title'] = '';
		$this->data['type_note']  = '';
		if( $p_type_id )
		{
			//读取该分类的基本信息
			$type = $this->Website_Model->get_type($p_type_id);
			if(!empty($type))
			{
				$this->data['type_id'] = $type->type_id;
				$this->data['type_title'] = $type->type_title;
				$this->data['type_note'] = $type->type_note;
			}
			
			$this->db->where('typeB_id',$p_type_id);
		}
		
		if($p_types_use_id)
		{
			$this->db->where('typeS_id',$p_types_use_id);
		}
		
		if($p_styles_id){ $this->db->where('styles_id',$p_styles_id);}
		if(!empty($keyword))
		{
			$this->db->like('title',$keyword);
		}
		
		$this->db->where('new',1);

		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from('website');
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,15);
		$this->data["listRows"] = $this->paging->listRows;
		

		//输出到视窗
		$this->load->view('website_new',$this->data);
	}
	
	
	function view($id=0)
	{
		$id = get_num($id,'404');
		$view = $this->Website_Model->view($id);
		if(empty($view))
		{
			show_404('/');
		}
		else
		{
			//Seo设置
			$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
			$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
			$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
			
			$this->data['view'] = $view;
			$this->data["list"] = $this->Website_Model->get_list(3, $view->typeB_id );
			//输出到视窗
			$this->load->view('websiteView',$this->data);
		}
	}


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */