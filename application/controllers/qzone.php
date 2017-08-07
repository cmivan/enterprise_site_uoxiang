<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
自动导入QQ (专用)
*/

class Qzone extends QT_Controller {
	
	
	public $qq = array();
	public $dataQQ = array();
	//主题字体
	public $fontfile= "./public/qzone/fonts/msyh.ttf";
	//默认主题形象
	public $unQQimg = "./public/qzone/images/love.jpg";
	//主题背景
	public $bgQQimg = "./public/qzone/images/love2.jpg";
	//头像保存目录
	public $facePath= "./public/qzone/face/";

	function __construct()
	{
		parent::__construct();
	}
	
	//页面跳转
	function redirect($url='')
	{
		header('Location: '.$url);exit();
	}

	function index()
	{
		//******************************
		//*** 获取QQ的相关信息
		//******************************
		$qq = $this->getQQ();
		if($qq==0)
		{
			$this->redirect($this->unQQimg);
		}

		//QQ名称
		$name = $this->getQQNick($qq);
		//信息位置
		$ip = ip();
		$place = convertip($ip);
		//$place = mb_convert_encoding($place, "UTF-8", "UTF-8"); 
		//在线状态
		$state = true;
		//$state = $this->getQQState($qq);
		
		$this->qq = array(
			'qq'=>$qq,
			'name'=>$name,
			'ip'=>$ip,
			'place'=>$place
			);
		$this->dataQQ = $this->qq;
		//录入或更新数据,同时读取记录中的前36位用户
		
		//拼图显示的名称
		$this->qq['state'] = $state;
		$this->qq['showQQName'] = $this->showQQName($qq,$name);
			
		$this->showHeart($this->qq);	
		//$this->showText($this->qq);
	}
	
	
	
	
	//绘制心型
	function showHeart($qq='')
	{
		//{创建图像}
		$im = imagecreatefromjpeg( $this->bgQQimg );
		
		//{定义并打印元素}
		//白
		$pink  = ImageColorAllocate($im, 255 , 255 ,255);
		//红
		$red   = ImageColorAllocate($im, 255 , 0 ,0);
		//黄
		$yellow= ImageColorAllocate($im, 241 , 209 ,35);

		//打印主LOGO
		$logo = $this->getFace($qq['qq']);
		imagecopy( $im, $logo, 126, 80, 0, 0, 50, 50 );
		ImageDestroy($logo);
		
		
		$QQLists = $this->getQQLists($qq['qq']);
		
		//返回前36个QQ
		$qqnum = 0;
		$qqlist = array();
		foreach($QQLists as $qqitem){
			$qqlist[$qqnum] = $qqitem;
			$qqnum++;
		}
		//小于36个Q时，获取最后一个QQ
		$qqlast = '';
		if($qqnum>0){
			$qqlast = $qqlist[$qqnum-1];
		}
		//补充空缺的位置
		for($i=$qqnum;$i<=35;$i++){ $qqlist[$i] = $qqlast; }
		
		
		//创建心型
		$h_x = 135;
		$h_y = 40;
		$h_r = 50;
		$hsize = 25;
		for($i=0;$i<=35;$i++)
		{
			$m = $i*10;
			$n = -$h_r * (((sin($m) * sqrt(abs(cos($m))))/(sin($m) + 1.4))-2*sin($m)+2);
			$x = $n * cos($m) + $h_x;
			$y = $n * sin($m) + $h_y;
			//打印qzone头像
			$logo = $this->getFace( $qqlist[$i]->qq );;
			imagecopyresized($im, $logo, $x, $y, 0, 0, $hsize, $hsize, 50, 50); 
			ImageDestroy($logo);
		}
		
		
		
		//打印用户名
		ImageTTFText($im, 12,0,190,95,$yellow,$this->fontfile,$qq['showQQName']);
		//打印ip信息
		ImageTTFText($im, 9,0,190,125,$pink,$this->fontfile,''.$qq['place']);

		//输出图像
		$this->outImg($im);
	}
	
	function e($str=''){
		print_r($str);
	}
	
	function showText($qq='')
	{
		//创建图像
		$im = imagecreatefromjpeg($this->bgQQimg);
		
		//定义并打印元素
		
		//白
		$pink  = ImageColorAllocate($im, 255 , 255 ,255);
		//红
		$red   = ImageColorAllocate($im, 255 , 0 ,0);
		//黄
		$yellow= ImageColorAllocate($im, 241 , 209 ,35);
		
		$logo = $this->getFace($qq['qq']);
		//打印qzone头像
		imagecopy( $im, $logo, 12, 12, 0, 0, 50, 50 );
		ImageDestroy($logo);
		
		//打印用户名
		ImageTTFText($im, 14,0,72,29,$yellow,$this->fontfile,$qq['showQQName']);
		//打印ip信息
		ImageTTFText($im, 12,0,72,59,$pink,$this->fontfile,''.$qq['place']);
		//打印文章内容
		$con = $this->content($qq['name'],$qq['state']);
		$rand = rand(0,count($con)-1);
		ImageTTFText($im, 9,0,12,80,$pink,$this->fontfile,$con[$rand]);	

		//输出图像
		$this->outImg($im);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//获取QQ,从个人中心进来
	//$referer="http://user.qzone.qq.com/123456/infocenter";
	function getQQ()
	{
		$qqNum = 0;
		$referer = !empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'0';
		if($referer!='0'){
			//截取QQ
			$urlArr = explode('/',$referer);
			if(count($urlArr)>=4){ $qqNum = $urlArr[3]; }
		}
		return $qqNum;
	}
	
	
	//写入或更新指定QQ，并获取最新的36位用户
	function getQQLists($qq=0){
		$this->db->from('qzone_qq_list');
		$this->db->where('qq',$qq);
		$rs = $this->db->get()->row();
		if(!empty($rs)){
			//更新
			$this->db->where('qq',$qq);
			$this->db->update('qzone_qq_list',$this->dataQQ);
		}else{
			//录入
			$this->db->insert('qzone_qq_list',$this->dataQQ);
		}
		
		//获取最近的QQ
		$this->db->from('qzone_qq_list');
		$this->db->where('qq !=',$qq);
		$this->db->order_by('addtime','desc');
		$this->db->limit(36);
		$rs = $this->db->get()->result();
		if(!empty($rs)){
			return $rs;
		}else{
			return false;
		}
	}
	
	
	
	
	//获取头像(curl的方式比直接用imagecreatefromjpeg方式快10多倍)
	function getFace($qq = ""){ 
	    $this->load->helper('file');
		//去除URL连接上面可能的引号
		if($qq!=''){
			//先判断是否已经保存该图片
			$qqface = $this->facePath.$qq.'.jpg';
			$data = read_file($qqface);
			if($data==false)
			{
				$url = 'http://qlogo3.store.qq.com/qzone/'.$qq.'/'.$qq.'/50';
				$url = preg_replace('/(?:^[\'"]+|[\'"\/]+$)/', '', $url ); 
				$hander = curl_init(); 
				curl_setopt($hander,CURLOPT_URL,$url); 
				curl_setopt($hander,CURLOPT_HEADER,0); 
				curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1); 
				curl_setopt($hander,CURLOPT_RETURNTRANSFER,true);//以数据流的方式返回数据,当为false是直接显示出来 
				curl_setopt($hander,CURLOPT_TIMEOUT,60); 
				$data = curl_exec($hander);
				$info = curl_getinfo($hander);
				curl_close($hander);
				if($info['http_code'] != 200){ $data = NULL; }
				//保存图片到本地
				if($data){ @file_put_contents($qqface,$data); }
				
				return $this->getFace($qq);	
			}else{
				return imagecreatefromstring ($data);
			}
		}
		return false;
	} 

	
	//获取QQ状态
	function getQQState($qq=''){
		$url ='http://wpa.qq.com/pa?p=2:'.$qq.':41&r=' . time ();
		$headInfo = get_headers($url,1);
		$length = $headInfo['Content-Length'];
		if ($length==1243) {
			return true;
		}else {
			return false;
		}
	}
	
	//获取QQ昵称
	function getQQNick($qq=''){
		if ($qq!='')
		{
			$str = file_get_contents('http://r.qzone.qq.com/cgi-bin/user/cgi_personal_card?uin='.$qq);
			$pattern = '/'.preg_quote('"nickname":"','/').'(.*?)'.preg_quote('",','/').'/i';
			preg_match ( $pattern,$str, $result );
			return $result[1];
		}
	}
	
	//显示名称
	function showQQName($qq='',$name=''){
		//return '@'.$name.' ('.$qq.')';
		return $name;
	}
	
	//输出图像效果
	function outImg($imObj=''){
		header("content-type: image/gif");
		ImageGif($imObj); ImageDestroy($imObj); exit();
	}
	
	
	
	
	
	function content($name='',$state='')
	{
		/*关于友情的*/
		$hh = chr(13).chr(10);
		$space = chr(32).chr(32).chr(32).chr(32).chr(32);
		$space2 = $hh.$space;
		$stateStr = $state ? '乖孩子你没有隐身，继续保持啊':'说的就是你啦，还不赶快上线啊';
		$con[]=$space."越来越多的人习惯了隐身，我讨厌隐身的人，你隐或者不隐身，".$hh."事实就在那里，{$stateStr} ！".$space2."朋友们，我们各自在自己的城市，或悲伤，或麻木，或劳累，或心".$hh."痛。曾经有太多美好，想念那曾在一起的日子，想念那如痴如醉的回忆，".$hh."多少次梦回那时，如果可以重来，我还是会选择你们，我亲爱的朋友，".$hh."我将永远记住你们，尤其是 {$name} 。".$space2."朋友们，后来的后来，有一天我想重演一下今天的角色，你们是否".$hh."也会像现在一样陪我演一场，当一次配角呢？".$hh."这是一篇魔力日志，你会看到最熟悉的身影，愿我们的未来更加美".$hh."好！（分享或者转载给你的好友吧，顺便赞一下吧 ！^_^）";
		/*关于爱情的*/
		$stateStr = $state ? '看得见你的QQ在线，却再也看不到那熟悉的头像跳动 !':'刚打开了聊天窗口，我知道你是在隐身，还是不打扰你了。';
/*		$con[]="亲爱的 {$name}：
			  {$stateStr}
			  曾经有一份真挚的爱情放在我的面前，我没有珍惜，等到它失去的
		时候才后悔莫及。人世间最痛苦的事莫过于此。假如上天能给我一次重
		来的机会，我想对你说：我爱你。假如非要在这份爱上加一个期限，我
		希望是：一万年。
			  其实我一直很喜欢你，只是一直没有对你说过！在这里我以此图为证，
		告诉所有的好友，我真的很喜欢你，我是认真的 {$name}。
			  我下了很大的决心才写下了这些话，只是希望你能给我一个机
		会 ！如果你也爱我，给我发QQ吧，等你。。。";*/
		/*关于友情的*/
/*		$con[]="{$name},你知道吗？：
			  当你孤独时,风儿就是我的歌声，愿它能使你得到片刻的安慰；当你
		骄傲时，雨点就是我的警钟，愿它能使你获得永恒的谦逊。
			  最恨的是你，因为你是我学习上竞争的 敌人 ；最爱的也是你，因为
		你是我成长中为鉴的友人。今日一别，犹如管仲之失鲍叔牙,茫茫天涯，叫
		我到何处去寻找我最爱的“挚友”。 
			  我的生活融入了你，你的生活中也蕴涵着我；当我们再次相见的时刻，
		你我仍然是一个整体。 是缘分将我们带到一起，是友情将我们紧紧地相连。 
			  友谊是个无垠的天地，它多么宽广，你若安好，便是晴天，我们永远
		永远都是最好的朋友。";*/
		/*关于爱情的*/
/*		$con[]="{$name},你知道吗？：
			  这个飘雪的日子，想念很久很久之前的事情，那雪像是某种思
		绪，飘荡在我的世界里，我浑浑噩噩的想起了那些日子，行尸走肉般
		踩踏着那片雪地，想起来了那些你留下的痕迹，在我的世界里蜿蜒，
		去了未知的方向。
			  总想对你说一句话，却总是来不及，我还没张口，你就消失的
		无影无踪了，寻着你的痕迹，留我一个人迷失在陌生的城市里。
			  我知道我想你，有些东西错过了再挽留也没有用，就让我再为你
		狠狠的哭一次，再见了。。。";*/
		return $con;
	}
	
	

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */