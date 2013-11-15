<?php
	$product = new CLS_PRODUCTS();	
	$total_rows="0";
	if(!isset($_SESSION["CUR_PAGE_PRO"]))
		$_SESSION["CUR_PAGE_PRO"]=1;
	if(isset($_POST["txtCurnpage"])){	
		$_SESSION["CUR_PAGE_PRO"]=$_POST["txtCurnpage"];
	}
	$cur_page=$_SESSION["CUR_PAGE_PRO"];
?>
<div id="bxslider">
	<ul class="bxslider">
		<li><img src="images/product/banner.png" /></li>
		<li><img src="images/product/banner2.png" /></li>
		<li><img src="images/product/banner3.png" /></li>
	</ul>
	<script type="text/javascript">
		$('.bxslider').bxSlider({
			auto: true
		});
	</script>

</div><!--#bxslider-->
<div class="deal">
	<?php include_once('components/com_products/tem/deal.php');?>
</div><!--.deal-->
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
	<div class="primary">
		<div id="tabs_products">
			<ul class="ul_tab">
				<li><a href="#tabs-1">Newest books</a></li>
				<li><a href="#tabs-2">On sale</a></li>
				<li><a href="#tabs-3">Most Viewed</a></li>
			</ul>
			<div class="clear"></div>
			<div id="tabs-1">
				<!-- tir-1 -->
				<?php											
				$product->getList("");					
				$total_rows=$product->Num_rows();	
					if($total_rows>0){
						$max_page=ceil($total_rows/MAX_ITEM);
						if($cur_page>=$max_page){
							$cur_page=$max_page;
							$_SESSION["CUR_PAGE_PRO"]=$cur_page;
						}
						$start_r=($cur_page-1)*MAX_ITEM;
						$product->getListPro(" "," ORDER BY `cdate` DESC"," LIMIT $start_r,".MAX_ITEM);?>
						<div class="pagin"><?php paging_index($total_rows,MAX_ITEM,$cur_page); ?></div>
					<?php } ?>					
			</div>
			<div id="tabs-2">										
				<?php
					$product->getListPro(' AND `old_price`>0',' ORDER BY cur_price/old_price',' LIMIT 15');
				?>
			</div>
			<div id="tabs-3">
				<?php
					$product->getListPro(' ',' ORDER BY visited DESC',' LIMIT 15');
				?>
			</div>


		</div><!--.tabs_product-->

	</div><!--.primary-->
</div><!--.main_wrapp-->