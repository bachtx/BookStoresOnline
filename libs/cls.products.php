<?php
class CLS_PRODUCTS{
	private $objmysql=null;
	public function CLS_PRODUCTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=' ',$order=' ORDER BY RAND() ',$limit=' '){
		$sql="SELECT * FROM `tbl_products` WHERE isactive=1 ".$where.$order.$limit;	
		return $this->objmysql->Query($sql);
	}
    public function getOne($where=''){
		$sql="SELECT * FROM `tbl_products` WHERE isactive=1 ".$where;
		return $this->objmysql->Query($sql);
	}
	public function getPriceById($Pro_id){
		$sql="SELECT `cur_price` FROM `tbl_products` WHERE pro_id=$Pro_id ";
		$this->objmysql->Query($sql);
		$row=$this->objmysql->Fetch_Assoc();
		return $row['cur_price'];
	}
	public function GetListPro($where=' ',$order=' ORDER BY RAND() ',$limit=' '){
		$sql="SELECT * FROM `tbl_products` WHERE isactive=1 ".$where.$order.$limit;
		//echo $sql;
		$objdata=new CLS_MYSQL();
		$objcat = new CLS_CATALOGS;
		$objdata->Query($sql);
		//$clsimage=new SimpleImage;
		if(!isset($_SESSION['ORDER_NUM'])) $_SESSION['ORDER_NUM']=array();
		while($row=$objdata->Fetch_Assoc()){
			$pro_id=$row['pro_id'];
			//$catname=$objcat->getNameById($row["cat_id"]); // url 
			$code = stripslashes($row["code"]);
			$name = $this->truncateString(stripslashes($row["name"]),25,true,'..');			
			$old_price=number_format($row["old_price"]);
			$cur_price=number_format($row["cur_price"]);
			$cur_price=($cur_price==0)?'Call ':$cur_price."";
			$persen="0";
			if($cur_price!=0 && $old_price!=0)
				$persen=ceil(($row["old_price"]-$row["cur_price"])/$row["old_price"]*100);
			$img = stripslashes($row["thumb"]);
			//if($img=='')
				//$img=$clsimage->get_image(stripslashes($row["fulltext"])); // lây ảnh trong desription
			$imgtag='<img src="'.$img.'" title="'.$name.'" alt="'.$name.'" class="img_block" width="98" height="150"/>';
		?>
			<div class="div_product">
				<?php if($persen!=0)
					echo "<span class='off'>$persen%</span>";
					echo $imgtag;
				?>
				<p><a href="<?php echo ROOTHOST.$name."-".$pro_id.".html";?>" class="name_product"/><?php echo $name;?></a></p>
				<h4><?php echo $cur_price;?>$</h4>
			</div><!--.div_product-->	
		<?php
		}
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function setVisited($id){
		$sql='UPDATE tbl_products SET `visited`=`visited`+1 WHERE `pro_id`='.$id;
		return $this->objmysql->Query($sql);
	}
	public function getAuthor($author_id){
		$sql = "SELECT * FROM tbl_author WHERE `id`=$author_id";
		$objdata = new CLS_MYSQL;
		$objdata->query($sql);
		while($row = $objdata->Fetch_Assoc()){
			$name = $row['name'];
			$desc = $row['desc'];
			echo $name."<br/><br/>";
			echo $desc;
		}
	}
	function truncateString($str, $chars, $to_space, $replacement="...") {
	    if($chars > strlen($str)) return $str;
      	   $str = substr($str, 0, $chars);

	    $space_pos = strrpos($str, " ");
		   if($to_space && $space_pos >= 0) {
		       $str = substr($str, 0, strrpos($str, " "));
		   }

		   return($str . $replacement);
	}

	public function getLike($cat_id){
		$sql = "SELECT * FROM tbl_products WHERE `cat_id`=$cat_id ORDER BY RAND() LIMIT 0,7";
		$objdata = new CLS_MYSQL;
		$objdata->query($sql);
		while($row = $objdata->Fetch_Assoc()){
			$name = $this->truncateString($row['name'],20,true);	
		?>
		<div class="like_product">
			<div class="item">
				<a href="<?php echo ROOTHOST.$name."-".$row['pro_id'].".html";?>" class="img"><img src="<?php echo $row['thumb'];?>" alt="like product"/></a>
				<div>
					<h4><?php echo $name;?></h4>
					<p class="like_price"><?php echo $row['cur_price']."$";?></p>
					<a href="<?php echo ROOTHOST.$name."-".$row['pro_id'].".html";?>" class="read_more">Read more</a>
				</div>
			</div><!--.item-->
		</div><!--like_product-->
		<?php	
		}
	}
	public function getComment($pro_id){
		$sql = "SELECT * FROM tbl_comment WHERE `pro_id`=$pro_id ORDER BY `cdate` desc LIMIT 0,5";
		$objdata = new CLS_MYSQL;
		$objdata->query($sql);
		while($row = $objdata->Fetch_Assoc()){
			$name = $this->truncateString($row['name'],10,true);
		?>
		<div class="name">
			<div class="img">
				<img src="images/name.png" alt="name"/>
				<p><?php echo $name;?></p>
			</div><!--.img-->

			<p class="review">
				<?php echo $row['fulltext'];?>
			</p>
		</div><!--.name-->
		<?php	
		}
	}
	public function insertComment($pro_id){
		if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$content = $_POST['content'];
		$email = $_POST['email'];
		$link = $_POST['link'];
		$sql = "INSERT INTO tbl_comment(`name`,`fulltext`,`pro_id`,`cDate`,`email`)
		   VALUES('$name','$content','$pro_id',NOW(),'$email') ";
		//echo $sql;
		$objdata = new CLS_MYSQL;
		$objdata->query($sql);
		echo $link;
	    header("location: index.php");
		}
	}
	public function GetBookRef($where=' ',$order=' ORDER BY RAND() ',$limit=' '){
		$sql="SELECT * FROM `tbl_products` WHERE isactive=1 ".$where.$order.$limit;	
		$objdata=new CLS_MYSQL();
		$objcat = new CLS_CATALOGS;
		$objdata->Query($sql);
		//$clsimage=new SimpleImage;
		if(!isset($_SESSION['ORDER_NUM'])) $_SESSION['ORDER_NUM']=array();
		while($row=$objdata->Fetch_Assoc()){
			$pro_id=$row['pro_id'];
			//$catname=$objcat->getNameById($row["cat_id"]); // url 
			$code = stripslashes($row["code"]);
			$name = $this->truncateString(stripslashes($row["name"]),25,true);			
			$old_price=number_format($row["old_price"]);
			$cur_price=number_format($row["cur_price"]);
			$cur_price=($cur_price==0)?'Call ':$cur_price."";
			$persen="0";
			if($cur_price!=0 && $old_price!=0)
				$persen=ceil(($row["old_price"]-$row["cur_price"])/$row["old_price"]*100);
			$img = stripslashes($row["thumb"]);
			//if($img=='')
				//$img=$clsimage->get_image(stripslashes($row["fulltext"])); // lây ảnh trong desription
			$imgtag='<img src="'.$img.'" title="'.$name.'" alt="'.$name.'" class="img_block" width="98" height="150"/>';
		?>
			<div class="bookRef">
				<?php if($persen!=0)
					echo "<span class=\"off\">$persen%</span>";
					echo $imgtag;
				?>
				<p><a href="<?php echo ROOTHOST.$name."-".$pro_id.".html";?>"
				 class="name_product"/><?php echo $name;?></a></p>
				<h4><?php echo $cur_price;?> $</h4>
			</div><!--bookRef-->	
		<?php
		}
	}
	public function getPrice($pro_id){
		$sql = "SELECT * FROM tbl_products WHERE `pro_id`=$pro_id";
		$objdata = new CLS_MYSQL();
		$objdata->query($sql);
		$row = $objdata->Fetch_Assoc();
		if($row['old_price']!=0){
			echo "Was ".$row['old_price']."$ Save ";
			$co = ceil((100-(($row['cur_price']/$row['old_price'])*100)));
			echo $co."%.";
		}
	}
}
?>