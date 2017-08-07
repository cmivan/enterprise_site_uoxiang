<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends QT_Controller {
	
	public $table = 'news';
	public $typeb_id = 23;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('News_Model');
		$this->load->model('Banner_page_Model');
		$this->data['banner'] = $this->Banner_page_Model->banner(13);
		
		//获取当前分类名称
		$this->data['type_link']['name'] = $this->News_Model->get_type_name($this->typeb_id);
		$this->data['type_link']['link'] = 'common';
	}

	function index()
	{
		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('typeb_id',$this->typeb_id);
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,20);
		
		//Seo设置
		$this->data['seo']['title'] = $this->data['type_link']['name'] . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		//输出到视窗
		$this->load->view($this->table,$this->data);
	}
	
	function view($id=0)
	{
		$id = get_num($id,'404');
		$view = $this->News_Model->view($id);
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
			//生成二维码
			$this->load->library('Qrcode');
			$this->data['qrcode'] = $this->qrcode->view($view->title);
			
			//输出到视窗
			$this->load->view($this->table.'_view',$this->data);
		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */