<?php
class Modular_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function lists()
	{
	    $this->db->select('*');
    	$this->db->from('modular');
		$this->db->order_by('order_id','desc');
		$this->db->order_by('id','desc');
    	return $this->db->get()->result();
	}

	function view($id=0)
	{
	    $this->db->select('*');
    	$this->db->from('modular');
		if( $id )
		{
			$this->db->where('id',$id);
		}
		$this->db->order_by('order_id','desc');
		$this->db->order_by('id','desc');
    	$this->db->limit(1);
    	$view = $this->db->get()->row();
		if(!empty($view)){
			return $view->content;
		}
		return '';
	}

	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('modular'); 
	}

}
?>