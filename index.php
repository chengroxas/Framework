<?php

//框架路径	
define('BASEPATH','/var/www/html/kuanjia/Dragon/');

//项目目录结构路径	
define('APPPATH',		dirname(__FILE__).'/App/');//App
define('DR_CONFPATH',	APPPATH.'Conf/');//配置
define('DR_ACTIONPATH',	APPPATH.'Action/');//控制器
define('DR_CACHEPATH',	APPPATH.'Cache/');//缓存
define('DR_MODELPATH',	APPPATH.'Model/');//业务逻辑
define('DR_STATICPATH',	APPPATH.'Static/');//公共
define('DR_LIBPATH',	APPPATH.'Lib/');//Lib
define('DR_VIEWPATH',	APPPATH.'View/');//模板
define('DR_UPLOADSPATH',APPPATH.'Uploads/');//上传

require_once BASEPATH.'Dragon.class.php';

Dragon::start();
?>
