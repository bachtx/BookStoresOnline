<?php
$total_rows="0";
	if(!isset($_SESSION["CUR_PAGE_PRO"]))
		$_SESSION["CUR_PAGE_PRO"]=1;
	if(isset($_POST["txtCurnpage"])){	
		$_SESSION["CUR_PAGE_PRO"]=$_POST["txtCurnpage"];
	}
	$cur_page=$_SESSION["CUR_PAGE_PRO"];
?>
<div class="detail_jumlink">
	<p>Home  <span class="bg_jumlink"></span>  <?php echo "Product";?> 
		<span class="bg_jumlink"></span> <?php echo "Book 1$";?></p>
</div><!--detail_jumlink-->
<div class="main_wrap">
	<div class="sidebar">
		<h3>Categories</h3>
		<!-- Lấy dữ liệu động từ cơ sở dữ liệu ra bên ngoài trang chính-->
		<?php
			$catalogs=new CLS_CATALOGS();
			$catalogs->getListCatalogs();
		?>
		<!--Kết thúc catalogs -->
	</div><!--sidebar-->
	<div class="primary" id = "product_page">
		<div id="tabs_products">
			<h3>Books 1$</h3>
			<div id="tabs-1">
				<!-- tir-1 -->
				<?php 
					$obj->getList(" AND `cur_price` =1 ");
					$total_rows=$obj->Num_rows();				
					if($total_rows>0){
						$max_page=ceil($total_rows/MAX_ITEM);
						if($cur_page>=$max_page){
							$cur_page=$max_page;
							$_SESSION["CUR_PAGE_PRO"]=$cur_page;
						}
						$start_r=($cur_page-1)*MAX_ITEM;
					$obj->GetListPro(" AND `cur_price` =1 ",' ORDER BY `mdate` DESC '," LIMIT $start_r,".MAX_ITEM);?>
					<div class="pagin"><?php paging_index($total_rows,MAX_ITEM,$cur_page); ?></div>
					<?php }?>
			</div>
		</div><!--.tabs_product-->
	</div><!--.primary-->
</div>