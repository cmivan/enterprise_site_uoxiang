<?php
class Service_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


	//返回最新的N条
	function service_list()
	{
	    $this->db->select('*');
    	$this->db->from('service');
    	$this->db->order_by('order_id','desc');
    	$this->db->order_by('id','asc');
    	return $this->db->get()->result();
	}
	
	//文章点击+1
	function hit($id=0)
	{
    	$this->db->set('hits', 'hits+1', FALSE);
    	$this->db->where('id', $id);
    	return $this->db->update('service');
	}
	
	//返回文章内容详情
	function view($id=0)
	{
	    $this->db->select('*');
    	$this->db->from('service');
    	$this->db->where('id',$id);
    	$this->db->limit(1);
    	return $this->db->get()->row();
	}
	
	
	//删除文章内容
	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('service'); 
	}
	

}
?>