<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
/*
*****************************************************************************************************
* 2013-11-15 17:08
* 微信公众平台接口封装
* 函数名 Wxapi
* author uoxiang.com CM
* date 2013-11-13 PRC:E+8 22:17
* linkme QQ394716221 uoxiang.com
*****************************************************************************************************
*/

define("TOKEN", "cmivanvtokenv20130930");

class Wxapi_lib {
	
	private $fromUsername;
	private $toUsername;
	private $CreateTime;
	private $MsgType;
	private $MsgId;
	private $CI;
	
    public function __construct()
	{
		//valid signature , option
		$this->CI = &get_instance();
	}
	
	
	
	/*-----------------------------*/
	/*---------提交开发验证----------*/
	/*-----------------------------*/
	
	public function valid()
	{
		$echoStr = $this->CI->input->get('echostr');
		//valid signature , option
		if($this->checkSignature()){
			echo $echoStr; exit;
		}
	}
	private function checkSignature()
	{
		$signature = $this->CI->input->get('signature');
        $timestamp = $this->CI->input->get('timestamp');
        $nonce = $this->CI->input->get('nonce');
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	
	
		
	//入口程序
    public function run()
	{
		$msg = $this->requestMsg();
		
		switch($this->MsgType)
		{
			case 'text':
			     $this->request_text($msg);
				 break;
			case 'image':
			     $this->request_image($msg);
				 break;
			case 'voice':
			     $this->request_voice($msg);
				 break;
			case 'video':
			     $this->request_video($msg);
				 break;
			case 'location':
			     $this->request_location($msg);
				 break;
			case 'link':
			     $this->request_link($msg);
				 break;
		}
	}
	
	

   
   
   
   
   
   
   
   
   
	/*-----------------------------*/
	/*----------执行.动作-----------*/
	/*-----------------------------*/
	
	//坦克
	private function Tank()
	{
		$arr[]=array("CM开发的坦克游戏v1.0","让童年的激情无限释放吧","http://www.uoxiang.com/webapp/tankwar_cm/package/skin/tank/bg.jpg","http://www.uoxiang.com/webapp/tankwar_cm/");
		$this->response_news($arr,array(1,0));
	}
   
   //天气
	private function Weather($n="")
	{
		//include("t_api.php");
		//$c_name=$t_api[$n];
		$json = file_get_contents("http://m.weather.com.cn/data/101110310.html");
		return json_decode($json);
	}
   
   //位置
	private function Where()
	{
		return '';
	}

   //目录
	private function Menu()
	{
		return '';
	}

   //作者
	private function Author()
	{
		$this->response_text('@uoxiang 点击关注：<a href="http://weixin.qq.com/r/xXL95ajEDvVxreyG9yfX">阿布思歌</a>');
	}

   //最新
	private function News()
	{
		$arr[]=array("优享生活范,享受真生活！","","http://www.uoxiang.com/public/banner/xml_images/05.jpg","http://www.uoxiang.com");
		$arr[]=array("直击1212年终盛典 图解报名2步走起","","http://uoxiang.com/public/up/uploads/201311//1517151.png","http://uoxiang.com/articles/view/155.html");
		$arr[]=array("致青春!一张神奇的图片！","","http://uoxiang.com/public/up/k/image/1/20130517/1_145336_2765.jpg","http://uoxiang.com/news/view/81.html");
		$this->response_news($arr,array(3,0));
	}

   //最新
	private function Home()
	{
		$arr[]=array("【官网】优享生活范,享受真生活","点击进入：网络资讯、开发技术、搞笑、糗事、生活趣事","http://www.uoxiang.com/public/banner/xml_images/05.jpg","http://www.uoxiang.com");
		$this->response_news($arr,array(1,0));
	}
	
	
	
	
	//人脸识别
	private function receiveImage($obj)
    {
        //$apicallurl = urlencode("");
		$apicallurl = "http://api2.sinaapp.com/recognize/picture/?appkey=0020120430&appsecert=fa6095e123cd28fd&reqtype=text&keyword=".$obj->PicUrl;
        $pictureJsonInfo = $this->http_get_contents($apicallurl);
        $pictureInfo = json_decode($pictureJsonInfo, true);
        $contentStr = $pictureInfo['text']['content'];
		$this->response_text($contentStr);
    }
	
	/**
	 * 获取内容,速度快
	 */
	private function http_get_contents($url = ''){ 
	    $this->CI->load->helper('file');
		//去除URL连接上面可能的引号
		if($url!=''){
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
			return $data;
		}
		return false;
	} 
   
   


   
   
 
   

	/*-----------------------------*/
	/*----------微信封装类----------*/
	/*-----------------------------*/

   
	/*
	 * 一、接收用户消息
	 × type: text 文本类型, news 图文类型
	 × text,array(内容),array(ID)
	 × news,array(array(标题,介绍,图片,超链接),...小于10条),array(条数,ID)
	 */
	public function requestMsg()
	{
		$postStr = isset($GLOBALS["HTTP_RAW_POST_DATA"])?$GLOBALS["HTTP_RAW_POST_DATA"]:'';
		if(!empty($postStr)){
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$this->fromUsername = $postObj->FromUserName;
			$this->toUsername = $postObj->ToUserName;
			$this->CreateTime = $postObj->CreateTime;
			$this->MsgType = $postObj->MsgType;
			$this->MsgId = $postObj->MsgId;
			return $postObj;
		}else{
			echo "this a file for weixin API!"; exit;
		}
	}
	
	//1 文本消息
    public function request_text($msg='')
	{
		if(!empty($msg->Content))
		{
			switch($msg->Content)
			{
				case '天气':
					 $this->Weather();
					 break;
		
				case '位置':
					 $this->Where();
					 break;
				 
				case "目录":
					 $this->Menu();
					 break;
				 
				case "最新":
					 $this->News();
					 break;
				 
				case "坦克":
				case "游戏":
					 $this->Tank();
					 break;
				 
				case "作者":
				case "开发者":
					 $this->Author();
					 break;
				 
				case "主页":
				case "首页":
				case "网页":
				case "网站":
				case "官网":
				case "网址":
				case "地址":
				case "求主页":
				case "求首页":
				case "求网页":
				case "求网站":
				case "求官网":
				case "求网址":
				case "求地址":
					 $this->Home();
					 break;
			}
		}
	}
	
	//2 图片消息
    public function request_image($msg='')
	{
		//$this->response_image($msg->MediaId);  //直接回复图片
		//$this->response_text($msg->PicUrl);    //回复图片链接
		if(!empty($msg->PicUrl))
		{
			$this->receiveImage($msg);
		}
	}
	
	//3 语音消息
    public function request_voice($msg='')
	{
		if(!empty($msg->MediaId))
		{
			$this->response_text('亲～我听力不是很好，你还是打文字吧！');
		}
	}
	
	//4 视频消息
    public function request_video($msg='')
	{
		if(!empty($msg->MediaId))
		{
			$this->response_text('亲～这视频不错，还有其他的吗！');
		}
	}
	
	//5 地理位置消息
    public function request_location($msg='')
	{
		if(!empty($msg->Label))
		{
			$this->response_text("亲～你在".$msg->Label."忙啥？这里有好吃的吗？");
		}
	}
	
	//6 链接消息
    public function request_link($msg='')
	{
		if(!empty($msg->Title))
		{
			$this->response_text('这篇文章挺不错哦！');
		}
	}
	
	
	
	



   
	/*
	 * 二、向用户回复消息
	 × type: text 文本类型, news 图文类型
	 × text,array(内容),array(ID)
	 × news,array(array(标题,介绍,图片,超链接),...小于10条),array(条数,ID)
	 */
	//通用部分
	public function responseHeader($type='')
	{
		$da="<ToUserName><![CDATA[{$this->fromUsername}]]></ToUserName>
		     <FromUserName><![CDATA[{$this->toUsername}]]></FromUserName>
		     <CreateTime>{$this->CreateTime}</CreateTime>
		     <MsgType><![CDATA[{$type}]]></MsgType>";
		return $da;
	}
	
	public function responseEnd($da='')
	{
		return "<xml>".$da."</xml>";
	}
	
	
	//1 回复文本消息
    public function response_text($Content='')
	{
		$con = $this->responseHeader('text');
		$con.="<Content><![CDATA[{$Content}]]></Content>
		       <FuncFlag>0</FuncFlag>";  
		echo $this->responseEnd($con);
	}
	
	//2 回复图片消息
    public function response_image($media_id='')
	{
		$con = $this->responseHeader('image');
		$con.="<Image><MediaId><![CDATA[$media_id]]></MediaId>
		      <FuncFlag>0</FuncFlag></Image>";  
		echo $this->responseEnd($con);
	}
	
	//3 回复语音消息
    public function response_voice($media_id='')
	{
		$con = $this->responseHeader('voice');
		$con.="<Voice><MediaId><![CDATA[$media_id]]></MediaId>
		      <FuncFlag>0</FuncFlag></Voice>";  
		echo $this->responseEnd($con);
	}
	
	//4 回复视频消息
    public function response_video($media_id='')
	{
		$con = $this->responseHeader('video');
		$con.="<Video><MediaId><![CDATA[$media_id]]></MediaId>
		      <FuncFlag>0</FuncFlag></Video>";  
		echo $this->responseEnd($con);
	}
	
	//5 回复音乐消息
    public function response_music($title='',$desc='',$url='',$hq_url='',$media_id='')
	{
		$con = $this->responseHeader('music');
		$con.="<Music>
			  <Title><![CDATA[$title]]></Title>
			  <Description><![CDATA[$desc]]></Description>
			  <MusicUrl><![CDATA[$url]]></MusicUrl>
			  <HQMusicUrl><![CDATA[$hq_url]]></HQMusicUrl>
			  <ThumbMediaId><![CDATA[$media_id]]></ThumbMediaId>
			  </Music>
			  <FuncFlag>0</FuncFlag>";  
		echo $this->responseEnd($con);
	}
	
	//6 回复图文消息
    public function response_news($value_arr,$o_arr=array(0))
	{
		$con = $this->responseHeader('news');
		$con.="<ArticleCount>{$o_arr[0]}</ArticleCount>
		      <Articles>";
	    foreach($value_arr as $id=>$v){
		  if($id>=$o_arr[0]) break; else NULL; //判断数组数不超过设置数
		  $con.="<item>
				<Title><![CDATA[{$v[0]}]]></Title> 
				<Description><![CDATA[{$v[1]}]]></Description>
				<PicUrl><![CDATA[{$v[2]}]]></PicUrl>
				<Url><![CDATA[{$v[3]}]]></Url>
				</item>";
	    }
	    $con.="</Articles>
			  <FuncFlag>{$o_arr[1]}</FuncFlag>";
			  
		echo $this->responseEnd($con);
	}
	

	
	
	/*
	 * 三、接受事件推送
	 × type: text 文本类型, news 图文类型
	 × text,array(内容),array(ID)
	 × news,array(array(标题,介绍,图片,超链接),...小于10条),array(条数,ID)
	 */
   
   
   
   
   

	
	
	
	
	
	
	
	
		
		
		

		
}

?>