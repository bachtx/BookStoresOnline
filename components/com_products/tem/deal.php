<?php
	$objpro= new CLS_PRODUCTS();
	$objpro->getList('',' ORDER BY RAND()', 'LIMIT 0,1');
	$row=$objpro->Fetch_Assoc();
	$old_price=number_format($row["old_price"]);
	$cur_price=number_format($row["cur_price"]);
	$cur_price=($cur_price==0)?'Call ':$cur_price."";
	$persen="0";
	if($cur_price!=0 && $old_price!=0)
		$persen=ceil(($row["old_price"]-$row["cur_price"])/$row["old_price"]*100);
?>
<div class='info_deal'>
	<h2><span><?php echo Substring(stripslashes($row['name']),0,6);?></span></h2>
	<img src='<?php echo $row['thumb'];?>'width='80' height='110'/>
	<div class='con'>
		<p class='save'>Save <?php echo $persen; ?>% Today</p>
		<p class='pri'>$.<?php echo $row['cur_price']?>.00</p>
		<a href="#">Buy now</a>
	</div>
</div>