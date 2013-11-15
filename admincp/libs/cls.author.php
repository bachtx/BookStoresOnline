<?php
class CLS_AUTHOR{
	private $pro=array( 'ID'=>'-1',						
						'Name'=>'',
						'Desc'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_AUTHOR(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ('Can not found $proname member');
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_author` where 1=1 ".$where.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function listTableAuthor($strwhere){
		global $rowcount;
		$sql="SELECT * FROM tbl_author WHERE 1=1 ".$strwhere;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{	$rowcount++;
			$id=$rows['id'];			
			$name=Substring($rows['name'],0,5);
			$desc=Substring($rows['desc'],0,10);
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$rowcount</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td nowrap='nowrap'>$id</td>";
			echo "<td nowrap='nowrap'>$name</td>";
			echo "<td nowrap='nowrap'width='520'>$desc &nbsp;</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
				showIconFun('edit','');
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		  	echo "</tr>";			
		}
	}
	function getListAuthor(){
		$sql="SELECT * FROM tbl_author WHERE `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{
			$id=$rows['id'];
			$name=$rows['name'];
			echo "<option value='$id'>--$name</option>";
		}
	}
	/*change -------------------------------------------------------------------------*/
	function Add_new(){
		$sql=" INSERT INTO `tbl_author`(`name`,`desc`,`isactive`) VALUES";
		$sql.="('".$this->Name."','".$this->Desc."','".$this->isActive."')";
        //echo $sql;die();
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql = "UPDATE tbl_author SET `name`=N'".$this->Name."',`desc`=N'".$this->Desc."',`isactive`='".$this->pro["isActive"]."' WHERE id='".$this->ID."'";
		echo $sql;die();
        return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_author` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_author` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_author` WHERE `id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>