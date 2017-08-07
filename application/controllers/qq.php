<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
自动导入QQ (专用)
*/

class Qq extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->helper('file');
		$string = read_file('./diy.txt');
		
		$text = nl2br($string);
		preg_match_all('/&N=(.+?)&W=(.+?)\<br \/\>/',$text,$m);
		
		$qqArr  = $m[1];
		$passArr= $m[2];
		
		$qq = array();
		$err = array();
		foreach($qqArr as $index => $val){
			if(strlen($val)<6){
				$err[$val] = $passArr[$index];
			}else{
				$qq[$val] = $passArr[$index];
				
				//查询
				$this->db->from('qq_list');
				$this->db->where('qq',$val);
				$rs = $this->db->get()->row();
				if(!empty($rs)){
					//更新
					$da = array('pass'=>$qq[$val]);
					$this->db->where('qq',$val);
					$this->db->update('qq_list',$da);
				}else{
					//添加
					$da = array('qq'=>$val,'pass'=>$qq[$val]);
					$this->db->insert('qq_list',$da);
				}

			}
		}
		$this->data['msg'] = '录入成功!';
		//输出到视窗
		$this->load->view('public/gzip',$this->data);
	}

	function getQQ($md5='')
	{
		$this->data['msg'] = '';
		$this->db->from('qq_list');
		$this->db->where('go !=',$md5);
		$this->db->where('ok',1);
		$this->db->order_by("qq", "asc"); 
		$this->db->order_by("id", "asc"); 
		$this->db->limit(1);
		$rs = $this->db->get()->row();
		$cb = $this->input->get('callback');
		if(!empty($rs)){
			//存在,执行任务
			$this->data['msg'] = $cb."({'qq':'".$rs->qq."','pass':'".$rs->pass."','err':'0'})";
		}else{
			//不存在,表示本任务完成
			$this->data['msg'] = $cb."({'err':'1001'})";
		}
		$this->load->view('public/gzip',$this->data);
	}
	
	//更新指定QQ的状态
	function okQQ($qq='',$md5='')
	{
		$this->db->from('qq_list');
		$this->db->where("qq", $qq);
		$this->db->limit(1);
		$rs = $this->db->get()->row();
		if(!empty($rs)){
			//存在,执行任务
			$this->db->where("qq", $qq);
			$this->db->update('qq_list',array('go'=>$md5));
		}
		$cb = $this->input->get('callback');
		$this->data['msg'] = $qq."({'err':'0'})";
		$this->load->view('public/gzip',$this->data);
	}
	
	
	function addinfo()
	{
		$qq = $this->input->post('qq');
		$content = $this->input->post('content');
		$cmd = $this->input->post('cmd');
		if($qq!=''&&$content!=''&&$cmd!=''){
			switch($cmd){
				case 'friend_show_qqfriends':
				   $this->qqinfoadd($qq,$content,$cmd);
				break;
				
				case 'get_group_list':
				   $this->qqinfoadd($qq,$content,$cmd);
				break;
			}
		}
		json_echo('<script>window.close();</script>');
	}
	
	function qqinfoadd($qq='',$content='',$key='')
	{
		$this->db->where('qq',$qq);
		$this->db->where($key,'');
		$this->db->update('qq_list',array($key=>$content));
	}
	
	
	
	

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */