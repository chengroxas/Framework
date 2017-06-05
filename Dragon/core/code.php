<?php
session_start();
include('Vercode.class.php');
header('content-type:image/gif');
$img=new Vercode();
$str=$img->str();
$_SESSION['code']=implode($str);
?>
