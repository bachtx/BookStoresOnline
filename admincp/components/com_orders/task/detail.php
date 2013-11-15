<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	$obj->getList(' WHERE `id`='.$id);
	$row=$obj->Fetch_Assoc();
?>
<div style='text-align:left; height:30px; line-height:30px;'><strong>Order Number</strong>: OrderID<?php echo $row['id'];?>.../ <strong>Date:</strong> <?php echo date('d/m/Y', strtotime($row['cdate']));?>...</div>
<strong>Status Order:</strong> 
<?php if($row['status']==0){?>
<span style='color:red;'>Waiting Process</span><br/>
<?php }else if($row['status']==1){?>
<span style='color:red;'>Processing</span><br/>
<?php }else if($row['status']==2){
	echo "<span style='color:red;'>Finished</span><br/>";
}else{
	echo "<span style='color:red;'>Cancel</span><br/>";
}?>
<fieldset>
   <legend><strong>Custommer Info</strong></legend>
   <table width="100%" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Name:</strong></td>
			<td><?php echo $row['cname'];?></td>
		</tr>
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Mobile:</strong></td>
			<td><?php echo $row['cphone'];?></td>
		</tr>
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Email:</strong></td>
			<td><?php echo $row['cemail'];?>&nbsp;</td>
		</tr>
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Shiptype:</strong></td>
			<td><?php echo $row['shiptype'];?></td>
		</tr>
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Add:</strong></td>
			<td><?php echo $row['add'];?></td>
		</tr>
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Payment:</strong></td>
			<td><?php echo $row['payment'];?></td>
		</tr>
	</table>
</fieldset>
<fieldset>
   <legend><strong>Order Info</strong></legend>
   <table width='100%' class='tbl_list list' cellspacing='0' cellpadding='5'>
	<tr>
		<th>Number</th>
		<th width='200'>ProductId</th>
		<th>Name</th>
		<th width='80'>Quantity</th>
		<th width='80'>Price</th>
		<th width='80'>Amount</th>
		<th>Note</th>
	</tr>
	<?php
	$objpro=new CLS_PRODUCTS;
	$objcat=new CLS_CATALOGS;
	$obj->getOrderDetail($row['id']);
	$total=0;$i=0;
	while($rows=$obj->Fetch_Assoc()){
		$objpro->getList(' WHERE `pro_id`='.$rows['pro_id']);
		$row_pro=$objpro->Fetch_Assoc();
		$price=$rows['price'];
		$amount=$price*$rows['quantity'];
		$total+=$amount;
		$i++;
	?>
	<tr>
		<td align='center'><?php echo ($i);?></td>
		<td><a href="http://localhost/bookstores/index.php?com=products&&viewtype=detail&&id=<?php echo $row_pro['pro_id']; ?>" target="_blank"><?php echo $row_pro['code'];?></a></td>
		<td align='center'><a href="http://localhost/bookstores/index.php?com=products&&viewtype=detail&&id=<?php echo $row_pro['pro_id']; ?>" target="_blank"><?php echo $row_pro['name'];?></a></td>
		<td align='center'><?php echo $rows['quantity'];?></td>
		<td align='center'><?php echo number_format($price);?> <strong> $</strong></td>
		<td align='center'><?php echo number_format($amount);?> <strong> $</strong></td>
		<td align='center'><?php echo $rows['note'];?>&nbsp;</td>
	</tr>
	<?php }?>
	<tr>
		<td colspan='5' align='right'><strong>Total Money</strong></td>
		<td colspan='2'><?php echo number_format($total);?> <strong> $</strong></td>
	</tr>
</table>
</fieldset> 
<div class='fun'>
	<a href='index.php?com=orders&task=toprocess&id=<?php echo $id;?>'>Comfirm</a> | 
	<a href='index.php?com=orders&task=tofinished&id=<?php echo $id;?>'>Finished</a> | 
	<a href='index.php?com=orders&task=tocancel&id=<?php echo $id;?>'>Cancel Order</a> | 
	<a href='javascript:window.history.go(-1);'>Back</a>
</div>