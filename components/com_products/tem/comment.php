<?php
		if(isset($_POST['submit'])){
		$pro_id = $_POST['id'];
		$name = $_POST['name'];
		$content = $_POST['content'];
		$email = $_POST['email'];
		$link = $_POST['link'];
		$sql = "INSERT INTO tbl_comment(`name`,`fulltext`,`pro_id`,`cDate`,`email`)
		   VALUES('$name','$content','$pro_id',NOW(),'$email') ";
		//echo $sql;
		$objdata = new CLS_MYSQL;
		$objdata->query($sql);
		
	   header("location:$link");
		}
	
	
?>
