<?php
/**
 * 分页类
 * @author tangpan
 * @email tangpan0410@sina.com
 * @date 2016-09-02 
 **/
class Page {
	
	private $_total = 0;
	private $_pagesize = 0;
	private $_pageno = 1;

	public function __construct( $total, $pagesize = 10 )
	{
		$this->_total = $total;
		$this->_pagesize = $pagesize;
	}
	
	public function getOffset()
	{
		$offset = ($this->_pageno - 1) * $this->_pagesize;
		if ( $offset < 0 ) $offset = 0;
		return $offset;
	}

	public function show( $_str = '', $left = 2, $right = 2 )
	{
		$pagenoParam = "pageno";
		if ( ! isset( $_GET["{$pagenoParam}"] ) )
		{
			$this->_pageno = 1;
		}
		else
		{
			$this->_pageno = $_GET["{$pagenoParam}"];
		}

		$link = $_SERVER['REQUEST_URI'];
		$args = explode('?', $link);
		$link = $args[0].'?';
		
		if ( isset($args[1]) )
		{
			//排除已有的相同参数
			if ( $_str != '' )
			{
				$tmp_str = explode('&', $_str);
				$temp = '';

				foreach( $tmp_str as $s )
				{
					$tmp_s = explode('=', $s);
					$t = $tmp_s[0].'=';
					if ( strstr( $args[1], $t ) == false )
					{
						$temp .= "&".$s;
					}
					else
					{
						$val = $_GET["$tmp_s[0]"];
						$str2 = $t;
						if ( isset( $tmp_s[1] ) )
						{
							$str2 .= $tmp_s[1];
						}
						$args[1] = str_replace("{$tmp_s[0]}={$val}","{$str2}", $args[1]);
					}
				}
				$args[1] .= $temp;
			}
			$tmp = explode('&', $args[1]);
			$tmp_args = array();
			foreach( $tmp as $a )
			{
				if ( strstr($a, "{$pagenoParam}=") == false )
				{
					$tmp_args[] = $a;
				}
			}
			$tmp_args[] = "pageno=";
			$link .= implode('&', $tmp_args);
		}
		else
		{
			if ( $_str != '' )
			{
				$link .= $_str.'&';
			}
			$link .= "{$pagenoParam}=";
		} 	
		//总页数
		$pages = ceil( $this->_total / $this->_pagesize);
		
		$html = '<div class="ui-page-box">';
		$html .= '<a class="ui-page-total">总记录： '.$this->_total.'</a>';
		$html .= '<a class="ui-page-info">'.$this->_pageno.'/'.$pages.'</a>';
		if ( $this->_pageno > 1 )
		{
			$html .= '<a href="'.$link.'1" class="ui-page-first ui-page-able">首页</a>';
			$html .= '<a href="'.$link.($this->_pageno-1).'" class="ui-page-prev ui-page-able">上一页</a>';
		}
		else
		{
			$html .= '<a class="ui-page-first">首页</a>';
			$html .= '<a class="ui-page-prev">上一页</a>';
		}
		
		$start = $this->_pageno - $left;
		if ( $start <= 0 )	$start = 1;
		
		//当前页之前的快捷页码
		for ( $i = $start; $i < $this->_pageno; $i++ )
		{
			$html .= '<a href="'.$link.$i.'" class="ui-page-able">'.$i.'</a>';
		}
		
		$html .= '<a class="ui-page-now">'.$this->_pageno.'</a>';

		$end = $this->_pageno + $right;
		if ( $end > $pages ) $end = $pages;
		//当前页之后的快捷页码
		for ( $i = $this->_pageno + 1; $i <= $end; $i++ )
		{
			$html .= '<a href="'.$link.$i.'" class="ui-page-able">'.$i.'</a>';
		}

		if ( $this->_pageno < $pages )
		{
			$html .= '<a href="'.$link.($this->_pageno+1).'" class="ui-page-next ui-page-able">下一页</a>';
			$html .= '<a href="'.$link.($pages).'" class="ui-page-last ui-page-able">尾页</a>';
		}
		else
		{
			$html .= '<a class="ui-page-next">下一页</a>';
			$html .= '<a class="ui-page-last">尾页</a>';
		}
		$html .= '</div>';

		return $html;
	}
}
/*include 'Mysql.class.php';
//$db = Mysql::getInstance();
//$total = $db->count('student','1=1');
$pagesize = 2;
$total = 20;
$page = new Page($total, $pagesize);
$html = $page->show("typeid=2&uid=5",2, 2);
$limit = $page->getOffset();
var_dump($limit);
//select * from table where 1=1 order by id desc limit 0, 10
//$ret = $db->getList('student', "1=1 limit {$limit},{$pagesize}");
?>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
<style>
.ui-page-box {overflow: hidden;zoom: 1;font-size: 12px;}
.ui-page-box a {
    float: left;
    height: 28px;
    line-height: 28px;
    padding: 0px 8px;
    border: 1px solid #E5E5E5;
    border-right: none;
    color: #999;
    text-decoration: none;
    background-color: #EFEFEF;
}

.ui-page-box .ui-page-total {
    background-color: #FFF;
}
.ui-page-box .ui-page-info {
    background-color: #FFF;
}
.ui-page-box .ui-page-able {
    color: #2953A6;
    background-color: #FFF;
}
.ui-page-box .ui-page-last {
    border-right: 1px solid #E5E5E5;
    margin-right: 10px;
}
</style>
</head>
<body>
	<div style="padding-top: 100px;padding-left: 100px;">
		<?=$html?>	
	</div>
</body>
</html>	*/
