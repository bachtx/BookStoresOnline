<?php
class CLS_CONTENTS{
	private $objmysql=null;
	public function CLS_CONTENTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=' ',$order=' ORDER BY RAND() ',$limit=' '){
		$sql="SELECT * FROM `tbl_content` WHERE isactive=1 ".$where.$order.$limit;	
		return $this->objmysql->Query($sql);
	}   
	public function getBlock($id,$limit=' '){
		$sql="SELECT * FROM `tbl_content` WHERE isactive=1 AND cat_id=".$id.$limit;	
		$this->objmysql->Query($sql);
		while($row=$this->Fetch_Assoc()){
			echo "<div class='detail'>";
				echo "<div class='photo'>";
					$img = stripslashes($row["thumb"]);
					$imgtag='<img src="'.$img.'" class="img_block" width="90" height="80"/>';
					echo $imgtag;
				echo "</div>";
				echo "<div class='info'>";
					echo "<h2><a href='".ROOTHOST.$row['title']."-bv".$id.".html'>".$row['title']."</a></h2>";
					echo "<p>Author: ".$row['author']."</p>";
					echo "<p>Published on: ".date("d - m - Y",strtotime($row['cdate']))."</p>";
				echo "</div >";
				echo "<div class='summary'>".$row['intro']."</div>";
			echo "</div>";
		}
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getNameCat($cat){
		$sql="SELECT * FROM tbl_category WHERE id=$cat";
		$this->objmysql->Query($sql);
		$row=$this->objmysql->Fetch_Assoc();
		return $row['name'];
	}
	public function getDescCat($cat){
		$sql="SELECT * FROM tbl_category WHERE id=$cat";
		$this->objmysql->Query($sql);
		$row=$this->objmysql->Fetch_Assoc();
		return $row['desc'];
	}
	public function getTotalCat($i){
		$sql="SELECT * FROM tbl_content WHERE cat_id=$i";
		$query = $this->objmysql->Query($sql);
		$count = $this->objmysql->Num_rows($query);
		return $count;
	}
}
?>