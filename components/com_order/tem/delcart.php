<?php
if(isset($_COOKIE['CART'])){$SESSION['CART'] = unserialize($_COOKIE['CART']);}
if(isset($_SESSION['CART'])):
	if(isset($_GET['proid'])){
		$n=count($_SESSION['CART']);
		$cart=array();
		for($i=0;$i<$n;$i++){
			$item=$_SESSION['CART'][$i];
			if($item['proid']!=$_GET['proid']){
				$cart[count($cart)]=$item;
			}
		}
		$_SESSION['CART']=$cart;
	}
	setcookie('CART',serialize($_SESSION['CART']),time()+3600);
endif;
?>
<script type='text/javascript'>
window.location.href="shopcart.html";
</script>