<?php
class CLS_CONTENT 
{
	private $pro= array(
			'con_id' => "",
			'code' => "",
			'cat_id' => "",
			'title' => "",
			'intro' => "",
			'fulltext' => "",
			'cdate' => "",
			'author' => "",
			'thumb' => "",
			'isactive' => "",
	);
	 
	
	public  $objmysql;
	public function CLS_CONTENT(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($postsname,$value){
		if(!isset($this->pro[$postsname])){
			echo ($postsname.' is not member of CLS_CONTENT Class' );
			return;
		}
		$this->pro[$postsname]=$value;
	}
	public function __get($postsname){
		if(!isset($this->pro[$postsname])){
			echo ($postsname.' is not member of CLS_CONTENT Class' );
			return '';
		}
		return $this->pro[$postsname];
	}
	function getList($strwhere=""){
		$sql=" SELECT * FROM tbl_content $strwhere";
		return $this->objmysql->Query($sql);
	}
	
	function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getCatName($catid) {
		$sql="SELECT name FROM tbl_category WHERE id=$catid";
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
		$sql="	SELECT * FROM tbl_content $strwhere ORDER BY `title` DESC, con_id LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
		$ids=$rows['con_id'];
		$code=Substring(stripslashes($rows['code']),0,10);
		$title=Substring(stripslashes($rows['title']),0,10);
		//include_once("../includes/simple_html_dom.php");
		$intro = Substring(stripslashes($rows['intro']),0,10);
		//$intro = str_get_html($intro);
		$category = $this->getCatName($rows['cat_id']);
		
		echo "<tr name=\"trow\">";
		echo "<td width=\"30\" align=\"center\">$i</td>";
		echo "<td width=\"30\" align=\"center\"><label>";
				echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
				echo "</label></td>";
						echo "<td align='center'>$title</td>";
						echo "<td align='center'><img src='".$rows['thumb']."' alt='".$rows['code']."' width='100' /></td>";
						echo "<td align='center'>$category</td>";
						echo "<td align='center'>$intro</td>";
						echo "<td align='center'>".$rows['author']."</td>";
						echo "<td  align='center'>".$rows['cdate']."</td>";
			
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
		$sql="INSERT INTO tbl_content (`code`,`cat_id`,`title`,`intro`,`fulltext`,`cdate`,`author`,`thumb`,`isactive`) VALUES ";
		$sql.="('".$this->code."','".$this->cat_id."','".$this->title."','".$this->intro."','".$this->fulltext."','".$this->cdate."','";
		$sql.=$this->author."','";
		$sql.=$this->thumb."','";
		$sql.=$this->isactive."')";
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql="UPDATE tbl_content SET `code`='".$this->code."',
									 `title`='".$this->title."',
									 `intro`='".$this->intro."',
									 `fulltext`='".$this->fulltext."',
									 `cat_id`='".$this->cat_id."',
									 `thumb`='".$this->thumb."',
									 `cdate`='".$this->cdate."',
									 `author`='".$this->author."',
									 `isactive`='".$this->isactive."'
								WHERE `con_id`='".$this->con_id."'";
		//echo $sql;die();
		
		return $this->objmysql->Exec($sql);
	}
	function Delete($ids){
		$sql="DELETE FROM `tbl_content` WHERE `con_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}

	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_content` SET `isactive`='$status' WHERE `con_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_content` SET `isactive`=if(`isactive`=1,0,1) WHERE `con_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	}
