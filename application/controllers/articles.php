<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends QT_Controller {
	
	public $table = 'articles';
	public $typeb_id = 22;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Articles_Model');
		$this->load->model('Banner_page_Model');
		$this->data['banner'] = $this->Banner_page_Model->banner(13);
		
		/*业务服务*/
		$this->load->model('Service_Model');
		$this->data['service'] = $this->Service_Model->service_list();
	}

	function index()
	{
		/*文章列表*/
		$this->data["articles_type"] = $this->Articles_Model->get_types();

		//输出到视窗
		$this->load->view($this->table,$this->data);
	}
	

	function type($type_id='',$rss='')
	{
		//获取当前分类名称
		$this->data['type_link']['name'] = $this->data['nav'][$this->table];
		$this->data['type_link']['link'] = $this->table;
		
		$this->data['type_link']['name1'] = $this->Articles_Model->get_type_name($type_id);
		$this->data['type_link']['link1'] = $this->table.'/type/'.$type_id;
		
		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('typeb_id',$type_id);
		$this->db->order_by('id','desc');

		
		if($rss=='rss'){
			//输出到视窗
			$this->data["list"] = $this->db->get()->result();
			$this->load->view($this->table.'_rss',$this->data);
		}else{
			
			$listsql = $this->db->getSQL();
			
			//读取列表
			$this->load->library('Paging');
			$this->data["list"] = $this->paging->show( $listsql ,20);
			
			//Seo设置
			$this->data['seo']['title'] = $this->Articles_Model->get_type_name($type_id) . $this->data['seo']['space'] . $this->data['seo']['title'];
			
			//输出到视窗
			$this->load->view($this->table.'_type',$this->data);
		}

	}
	
	
	
	function view($id=0)
	{
		$id = get_num($id,'404');
		$view = $this->Articles_Model->view($id);
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
			
			//获取当前分类名称
			$this->data['type_link']['name'] = $this->data['nav'][$this->table];
			$this->data['type_link']['link'] = $this->table;
			
			$this->data['type_link']['name1'] = '{'.$this->Articles_Model->get_type_name($view->typeB_id).'} '.$view->title;
			$this->data['type_link']['link1'] = $this->table.'/view/'.$view->id;
			
			$this->data['view'] = $view;

			//生成二维码
			$this->load->library('Qrcode');
			$this->data['qrcode'] = $this->qrcode->view($view->title);
			
			
			//输出到视窗
			$this->load->library('user_agent');
			if($this->agent->is_mobile('iphone')){
				$this->load->view($this->table.'_view_mobile',$this->data);
			}else if($this->agent->is_mobile()){
				$this->load->view($this->table.'_view_mobile',$this->data);
			}else{
				//$this->load->view($this->table.'_view_mobile',$this->data);
				$this->load->view($this->table.'_view',$this->data);
			}
			
		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */