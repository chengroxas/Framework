<?php
/**
 * 验证码类
 **/
class Vercode{
	public $img;//画布
	public $imgx=90;//画布的宽
	public $imgy=30;//画布的高
	public $fontsize=20;
	public $fontfile='./App/Static/font/Garuda.ttf';
	public $str=array();//四位随机
	protected $_config=array(
		'imgx'		=>	'90',
		'imgy'		=>	'30',
		'fontsize'	=>	'20',
		'str'		=>  'abcdefghijklmnopqrstuvwxyz23456',
	);
	public function __get($name){
		return $this->_config[$name];
	}
	public function __construct(){
		$this->img=imagecreate($this->imgx,$this->imgy);
		$color=imagecolorallocate($this->img,255,255,255);//颜色,白色
		imagefill($this->img,0,0,$color);//白色的画布
	}//__construct
	/**
	 * 验证码内容
	 **/
	public function str(){
		for($i=0;$i<=9;$i++){
			$arr[]=$i;
		}
		for($i=97;$i<=122;$i++){
			$arr[]=chr($i);
		}
		for($i=65;$i<=90;$i++){
			$arr[]=chr($i);
		}
		$this->str=array($arr[rand(0,count($arr)-1)],$arr[rand(0,count($arr)-1)],$arr[rand(0,count($arr)-1)],$arr[rand(0,count($arr)-1)]);
	}//str
	public function getLength(){
		$result=imagettfbbox($this->fontsize,0,$this->fontfile,implode($this->str));
		$this->twidth=$result['4']-$result['6'];
		$this->theight=$result['1']-$result['7'];
	}
	/**
	 * 绘制杂点
	 **/ 
	private function nosie(){
		for($i=1;$i<10;$i++){
			$color=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			for($j=1;$j<40;$j++){
				imageSetPixel($this->img,rand(0,$this->imgx),rand(0,$this->imgy),$color);
			}
		}
	}
	/**
	 *绘制杂线 
	 **/
	private function line(){
		for($i=1;$i<=3;$i++){
			$color=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			for($j=1;$j<=3;$j++){
				imageline($this->img,rand(0,$this->imgx),rand(0,$this->imgy),rand(0,$this->imgx),rand(0,$this->imgy),$color);
			}
		}
	}

	public function code(){
		$this->str();
		for($i=1;$i<10;$i++){
			$color=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			for($j=1;$j<40;$j++){
				imageSetPixel($this->img,rand(0,$this->imgx),rand(0,$this->imgy),$color);
			}
		}
		for($i=1;$i<=3;$i++){
			$color=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			for($j=1;$j<=3;$j++){
				imageline($this->img,rand(0,$this->imgx),rand(0,$this->imgy),rand(0,$this->imgx),rand(0,$this->imgy),$color);
			}
		}
		for($i=0;$i<=count($this->str)-1;$i++){
			$color=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));
			$temp=($this->imgx)/(count($this->str)+1);
			$xx=$i*$temp;
			$yy=($this->imgy+$this->fontsize)/2-1;
			imagettftext($this->img,$this->fontsize,rand(-15,15),$xx,$yy,$color,$this->fontfile,$this->str[$i]);
		}
		header('content-type:image/gif');
		imagegif($this->img);
		imagedestroy($this->img);
		return implode($this->str);
	}//code
	
}//createCode


