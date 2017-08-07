<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aboutus extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->model('Columns_Model');
		$this->data['columns'] = $this->Columns_Model->lists(22);
		
		$this->load->model('Banner_page_Model');
		$this->data['banner'] = $this->Banner_page_Model->banner(12);

		//Seo设置
		$this->data['seo']['title'] = '了解我们(About Us)' . $this->data['seo']['space'] . $this->data['seo']['title'];
		//$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		//$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->load->view('aboutus',$this->data);
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */