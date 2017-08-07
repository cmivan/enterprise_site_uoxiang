<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_into_pic_2 extends HT_Controller {
	
	public $rootpath = '/public/up/uploads/20120928/'; //$rootpath = '/public/up/uploads/20120813/';
	
	function __construct()
	{
		parent::__construct();

		/*初始化加载application\core\MY_Controller.php
		这里的加载必须要在产生其他 $data 数据前加载*/
		
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->model('Products_Model');
		
	}
	
	function retype(){
		
	}
	
	function into()
	{
		$path  = $this->rootpath . 'view/';
		$pathB = $this->rootpath . 'big/';
		$pathS = $this->rootpath . 'small/';
		
		$map = directory_map('.'.$path, FALSE, FALSE);
		foreach($map as $dir => $val)
		{
			$dir = mb_convert_encoding($dir, "UTF-8", "GB2312");
			
			if(is_numeric($dir)==false){
				$rs = $this->Products_Model->get_style_by_title($dir);
			}else{
				$rs = $this->Products_Model->get_style($dir);
			}

			//获取风格ID
			if(!empty($rs))
			{
				$styles_id = $rs->type_id;

				$xxx = '.' . $path . $dir;
				$xxx = iconv("utf-8","gb2312",$xxx);
				//--------------------
				$xx2 = '.'. $path . $styles_id;
				$xx2 = iconv("utf-8","gb2312",$xx2);
				
				if(is_numeric($dir)==false)
				{
					//修改文件夹
					$this->repath($xxx,$xx2);
					
					$this->out('已将目录：' . $xxx);
					$this->out('修改成为：' . $xx2);
					$this->out('');
				}else{
					$this->out('该目录不需要修改：' . $xxx);
					$this->out('');
				}

				
			}else{
				$this->out('未找到分类目录!');exit;
			}

			
			foreach($val as $filekey => $file)
			{
				if($file!='Thumbs.db')
				{
					$da = array();
					$da['styles_id'] = $styles_id;
					
					//大类
					//---------------------------
					$filekey = iconv("GB2312","utf-8",$filekey);
					//大类ID
					$da['typeB_id'] = $this->getTypeB_Id($filekey);
					if(is_numeric( $da['typeB_id'] ) && $da['typeB_id']!=0)
					{
						$this->out('<strong>发现大类:' . $filekey . '('.$da['typeB_id'].')</strong>');
						//修改大类文件夹
						$typeBpath = '.' . $path . $dir . '/' . $filekey;
						$typeBpath = iconv("utf-8","gb2312",$typeBpath);
						$typeBpathTo = '.' . $path . $dir . '/' . $da['typeB_id'];
						$typeBpathTo = iconv("utf-8","gb2312",$typeBpathTo);
						rename("$typeBpath","$typeBpathTo");
						
						//print_r($typeBpathTo);exit;
						
						//小类
						//---------------------------
						foreach($file as $valkey => $fileval)
						{
							$valkey = iconv("GB2312","utf-8",$valkey);
							//小类ID
							$da['typeS_id'] = $this->getTypeB_Id($valkey, $da['typeB_id'] );
							$this->out('&nbsp;&nbsp;&nbsp;&nbsp;<em>小类:- ' . $valkey . '('.$da['typeS_id'].')</em>');
							
							//修改小类文件夹
							$typeSpath = $typeBpathTo . '/' . $valkey;
							$typeSpath = iconv("utf-8","gb2312",$typeSpath);
							$typeSpathTo = $typeBpathTo . '/' . $da['typeS_id'];
							$typeSpathTo = iconv("utf-8","gb2312",$typeSpathTo);
							rename("$typeSpath","$typeSpathTo");
							
							//读取具体的文件
							foreach($fileval as $itemkey => $item)
							{
								//产品名称
								$da['title'] = $itemkey;
								
								//产品列表
								$da['content'] = '';
								if(!empty($item)&&is_array($item))
								{
									//具体到图片
									foreach($item as $filevalkey => $filename)
									{
										if($filename!='Thumbs.db')
										{
											$filePath = $typeSpathTo . '/' . $itemkey . '/' . $filename;
											$filePath = str_replace('./','/',$filePath);
											$da['content'].= '<img src="'.$filePath.'" /><br>';
											
											//$filePath2 = $typeSpathTo . '/' . md5($filename) . '.jpg';
											//rename("$filePath","$filePath2");
											//--------------------
											//$filePath  = $typeSpathTo . '/' . $filename;
											//$filePath2 = $typeSpathTo . '/' . md5($filename) . '.jpg';
											//rename("$filePath","$filePath2");
											//--------------------
											//$filePath  = $typeSpathTo . '/' . $filename;
											//$filePath2 = $typeSpathTo . '/' . md5($filename) . '.jpg';
											//rename("$filePath","$filePath2");
						
											//$filePath  = $typeSpathTo . $filename;
											//$filePath2 = $typeSpathTo . md5($filename) . '.jpg';
											//$file = mb_convert_encoding($file, "UTF-8", "GB2312");
											//$title = $file;
											
											$da['filePath']	= $filePath;
											//exit;
								
											//-------------------------------		
											//$title = str_replace('副本','',$title);
											//$title = str_replace('.jpg','',$title);
											//$title = str_replace('.','',$title);
											//$title = str_replace(' 拷贝','',$title);
											
												
										}
									}
									
									$this->insertProduct($da);
								}

								//print_r($da);
								//exit;
							}
							
						}
					}
				}
			}
		}
		exit;
	}
	
	
	
	
	
	
	

	
	function into_screen()
	{
		$path = '/public/up/uploads/20120929/';
		$map = directory_map('.'.$path, FALSE, FALSE);
		if(!empty($map))
		{
			foreach($map as $dir => $val)
			{
				$dir = mb_convert_encoding($dir, "UTF-8", "GB2312");
				$da = array();
				$da['title'] = '朴风堂产品实景-' . $dir;
				$da['filePath'] = $path . $dir . '/small.jpg';
				$da['content'] = '';
				rename('.'.$path . $dir . '/small.JPG','.'.$path . $dir . '/small.jpg');
	
				foreach($val['view'] as $filekey => $file)
				{
					if($file!='Thumbs.db')
					{
						$fileImg = $path . $dir . '/view/' . $file;
						$da['content'].= '<img src="'.$fileImg.'" /><br/>';
					}
				}
				$this->insertScreen($da);
			}
		}
		else
		{
			$this->out('该目录没有找到数据!');
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
	

	
	
	//录入产品
	function insertProduct($data='')
	{
		if(!empty($data))
		{
			$typeB_id  = $data['typeB_id'];
			$typeS_id  = $data['typeS_id'];
			$styles_id = $data['styles_id'];
			$title     = $data['title'];
			$content   = $data['content'];
			$filePath  = $data['filePath'];
			
			$this->db->select('id,title');
			$this->db->from('products');
			$this->db->where('typeB_id',$typeB_id);
			$this->db->where('typeS_id',$typeS_id);
			$this->db->where('styles_id',$styles_id);
			$this->db->where('title',$title);
			$this->db->limit(1);
			$item = $this->db->get()->row();
			if(empty($item))
			{
				$rs = array(
				  'title' => $title,
				  'pro_no' => '',
				  'size_z' => 0,
				  'size_w' => 0,
				  'size_h' => 0,
				  'price' => 0,
				  'price_vip' => 0,
				  'note' => $title,
				  'content' => $content,
				  'pic_b' => str_replace('view','big',$filePath),
				  'pic_s' => str_replace('view','small',$filePath),
				  'typeB_id' => $typeB_id,
				  'typeS_id' => $typeS_id,
				  'styles_id'=> $styles_id,
				  'add_ip' => ip(),
				  'hits' => 0,
				  'order_id' => 0
				);
				$this->db->insert('products',$rs);
				$this->out('----< 添加 >----');
			}else{
				$itemID = $item->id;
				$rs = array(
					  'content' => $content,
					  'pic_b' => str_replace('view','big',$filePath),
					  'pic_s' => str_replace('view','small',$filePath),
					  'typeB_id' => $typeB_id,
					  'typeS_id' => $typeS_id,
					  'styles_id'=> $styles_id
					  );
				$this->db->where('id',$itemID);
				$this->db->update('products',$rs);
				$this->out('----< 更新 >----');
			}
			//print_r($rs);
			$this->out('<hr>');
		}else{
			$this->out('数据不符合~~~');
		}
	}
	
	
	
	
	//录入场景
	function insertScreen($data='')
	{
		if(!empty($data))
		{
			$typeB_id = 0;
			$typeS_id = 0;
			
			$title    = $data['title'];
			$content  = $data['content'];
			$filePath = $data['filePath'];
			
			$this->db->select('id,title');
			$this->db->from('products_real');
			$this->db->where('typeB_id',$typeB_id);
			$this->db->where('typeS_id',$typeS_id);
			$this->db->where('title',$title);
			$this->db->limit(1);
			$item = $this->db->get()->row();
			if(empty($item))
			{
				$rs = array(
				  'title' => $title,
				  'note' => '',
				  'content' => $content,
				  'pic_b' => str_replace('view','big',$filePath),
				  'pic_s' => str_replace('view','small',$filePath),
				  'typeB_id' => 0,
				  'typeS_id' => 0,
				  'add_time' => dateTime(),
				  'add_ip' => ip(),
				  'hits' => 0,
				  'order_id' => 0,
				  'new' => 0,
				  'ok' => 0,
				  'hot' => 0
				);
				
				$this->db->insert('products_real',$rs);
				$this->out('----< 添加 >----');
			}else{
				$itemID = $item->id;
				$rs = array(
					  'content' => $content,
					  'note' => '',
					  'pic_b' => str_replace('view','big',$filePath),
					  'pic_s' => str_replace('view','small',$filePath),
					  'typeB_id' => 0,
					  'typeS_id' => 0
					  );
				$this->db->where('id',$itemID);
				$this->db->update('products_real',$rs);
				$this->out('----< 更新 >----');
			}
			//print_r($rs);
			$this->out('<hr>');
		}else{
			$this->out('数据不符合~~~');
		}
	}
	
	
	
	
	
	//修改目录
	function repath($path='',$path2='')
	{
		rename("$path","$path2");
		//--------------------
		$pathS = str_replace('view','small',$path);
		$pathS2 = str_replace('view','small',$path2);
		rename("$pathS","$pathS2");
		//--------------------
		$pathB = str_replace('view','big',$path);
		$pathB2 = str_replace('view','big',$path2);
		rename("$pathB","$pathB2");
	}
	
	
	//输出
	function out($str='')
	{
		echo $str . '<br/>';
	}
	
	
	//产品一级分类
	function getTypeB_Id($title='',$ids=0)
	{
		$type_id = 0;
		if(is_numeric($title)&&$title!=''&&$title!=0)
		{
			return $title;
		}else{
			$rs = $this->Products_Model->get_type_by_title($title,$ids);
			if(empty($rs))
			{
				$this->db->set('type_ids',$ids);
				$this->db->set('type_title',$title);
				$this->db->insert('products_type');
			}else{
				$type_id = $rs->type_id;
			}
			return $type_id;
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */