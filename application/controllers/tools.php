<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->data['topNav'] = 'tools';
		$this->data['toolsUrl'] = 'http://banner.alimama.com/templets';
	}

	function index()
	{
		$this->banner();
	}
	
	//书法
	function shufa()
	{
		//Seo设置
		$this->data['seo']['title'] = '在线书法工具' . $this->data['seo']['space'] . $this->data['seo']['title'];
		//$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		//$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->data['toolsUrl'] = 'http://www.shufaziti.com';
		$this->load->view('tools',$this->data);
	}
	
	//颜色
	function color()
	{
		//Seo设置
		$this->data['seo']['title'] = '在线颜色工具、在线网页颜色、在线HTML颜色' . $this->data['seo']['space'] . $this->data['seo']['title'];
		//$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		//$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->load->view('tools_color',$this->data);
	}
	
	//颜色
	function code()
	{
		//Seo设置
		$this->data['seo']['title'] = 'JQuery代码，JQuery库，JQuery能为网页增加互动、趣味' . $this->data['seo']['space'] . $this->data['seo']['title'];
		//$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		//$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->load->view('tools_code',$this->data);
	}
	
	//在线PS
	function ps()
	{
		//Seo设置
		$this->data['seo']['title'] = '在线美图秀秀、在线PS、在线图片处理工具' . $this->data['seo']['space'] . $this->data['seo']['title'];
		//$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		//$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->data['toolsUrl'] = 'http://xiuxiu.web.meitu.com/main.html';
		$this->load->view('tools',$this->data);
	}
	
	//在线banner制作
	function banner()
	{
		//Seo设置
		$this->data['seo']['title'] = '在线横幅制作、在线Banner生成、Banner在线生成工具' . $this->data['seo']['space'] . $this->data['seo']['title'];
		//$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		//$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->load->view('tools',$this->data);
	}
	
	
	
	
	//超级SEO外链
	function links($go='')
	{
		//domain
		$this->data['page'] = $this->input->getnum('page',0);
		$this->data['domain'] = $this->input->get('domain');
		$this->data['count'] = 0;
		
		$this->data['thisUrl'] = site_url('tools/links/seo');
		if($go=='seo'){
			
			//读取该分类下的产品
			$this->db->select('*');
			$this->db->from('seo_links');
			$this->db->order_by('id','desc');
			$listsql = $this->db->getSQL();
			
			//读取列表
			$this->load->library('Paging');
			$this->data["list"] = $this->paging->show( $listsql , 10 );
			$this->data['count'] = $this->paging->listRows;

			//输出到视窗
			$this->load->view('tools_links_seo',$this->data);
		}elseif($go=='url'){
			$this->load->view('tools_links_url',$this->data);
		}else{
			$domain = $_SERVER['QUERY_STRING'];
			$this->data['domain'] = $domain;
			
			$this->data['seo']['title'] = $domain . '超级SEO外链 - 免费在线自动增加外链！'.$this->data['seo']['title'];
			$this->data['seo']['keywords'] = '站长工具,查询工具,免费自动增加外链'.$domain.','.$this->data['seo']['keywords'];
			$this->data['seo']['description'] = '站长工具,超级SEO外链工具' . $domain . ',免费刷外链，快速自动增加外链！';
			//输出到视窗
			$this->load->view('tools_links',$this->data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */