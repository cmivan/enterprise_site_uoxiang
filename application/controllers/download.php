<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends QT_Controller {
	
	public $table = 'download';

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,20);
		
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav'][$this->table] . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		//输出到视窗
		$this->load->view($this->table,$this->data);
	}
	
	function view($id=0)
	{
		$id = get_num($id,'404');
		$this->load->model('Download_Model');
		$view = $this->Download_Model->view($id);
		if(empty($view))
		{
			show_404('/');
		}
		else
		{
			$this->data['errtip'] = '';
			$this->data['password'] = '';
			
			//验证提交的密码
			$action = $this->input->post('action');
			if($action=='down')
			{
				$password = $this->input->post('password');
				$this->data['password'] = $password;
				if($password=='')
				{
					$this->data['errtip'] = '请填写下载密码!';
				}
				elseif( $password != $this->data['seo']['download.pass'])
				{
					$this->data['errtip'] = '下载密码不正确!';
				}
				else
				{
					$this->session->set_userdata(array('DownDocPass'=>'ok'));
				}
			}
			
			
			//$is_downloaded = $this->session->userdata('DownloadDoc'.$id);
			$is_downloaded = $this->session->userdata('DownDocPass');
			if($is_downloaded=='ok')
			{
				redirect($view->pic_s.'?5cmlabs', 'refresh'); exit;
			}
			

			//Seo设置
			$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
			$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
			$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
			
			$this->data['view'] = $view;
			//输出到视窗
			$this->load->view($this->table.'_view',$this->data);
		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */