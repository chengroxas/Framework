<?php
/**
 * 模板编译类
 * 
 * 
 **/
class View{
	public  $_data=array();
	private $_cache_file=NULL;
	private $_expire_time=3600;//过期时间
	private $_rules=array(
			'/for\s{0,}\(\s{0,}\$(\w+)\s{0,}\:\s{0,}\$\{(\w+)\}\s{0,}\)/'=>'foreach($this->_data[\'$2\'] as \$$1)',
			'/\<\?([^=])/' => '<?php ',
			'/\<\?\=/'		=>	'<?php echo ',
			'/\$\{(\w+)\}/'=>'$this->_data[\'$1\'] ',
			'/\$\{(\w+)\.(\w+)\}/'=>'$this->_data[\'$1\'][\'$2\'] ',	
			'/\$(\w+)\.(\w+)/'=>'\$$1[\'$2\'] ',
			//include common/header.html => require common/header.html
			'/include\s{0,}([\w\.\/]+)/' => 'require $this->getIncludeFile(\'$1\') '
		);//模板匹配规则		
		
	public function display($tpl,$expire_time=3600){
		$this->_expire_time=$expire_time;
		if( $this->isCache($tpl) == FALSE ){
			$this->transform($tpl);//判断缓存是否过期
		}
		ob_start();
		require_once $this->_cache_file;
		$html=ob_get_contents();
		ob_clean();
		return $html;
	}
	/**
	 * 模板编译
	 * @param $tpl 模板文件名
	 * @return 无 
	 **/
	public  function transform($tpl){
		$tpl_path=DR_VIEWPATH.$tpl;
		$html=file_get_contents($tpl_path);
		
		if( $html == FALSE){
			die('文件获取失败');
		}
		
		$html=preg_replace(array_keys($this->_rules),$this->_rules,$html);
		if( $html == FALSE){
			die('编译失败');
		}
		
		$cache_path=dirname($this->_cache_file);//上一级目录
		if( !file_exists($this->_cache_file) ){//不存在缓存文件
			@mkdir($cache_path,0777,true);//创建目录
		}
		$ret=file_put_contents($this->_cache_file,$html);//将HTML文件写入缓存文件
		if( $ret == FALSE ){
			die('写入缓存失败');
		}
	}
	/**
	 * 判断缓存文件是否有效
	 * @param $tpl 文件名
	 * @return true | false
	 **/
	public function isCache($tpl){
		$this->_cache_file=DR_CACHEPATH."tpl/{$tpl}.php";
		if($this->_expire_time==-1){
			// -1 永久有效
			return true;
		}
		if( time() - filemtime($this->_cache_file) > $this->_expire_time){
			return false;//过期
		}
		return true;
	}
	/**
	 * 获取包含文件的缓存路径
	 * @param $file 包含文件的路径
	 * @return 缓存文件的路径
	 **/
	public function getIncludeFile($file){
		
		if( $this->isCache($file) == false ){
			$this->transform($file);
		}
		return $this->_cache_file;//返回一个路径
	}
	/**
	 * 分配
	 * @param $name 分配到模板中的变量名
	 * @param $value 控制器中变量
	 * @return 无
	 **/
	public function assign($name,$value){
		$this->_data[$name]=$value;
	}
}

?>
