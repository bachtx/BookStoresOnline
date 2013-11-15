<div id="product_wapper">
<?php
$obj= new CLS_PRODUCTS();
$cata= new CLS_CATALOGS();
$COM='products';
$viewtype='';
if(isset($_GET['viewtype'])){
	$viewtype=$_GET['viewtype'];
}
if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))//http://localhost/components/com_products/tem/detail.php
	include('tem/'.$viewtype.'.php');
unset($viewtype); unset($COM);
?>
</div>