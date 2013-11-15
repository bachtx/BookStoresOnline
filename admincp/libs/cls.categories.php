<?php
class CLS_CATEGORIES{
	
	public $pro = array(
			"id" => "",
			"cat_id" => "0",
			"name" => "",
			"desc" => "",
			"isactive" => "1"
	);
	
	public  $objmysql=NULL;
	public function CLS_CATEGORIES()
	{
		$this->objmysql=new CLS_MYSQL;
	}

	public function __set($postsname,$value)
	{
		if(!isset($this->pro[$postsname])){
			echo ("Can not found $postsname member");
			return;
		}
		$this->pro[$postsname]=$value;
	}
	public function __get($postsname){
		if(!isset($this->pro[$postsname])){
			echo ("Can not found $postsname member");
			return;
		}
		return $this->pro[$postsname];
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_category` where 1=1 ".$where.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getListCate($cat_id=0,$level=0){
		$sql="SELECT id,cat_id,name FROM tbl_category WHERE `cat_id`='$cat_id' AND `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level!=0)
		{
			$char.="&nbsp;&nbsp;&nbsp;";
				$char.="|---";
		}
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc())
		{
			$id=$rows['id'];
			$cat_id=$rows['cat_id'];
			$name=$rows['name'];
			echo "<option value='$id'>$char $name</option>";
			$nextlevel=$level+1;
			$this->getListCate($id,$nextlevel);
		}
	}
	function ListCategory($minus_id=0,$cur_cat_id=0,$cat_id=0,$level=0){
		$childID='';
		if($minus_id!=0)
			$childID = $this->getChildID($minus_id);
		$sql="SELECT id,cat_id,name, isactive FROM tbl_category WHERE `cat_id`='$cat_id' AND id NOT IN ('".$childID."')"; 
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level>1){
			for($i=0;$i<$level;$i++)
				$char.="&nbsp;&nbsp;&nbsp;"; 
			$char.="|---";
		}
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc()){
			$id=$rows['id'];
			$cat_id=$rows['cat_id'];
			$name=$rows['name'];
			$str='';
			if($id==$cur_cat_id) $str=" selected='selected' ";
			if($rows['isactive']==0)
				echo '<option value="'.$id.'" style="color:red"'.$str.'>'.$char." ".$name.'</option>';
			else
				echo '<option value="'.$id.'"'.$str.'>'.$char." ".$name.'</option>';
			
			$nextlevel=$level+1;
			$this->ListCategory($minus_id,$cur_cat_id,$id,$nextlevel);
		}
	}
	/*change -------------------------------------------------------------------------*/
	function getListCateSubCurrentCate($cat_id=0,$level=0,$id=0){
		$sql="SELECT * FROM tbl_category WHERE `cat_id`='$cat_id' AND `isactive`='1' AND id !='$id' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level>0)
		{
			for($i=0;$i<$level;$i++)
				$char.="&nbsp;&nbsp;&nbsp;";
				$char.="|---";
		}
		while($rows=$objdata->Fetch_Assoc())
		{
			$id=$rows["id"];
			$name=$rows["name"];
			echo "<option value='$id'>$char $name</option>";
			$nextlevel=$level+1;
			$this->getListCateSubCurrentCate($id,$nextlevel,$id);
		}
	}
	function listTableCate($strwhere="",$page=1,$cat_id=0,$level=0,$rowcount){
		global $rowcount;
		$sql="SELECT * FROM tbl_category WHERE `cat_id`='$cat_id' ".$strwhere ;
		
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$str_space="";
		if($level!=0){	
			for($i=0;$i<$level;$i++)
				$str_space.="&nbsp;&nbsp;&nbsp;"; 
			$str_space.="|---";
		}
		$i=0;
		$save = $cat_id;
		while($rows=$objdata->Fetch_Assoc())
		{	$rowcount++;
			$id=$rows['id'];
			$cat_id=$rows['cat_id'];
			$name=Substring($rows['name'],0,10);
			$desc=$rows['desc'];
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$rowcount</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td width='50' align='center'>$cat_id</td>";
			echo "<td nowrap='nowrap'>$str_space$name</td>";
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
			$nextlevel=$level+1;
			$this->listTableCate($strwhere,$page,$id,$nextlevel,$rowcount);
		}
	}
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_category`  WHERE isactive=1 AND `id` = '$id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	function getChildID($cat_id) {
		$sql = "SELECT id FROM tbl_catalog WHERE id IN ('$cat_id')"; 
		$objdata = new CLS_MYSQL; 
		$this->result = $objdata->Query($sql);
		
		$ids='';
		if($objdata->Num_rows()>0) {
			while($r = $objdata->Fetch_Assoc()) {
				$ids.=$r['id']."','";
				$ids.=$this->getChildID($r['id']);
			}
		}
		return $ids;
	}
	function Add_new(){
		$sql=" INSERT INTO `tbl_category`(`cat_id`,`name`,`desc`,`isactive`) VALUES";
		$sql.="('".$this->cat_id."','".$this->name."','".$this->desc."','".$this->isactive."')";
        //echo $sql;die();
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql = "UPDATE tbl_category SET cat_id='".$this->cat_id."',`name`=N'".$this->name."',`desc`=N'".$this->desc."',`isactive`='".$this->isactive."' WHERE id='".$this->id."'";
		//echo $sql;die();
        return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_category` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_category` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_category` WHERE `id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>