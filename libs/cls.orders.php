<?php
class CLS_ORDER{
	private $pro=array(	'Id'=>'0',
						'Cdate'=>'',
						'Cname'=>'',
						'Cphone'=>'',
						'Cemail'=>'',
						'ShipType'=>'',
						'Add'=>'',
						'Payment'=>'',
						'TotalMoney'=>'0',
						'Status'=>'0'
					);
	private $objmysql=null;
	public function CLS_ORDER(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in set method of class';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in get method of class';
			return;
		}
		return $this->pro[$proname];
	}
	public function Add_new(){
		$sql="INSERT INTO `tbl_order`(`cdate`,`cname`,`cphone`,`cemail`,`shiptype`,`add`,`payment`,`totalmoney`,`status`) VALUES (
		'".$this->Cdate."','".$this->Cname."','".$this->Cphone."','".$this->Cemail."','".$this->ShipType."','".$this->Add."','".$this->Payment."','".$this->TotalMoney."','".$this->Status."')";
		$this->objmysql->Exec('BEGIN');
		//echo $sql;die();
		$result=$this->objmysql->Exec($sql);
		$order_id=$this->objmysql->LastInsertID();
		$sql="INSERT INTO `tbl_order_detail`(`order_id`,`pro_id`,`quantity`,`price`) VALUES ";
		$n=count($_SESSION['CART']);
		$objpro=new CLS_PRODUCTS;
		for($i=0;$i<$n;$i++){
			$price=$objpro->getPriceById($_SESSION['CART'][$i]['proid']);
			$sql.=" ('".$order_id."','".$_SESSION['CART'][$i]['proid']."','".$_SESSION['CART'][$i]['quan']."','".$price."') ";
			if($i<$n-1) $sql.=" , ";
		}
		//echo $sql; die();
		$result1=$this->objmysql->Exec($sql);
		
		if($result && $result1 ){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else {
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
		unset($_SESSION['CART']);
		//unset($_COOKIE['CART']);
		//setcookie("name",serialize($_SESSION['CART']),time()-3600);
		//setcookie('CART');
	}
}
?>