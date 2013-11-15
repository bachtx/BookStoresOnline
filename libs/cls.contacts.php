<?php
class CLS_CONTACTS{
	private $contact=array(		
			'name'=>'',
			'email'=>'',
			'reason'=>'',
			'subject'=>'',
			'message'=>'');
	private $objmysql=null;
	public function sendmail(){
		include('../extensions/phpmailer/sendmail.php');
	}
/*	public function Insert(){
		$sql="INSERT into tbl_contacts (`noidung`,`name`,`sdt`) values('".$this->noidung."','".$this->name."','".$this->sdt."') ";
		echo $sql;die();
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
*/
	
}
?>