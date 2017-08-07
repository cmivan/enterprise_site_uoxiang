<?php
class Banner_page_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function lists()
	{
	    $this->db->select('*');
    	$this->db->from('banner_page');
		$this->db->order_by('order_id','desc');
		$this->db->order_by('id','desc');
    	return $this->db->get()->result();
	}

	function view($id=0)
	{
	    $this->db->select('*');
    	$this->db->from('banner_page');
		if( $id )
		{
			$this->db->where('id',$id);
		}
		$this->db->order_by('order_id','desc');
		$this->db->order_by('id','desc');
    	$this->db->limit(1);
    	return $this->db->get()->row();
	}

	function banner($id=0)
	{
		$banner_img = 'public/banner/images/aboutus.jpg';
	    $view = $this->view($id);
		if( !empty($view) )
		{
			$banner_img = $view->pic_s;
		}
    	return '<img src="'.$banner_img.'" width="980" />';
	}
	

	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('banner_page'); 
	}

}
?>