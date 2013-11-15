<?php
$obj= new CLS_PRODUCTS();
$cata= new CLS_CATALOGS();
$COM='order';
$viewtype='';
if(isset($_GET['viewtype'])){
	$viewtype=$_GET['viewtype'];
}
if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
	include('tem/'.$viewtype.'.php');
unset($viewtype); unset($COM);
?>