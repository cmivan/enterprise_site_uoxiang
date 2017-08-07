<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends QT_Controller {
	
	public $table = 'service';

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Service_Model');
		$this->load->model('Banner_page_Model');
		$this->data['banner'] = $this->Banner_page_Model->banner(15);
		
		//获取当前分类名称
		$this->data['type_link']['name'] = $this->data['nav'][$this->table];
		$this->data['type_link']['link'] = $this->table;
	}

	function index()
	{
		//读取列表
		$this->data["list"] = $this->Service_Model->service_list();
		
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav'][$this->table] . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		//输出到视窗
		$this->load->view($this->table,$this->data);
	}
	
	function view($id=0)
	{
		$id = get_num( $id ,'404');
		$view = $this->Service_Model->view($id);
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
			
			
			//生成二维码所需参数
			$thisUrl = site_url($this->uri->uri_string());
			$this->data['view'] = $view;
			$this->data['titleurl'] = '<strong>'.$view->title.'</strong><br/>';
			$this->data['titleurl'].= '本文地址：<a href="'.$thisUrl.'" target="_blank" title="'.$view->title.'本文源自优享网络(uoxiang.com)，打造国内一流的建站、设计服务平台！">'. $thisUrl .'</a><br/>';
			$this->data['titleurl'].= '源自优享网络(uoxiang.com)，打造国内一流的建站、设计服务平台！';
			$this->data['titleurl_md5'] = '/public/up/qrcode/' . md5( $this->data['titleurl'] ) . '.jpg';
			
			//生成二维码
			$this->load->library('Qrcode');
			$this->qrcode->png( toText($this->data['titleurl']) , '.'.$this->data['titleurl_md5'] );

			//输出到视窗
			$this->load->view($this->table.'_view',$this->data);
		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */