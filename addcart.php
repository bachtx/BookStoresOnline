<?php
session_start();
if(isset($_POST['proid'])){
	$proid='';
	$proid=$_POST['proid'];
	if(!isset($_SESSION['CART'])){
		if (!isset($_COOKIE['CART'])){
		$_SESSION['CART']=array();
		} else {$_SESSION['CART']=unserialize($_COOKIE['CART']);}
	}
	if(!check_exit($proid)){
		$item=array('proid'=>$proid,'quan'=>1);
		$_SESSION['CART'][count($_SESSION['CART'])]=$item;
		setcookie('CART',serialize($_SESSION['CART']),time()+3600);
	}
	else{
		$n=count($_SESSION['CART']);
		for($i=0;$i<$n;$i++){
			$item=$_SESSION['CART'][$i];
			if($item['proid']==$proid){
				$quan=$_SESSION['CART'][$i]['quan']+1;
				$_SESSION['CART'][$i]['quan']=$quan;
				setcookie('CART',serialize($_SESSION['CART']),time()+3600);
			}			
		}
	}
}
function check_exit($procode){
	if(!isset($_SESSION['CART'])) {
		if (!isset($_COOKIE['CART'])){
			return false;
			} else {$_SESSION['CART']=unserialize($_COOKIE['CART']);}
		}
	$n=count($_SESSION['CART']);
	for($i=0;$i<$n;$i++){
		$item=$_SESSION['CART'][$i];
		if($item['proid']==$procode)
			return true;
	}
	return false;
}
function deleteCookie(){
    setcookie("CART",NULL,time()-3600);
}
?>