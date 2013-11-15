<div class="detail_jumlink">
	<p>Home  <span class="bg_jumlink"></span>  <?php echo 'Search';?> </p>
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
	<?php
	if(isset($_POST['search']) && $_POST['txtsearch']!=''){
		$keyword=$_POST['txtsearch'];
	?>
	<div class="primary" id = "product_page">
		<div id="tabs_products">
			<h3><?php echo 'Search Books';?></h3>
			<div id="tabs-1">
				<!-- tir-1 -->
				<?php 					
					$obj->GetListPro(" AND `name` LIKE '%".$keyword."%' ",''," "); 
				?>
			</div>
		</div><!--.tabs_product-->
	</div><!--.primary-->
	<?php }
	else{
		echo 'Zero Products my search or you insert name products !';
	}
	?>
</div><!--.main_wrapp-->
