<?php
class CLS_PRODUCTS{
	private $pro=array(
			'ID'=>'-1',
			'CatID'=>'0',
			'Code'=>'0',
			'AuthorID'=>'0',
			'Publisher'=>'',
			'Name'=>'',
			'Intro'=>'',
			'Fulltext'=>'',
			'Thumb'=>'',
			'Old_price'=>'0',
			'Cur_price'=>'0',
			'Quantity'=>'0',
			'Cdate'=>'',
			'Mdate'=>'',
			'Visit'=>'',
			'isHot'=>'0',
			'isActive'=>'1');
	private $objmysql;
	public function CLS_PRODUCTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	function getList($strwhere="",$lagid=0){
		$sql=" SELECT * FROM tbl_products $strwhere";
		return $this->objmysql->Query($sql);
	}
	function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getCatName($catid) {
		$sql="SELECT name FROM tbl_catalog WHERE cat_id=$catid";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()>0) {
			$r=$objdata->Fetch_Assoc();
			return $r['name'];
		}
	}
	function listTablePro($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="	SELECT * FROM tbl_products $strwhere ORDER BY `name` DESC, cat_id LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{	
			$star++;
			$ids=$rows['pro_id'];
			$code=Substring(stripslashes($rows['code']),0,10);
			$title=Substring(stripslashes($rows['name']),0,10);
			//include_once("../includes/simple_html_dom.php");
			$intro = Substring(stripslashes($rows['intro']),0,10);
			//$intro = str_get_html($intro);
			$old_price = number_format($rows['old_price']).' <b>$</b>';
			$cur_price = number_format($rows['cur_price']).' <b>$</b>';
			$category = $this->getCatName($rows['cat_id']);
			
			$visited=$rows['visited'];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$star</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td title='$intro'>$code</td>";
			echo "<td title='$intro'>$title</td>";
			echo "<td nowrap='nowrap' align='center'>$old_price</td>";
			echo "<td nowrap='nowrap' align='center'>$cur_price</td>";
			echo "<td align='center'>$category</td>";			
			echo "<td nowrap='nowrap' align='center'>$visited</td>";			
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=hot&amp;id=$ids\">";
			showIconFun('publish',$rows['ishot']);
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$ids\">";
			showIconFun('publish',$rows['isactive']);
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$ids\">";
			showIconFun('edit','');
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$ids')\" >";
			showIconFun('delete','');
			echo "</a>";
		
			echo "</td>";
			echo "</tr>";
		}
	}
	function Add_new(){
		$sql="INSERT INTO tbl_products (`cat_id`,`code`,`name`,`intro`,`author_id`,`publisher`,`fulltext`,`thumb`,`old_price`,`cur_price`,`quantity`,`cdate`,`mdate`,`ishot`,`isactive`) VALUES ";
		$sql.="('".$this->CatID."','".$this->Code."','".$this->Name."','".$this->Intro."','".$this->AuthorID."','".$this->Publisher."','".$this->Fulltext."','".$this->Thumb."','";
		$sql.=$this->Old_price."','".$this->Cur_price."','".$this->Quantity."','";
		$sql.=$this->Cdate."','".$this->Mdate."','";
		$sql.=$this->isHot."','".$this->isActive."')";
		//echo $sql;die();
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql="UPDATE tbl_products SET `cat_id`='".$this->CatID."',
									 `code`='".$this->Code."',
									 `name`='".$this->Name."',
									 `intro`='".$this->Intro."',
									 `fulltext`='".$this->Fulltext."',
									 `author_id`='".$this->AuthorID."',
									 `publisher`='".$this->Publisher."',
									 `thumb`='".$this->Thumb."',
									 `old_price`='".$this->Old_price."',
									 `cur_price`='".$this->Cur_price."',
									 `quantity`='".$this->Quantity."',
									 `cdate`='".$this->Cdate."',
									 `mdate`='".$this->Mdate."',
									 `ishot`='".$this->isHot."',
									 `isactive`='".$this->isActive."' 
								WHERE `pro_id`='".$this->ID."'";
								//echo $sql;die();
		return $this->objmysql->Exec($sql);
	}
	function Delete($ids){
		$sql="DELETE FROM `tbl_products` WHERE `pro_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function setHot($ids){
		$sql="UPDATE `tbl_products` SET `ishot`=if(`ishot`=1,0,1) WHERE `pro_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_products` SET `isactive`='$status' WHERE `pro_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_products` SET `isactive`=if(`isactive`=1,0,1) WHERE `pro_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
}
?>