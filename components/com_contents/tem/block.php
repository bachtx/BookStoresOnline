<?php 
include('libs/cls.contents.php');
if(isset($_GET['id'])){
	$id=$_GET['id'];
} else {
	$id=0;
}
?>
<div class="main_wrap">
	<div class="sidebar">
		<h3>Categories</h3>
		<?php
			$catalogs=new CLS_CATALOGS();
			$catalogs->getListCatalogs();
		?>
	</div><!--sidebar-->
	<div class="primary" id = "product_page">
		<?php 
		$objcontents = new CLS_CONTENTS;
		if ($id!=0){
		?>
		<div id="content_page">		
		<?php
			echo "<h1><a href='index.php?com=contents&&viewtype=block&id=".$id."'>".$objcontents-> getNameCat($id)."</a></h1>";
			echo "<p class='intro'>".$objcontents-> getDescCat($id)."</p>";
			$limit='';
			$objcontents -> getBlock ($id,$limit);
		?>
		</div>
		<?php
		} else {
			for($i=1;$i<=3;$i++){
		?>
		<div id="content_page">
		<?php
			echo "<h1><a href='index.php?com=contents&&viewtype=block&id=".$i."'>".$objcontents-> getNameCat($i)."</a></h1>";
			echo "<p class='intro'>".$objcontents-> getDescCat($i)."</p>";
			$limit=' LIMIT 0,2';
			$objcontents -> getBlock ($i,$limit);
			echo "<div class='link'><p><a href='index.php?com=contents&&viewtype=block&id=".$i."'>See more</a></p><br/></div>";
			echo "</div>";
			}
		}
		?>
	</div>
</div>
<style>
#content_page{width:100%;border:none;}
.detail{border:1px solid #dedede; width:360px; height:180px; float:left; margin-left:15px; margin-top:10px;}
.photo{float:left; width: 90px;margin-left:8px;}
.info{float:right; width:260px;}
.link{clear:both;}
.summary{clear:both;width:320px;margin-left:auto;margin-right:auto;text-align:justify}
.link {float:right; margin-right:30px;}
.link p{font-size:18px;color:#7e7e7e;}
#content_page p{text-align:center;color:#7e7e7e;}
#content_page p.intro{ font-size:15px;}
#content_page h1,h2{text-align:center;}
</style>