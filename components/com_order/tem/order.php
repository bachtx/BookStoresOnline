<?php ob_start();?>
<div class="detail_jumlink">
	<p>Home  <span class="bg_jumlink"></span>  <?php echo "Cart";?></p>
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
<?php
if(!isset($_POST['cmd_order'])){
?>
	<div id="tabs_products">
		<h3><?php echo 'Cart';?></h3>
		<div id="tabs-1">
			<table width='100%' class='list' cellspacing="0" cellpadding='3'>
				<tr>
					<th width="60">TT</th>
					<th width="">Name</th>
					<th width="110" align='center'>Img</th>
					<th width="80">Price</th>
					<th width="90">Quantity</th>
					<th width="80">Amount</th>							
					<th width="60">Delete</th>
				</tr>
				<?php
				$n=count($_SESSION['CART']);
				$total=0;
				$objmysql= new CLS_MYSQL();
				for($i=0;$i<$n;$i++):						
					$proid=$_SESSION['CART'][$i]['proid'];						
					$sql="SELECT `pro_id`,`name`,`thumb`,`cur_price`  FROM tbl_products WHERE `pro_id`='$proid'";
					$objmysql->Query($sql);	
					$row=$objmysql->Fetch_Assoc();
					$amount=$row['cur_price']*$_SESSION['CART'][$i]['quan'];
					$total+=$amount;
					$img=$row['thumb'];
				?>
				<tr>
					<td align='center' width="30"><?php echo ($i+1);?>
						<input type='hidden' name='txt_id[]' value='<?php echo $_SESSION['CART'][$i]['proid'];?>'/>
					</td>
					<td align='center'><?php echo $row['name'];?></td>
					<td align='center'><?php echo "<img src='".$img."' width='60' height='85'/>";?></td>
					<td align='center'><?php echo number_format($row['cur_price']);?> $</td>		
					<td align='center'><?php echo $_SESSION['CART'][$i]['quan'];?></td>
					<td align='center'><?php echo number_format($amount);?> $</td>												
					<td align='center'><a href='<?php echo ROOTHOST;?>index.php?com=order&&viewtype=delcart&&proid=<?php echo $_SESSION['CART'][$i]['proid'];?>' title='Xóa'><strong class='star'><img src="<?php echo ROOTHOST;?>images/del.png"/></strong></a></td>
				</tr>
				<?php endfor; ?>
				<tr>
					<td colspan='2' align='center'><strong>Total&nbsp;&nbsp;</strong></td><td colspan='5' align='center'><strong style='font-size:17px;'><?php echo number_format($total);?> $</strong></td>
				</tr>									
			</table>		
		</div>
	</div><!--.end cart-->
<?php 
} 
if(isset($_POST['cmd_confirm'])){
        if(isset($_SESSION['ORDER'])){
			unset($_SESSION['ORDER']);
			setcookie('CART',null,time()-1);
		}
		$_SESSION['ORDER']['NAME']=$_POST['txt_name'];
		$_SESSION['ORDER']['PHONE']=$_POST['txt_tel'];
		$_SESSION['ORDER']['EMAIL']=$_POST['txt_email'];
		$_SESSION['ORDER']['SHIP']=$_POST['opt_ship'];
		$_SESSION['ORDER']['ADD']=$_POST['txt_address'];
		$_SESSION['ORDER']['PAYMENT']=$_POST['opt_payment'];
		?>
		<form method='POST' action=''>
		<fieldset>
			<legend>Info Custommer</legend>
			<table width="100%">
				<tr>
					<th align='right' width=150>FullName<span class='star'>*</span>:</th>
					<td><?php echo $_SESSION['ORDER']['NAME'];?></td>
				</tr>
				<tr>
					<th align='right'>Mobile<span class='star'>*</span>:</th>
					<td><?php echo $_SESSION['ORDER']['PHONE'];?></td>
				</tr>
				<tr>
					<th align='right'>Email:</th>
					<td><?php echo $_SESSION['ORDER']['EMAIL'];?></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Shiptype</legend>
			<h4></h4>
			<?php if($_SESSION['ORDER']['SHIP']=='Giao sách tận nơi'){
				echo '<strong>Địa chỉ nhận hàng:</strong> '.$_SESSION['ORDER']['ADD'];
			}else {
			 echo "Received Books At The Office";
			}?>
		</fieldset>
		<fieldset>
			<legend>Payment</legend>
			<h4><?php echo $_SESSION['ORDER']['PAYMENT'];?></h4>
		</fieldset>
        <div style="clear: both;height: 10px;"></div>
		<input type='submit' name='cmd_order' id='cmd_order' value='Send Order'/>
		<input type='button' name='cmd_back' id='cmd_back' value='Back' onclick="window.history.go(-1);"/>
		<br/>
		</form>
<?php }
else if(isset($_POST['cmd_order']) && isset($_SESSION['CART'])&& isset($_SESSION['ORDER'])){
    include_once('libs/cls.orders.php');
    include_once('addcart.php');
	$obj=new CLS_ORDER;
	$obj->Cdate=date('Y-m-d h:i:s');
	$obj->Cname=$_SESSION['ORDER']['NAME'];
	$obj->Cphone=$_SESSION['ORDER']['PHONE'];
	$obj->Cemail=$_SESSION['ORDER']['EMAIL'];
	$obj->ShipType=$_SESSION['ORDER']['SHIP'];
	$obj->Add=$_SESSION['ORDER']['ADD'];
	$obj->Payment=$_SESSION['ORDER']['PAYMENT'];
	$total=0;
	$objpro=new CLS_PRODUCTS;
	$n=count($_SESSION['CART']);
	for($i=0;$i<$n;$i++){
		$price=$objpro->getPriceById($_SESSION['CART'][$i]['proid']);
		$total+=$_SESSION['CART'][$i]['quan']*$price;
	}
	$obj->TotalMoney=$total;
	$obj->Add_new();
    deleteCookie();
	unset($_SESSION['CART']); unset($_SESSION['ORDER']);
	?>
	<div class='info_order'>
    	<h3 align='center'>You have successfully ordered this cart. We will check and confirm your delivery at the soonest possible.</h3>
    	<h3 align='center'>Thanks for your purchase.</h3>
    	<h4><a style='color:red;' href='<?php echo ROOTHOST;?>'>Click here!</a></h4>
	</div>
	<?php
}
else{ ?>
  	<form method='POST' action=''>	
        <span class='star' style='display:block;color:red;' id='error'></span>
    	<fieldset>
    		<legend><strong>Info Custommer</strong></legend>
    		<table width="80%" cellpadding='0'cellspacing='5'>
    			<tr>
    				<td align='right'>FullName<span class='star'>*</span>:</td>
    				<td><input type='text' style='float:left;margin-right:5px;' name='txt_name' id='txt_name'/></td>
    			</tr>
    			<tr>
    				<td align='right'>Mobile<span class='star'>*</span>:</td>
    				<td><input type='text' style='float:left;margin-right:5px;'name='txt_tel' id='txt_tel'/></td>
    			</tr>
                
    			<tr>
    				<td align='right'>Email:</td>
    				<td><input style='float:left;margin-right:5px;' type='text' name='txt_email' id='txt_email'/></td>
    			</tr>
    		</table>
    	</fieldset>
        <div style="clear: both;height: 10px;"></div>
    	<fieldset>
    		<legend><strong>Shiptype</strong></legend>
    		<h4 style="float: left;">1. <label><input type='radio' name='opt_ship' style="float: left;" id='opt_ship1' value='Giao sách tận nơi'/>Trasfer Taking Place</label></h4>
    		<table width="100%" id="address" style="display:none;">
    			<tr>
    				<td>Address<span class='star'>*</span>:<br/>
    				<textarea rows='3' style='width:100%' name='txt_address' id='txt_address'></textarea></td>
    			</tr>
    		</table>
    		<h4 style=" float: left;">2. <label><input type='radio' checked='true' name='opt_ship' id='opt_ship2' value='Received Books At The Office'/>Received Books At The Office!</label></h4>
    	</fieldset>
        <div style="clear: both;height: 10px;"></div>
    	<fieldset>
    		<legend><strong>Payment</strong></legend>
    		<table width="100%">
    			<tr>
    				<td style="float: left;"><label><input type='radio' checked='true'  name='opt_payment' id='opt_payment' value='Delivery and collection policies in place'/> Delivery and collection policies in place!</label></td>
    			</tr>
    			<tr>
    				<td style="float: left;">
    				<label><input type='radio' name='opt_payment' id='opt_payment' value='Chuyển khoản'/> Transfer (Please enter this code to check orders faster)</label>
    				<?php //$this->LoadModule('user3');?>	
    				</td>
    			</tr>
    		</table>
    	</fieldset>
        <div style="clear: both;height: 10px;"></div>
    	<input type='submit' name='cmd_confirm' id='cmd_confirm' value='Confirm' onclick="return checkinput_order();"/>
    	<input type='reset' name='cmd_reset' id='cmd_reset' value='Reset'/>
    	<input type='button' name='cmd_back' id='cmd_back' value='Back' onclick="window.history.go(-1);"/>
    	<br/>
	</form> 
<?php }
?>
	</div><!--.primary-->            
</div><!--.main_wrapp-->

<script type="text/javascript">
$(document).ready(function(){
	$('#opt_ship1').click(function(){$('#address').show();});
	$('#opt_ship2').click(function(){$('#address').hide();});
});
function checkPhone(){
     var re=/^[0][1-9][0-9]{8,9}$/;
     var phone=$('#txt_tel').val();
     if(!re.test(phone)){
        return false;
     }
     return true;     
}
function checkEmail(){
    re=/^(([a-zA-Z0-9])+\.?)*[a-zA-Z0-9]+@(([a-zA-Z0-9])+\.)+[a-zA-Z]{2,4}$/;
    var email=$('#txt_email').val();
    if(!re.test(email)){
        return false;  
    }
    return true;
}
function checkinput_order(){
	var error=false;
	var err = [];
	if(!checkPhone()){
		error=true;
		err[0]='<p>Error Number.</p>';
		$('#txt_tel').css({'border':'1px solid #f00;'});
	}
	if($('#txt_name').val()==''){
		error=true;
		err[1]='<p>You did not entered your name.</p>';
		$('#txt_name').css({'border':'1px solid #f00;'});
	}	
	if(!checkEmail()){
		error=true;
		err[2]='<p>Error Email.</p>';
		$('#txt_email').css({'border':'1px solid #f00;'});
	}
	if(error){
		$('#error').show();
		console.log(err);
		$('#error').html(err);
		return false;
	}
	return true;
}
</script>
<?php ob_end_flush(); ?>
