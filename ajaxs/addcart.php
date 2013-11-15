<?php
session_start();
if(isset($_POST['proid'])){
	$proid='';
	$proid=$_POST['proid'];
	if(!isset($_SESSION['CART'])){
		$_SESSION['CART']=array();
	}
	if(!check_exit($proid)){
		$item=array('proid'=>$proid,'quan'=>1);
		$_SESSION['CART'][count($_SESSION['CART'])]=$item;
	}
	else{
		$n=count($_SESSION['CART']);
		for($i=0;$i<$n;$i++){
			$item=$_SESSION['CART'][$i];
			if($item['proid']==$proid){
				$quan=$_SESSION['CART'][$i]['quan']+1;
				$_SESSION['CART'][$i]['quan']=$quan;
			}			
		}
	}
}
function check_exit($procode){
	if(!isset($_SESSION['CART'])) return false;
	$n=count($_SESSION['CART']);
	for($i=0;$i<$n;$i++){
		$item=$_SESSION['CART'][$i];
		if($item['proid']==$procode)
			return true;
	}
	return false;
}
for($i=0;$i<count($_SESSION['CART']);$i++){
	$_COOKIE['CART'][$i]=$_SESSION['CART'][$i];
}
print_r($_COOKIE['CART']);
echo count($_COOKIE['CART']);
?>