<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		//生成二维码
		//$this->load->library('Qrcode');
		//$this->qrcode->png('123', 'qr.png');
		
		
		//Seo设置
		//$this->data['seo']['title'] = '朴风堂首页' . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		//print_r(iptodata('102.17.2.123'));
		
		//$this->data["p_types"] = NULL;
		
		/*banner图片*/
		$this->db->select('title,pic_s,toUrl');
		$this->db->from('banner');
		$this->db->order_by('id','desc');
		$this->data['banner'] = $this->db->get()->result();

		/*业务服务*/
		$this->load->model('Service_Model');
		$this->data['service'] = $this->Service_Model->service_list();
		
		//5.新闻动态
		$this->load->model('News_Model');
		$this->data["top_news"] = $this->News_Model->top_news(6);

		/*首页关于我们*/
		$this->data["modular"]['aboutus'] = $this->Modular_Model->view(12);
		
		/*文章列表*/
		$this->load->model('Articles_Model');
		$this->data["articles_type"] = $this->Articles_Model->get_types(0,'');

		//输出到视窗
		$this->load->view('index',$this->data);
		
		
		
		
		//$this->load->model('Columns_Model');
		//$view = $this->Columns_Model->view(10);
		//if( empty($view) )
		//{
		//	show_404();
		//}
		//$this->data['view'] = $view;

		//Seo设置
		//$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
		//$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		//$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		//$this->load->view('page',$this->data);

	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */