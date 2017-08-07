<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domain extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Banner_page_Model');
		$this->data['banner'] = $this->Banner_page_Model->banner(10);
	}

	function index()
	{
		$this->load->model('Columns_Model');
		$view = $this->Columns_Model->view(64);
		if( empty($view) )
		{
			show_404();
		}
		$this->data['view'] = $view;

		//Seo设置
		$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
		$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->load->view('domain',$this->data);
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */