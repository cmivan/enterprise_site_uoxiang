<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wxapi extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('Wxapi_lib');
	}
	

	function index()
	{
		$this->wxapi_lib->run();
		//输出到视窗
		//$this->load->view('public/gzip.php',$this->data);
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */