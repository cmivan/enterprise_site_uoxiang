<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_into_pic extends HT_Controller {
	
	function __construct()
	{
		parent::__construct();

		/*初始化加载application\core\MY_Controller.php
		这里的加载必须要在产生其他 $data 数据前加载*/
		
		$this->load->helper('directory');
		$this->load->helper('file');
	}
	
	function retype(){
		
	}
	
	function into()
	{
		$path = '/public/up/uploads/20120526/view/';
		$pathB = '/public/up/uploads/20120526/big/';
		$pathS = '/public/up/uploads/20120526/small/';
		
		$map = directory_map('.'.$path, FALSE, FALSE);
		foreach($map as $dir => $val)
		{
			$dir = mb_convert_encoding($dir, "UTF-8", "GB2312");
			
			if(is_numeric($dir)==false){
				//获取产品分类ID
				$this->db->select('type_id');
				$this->db->from('products_type');
				$this->db->where('type_title',$dir);
				$this->db->limit(1);
				$rs = $this->db->get()->row();
				$typeB_id = 0;
				if(!empty($rs))
				{
					$typeB_id = $rs->type_id;
					
					//修改文件夹
					$xxx = '.' . $path . $dir;
					$xxx = iconv("utf-8","gb2312",$xxx);
					$xx2 = '.'. $path . $typeB_id;
					rename("$xxx","$xx2");
					//--------------------
					$xxx = '.' . $pathB . $dir;
					$xxx = iconv("utf-8","gb2312",$xxx);
					$xx2 = '.'. $pathB . $typeB_id;
					rename("$xxx","$xx2");
					//--------------------
					$xxx = '.' . $pathS . $dir;
					$xxx = iconv("utf-8","gb2312",$xxx);
					$xx2 = '.'. $pathS . $typeB_id;
					rename("$xxx","$xx2");
					
					echo '成功修改目录：' . $path . $dir . '/';
				}
			}else{
				$typeB_id = $dir;
			}

			
			foreach($val as $file)
			{
				if($file!='Thumbs.db')
				{
					$filePath  = '.'.$path . $dir . '/' . $file;
					$filePath2 = '.'.$path . $dir . '/' . md5($file) . '.jpg';
					rename("$filePath","$filePath2");
					//--------------------
					$filePath  = '.'.$pathB . $dir . '/' . $file;
					$filePath2 = '.'.$pathB . $dir . '/' . md5($file) . '.jpg';
					rename("$filePath","$filePath2");
					//--------------------
					$filePath  = '.'.$pathS . $dir . '/' . $file;
					$filePath2 = '.'.$pathS . $dir . '/' . md5($file) . '.jpg';
					rename("$filePath","$filePath2");
					
					
					$filePath  = $path . $dir . '/' . $file;
					$filePath2 = $path . $dir . '/' . md5($file) . '.jpg';
					$file = mb_convert_encoding($file, "UTF-8", "GB2312");
					$title = $file;
					
					//-------------------------------
					
					$title = str_replace('副本','',$title);
					$title = str_replace('.jpg','',$title);
					$title = str_replace('.','',$title);
					$title = str_replace(' 拷贝','',$title);
					
					$this->db->select('id,title');
					$this->db->from('products');
					$this->db->where('title',$title);
					$this->db->limit(1);
					$item = $this->db->get()->row();
					if(empty($item)){
						$rs = array(
							  'title' => $title,
							  'pro_no' => '',
							  'size_z' => 0,
							  'size_w' => 0,
							  'size_h' => 0,
							  'price' => 0,
							  'price_vip' => 0,
							  'note' => $title,
							  'content' => '<img src="'.$filePath2.'" />',
							  'pic_b' => str_replace('view','big',$filePath2),
							  'pic_s' => str_replace('view','small',$filePath2),
							  'typeB_id' => $typeB_id,
							  'typeS_id' => 0,
							  'add_ip' => ip(),
							  'hits' => 0,
							  'order_id' => 0
							  );
						$this->db->insert('products',$rs);
					}else{
						$itemID = $item->id;
						$rs = array(
							  'content' => '<img src="'.$filePath2.'" />',
							  'pic_b' => str_replace('view','big',$filePath2),
							  'pic_s' => str_replace('view','small',$filePath2),
							  'typeB_id' => $typeB_id,
							  'typeS_id' => 0
							  );
						$this->db->where('id',$itemID);
						$this->db->update('products',$rs);
						echo '----< 更新 >----';
					}
					
					print_r($rs);
				}
			}
		}
		exit;
	}
	
	
	/*----*/
	function repic(){
		
		$this->db->select('id,title');
		$this->db->from('products');
		$row = $this->db->get()->result();
		foreach($row as $rs){
			$id = $rs->id;
			$title = $rs->title;
			preg_match_all('/(\d+)X(\d+)X(\d+)/i',$title,$mh);
			if(!empty($mh[0])){
				//存入数据库
				$da['size_z'] = $mh[1][0];
				$da['size_w'] = $mh[2][0];
				$da['size_h'] = $mh[3][0];
				$this->db->where('id',$id);
				$this->db->update('products',$da);
				
				print_r($da);
			}
		}
		//print_r($row);
		exit;
	}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */