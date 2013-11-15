<?php
if(isset($_GET['id']))
	$pro_id=(int)$_GET['id'];
	$obj->getOne(" AND `pro_id`='".$pro_id."'");
	$row=$obj->Fetch_Assoc();
	$cat_id = $row['cat_id'];
	$author_id = $row['author_id'];

	$cata->getNameById($cat_id);// $cata la đối tượng class catalog khởi tạo bên layout.php
	$r=$cata->Fetch_Assoc();
	$par_id=$r['par_id'];
	$namePar=$cata->getParNameById($par_id);
	if(!isset($_SESSION['visit'])||$_SESSION['visit']!=$pro_id){
		$_SESSION['visit']=$pro_id;
		$obj->setVisited($pro_id);
	}
?>
<div class="detail_jumlink">
	<p>Home  <span class="bg_jumlink"></span>  <?php echo $namePar;?> <span class="bg_jumlink"></span> <?php echo $r['name'];?> <span class="bg_jumlink"></span> <?php echo $row['name'];?></p>
</div><!--detail_jumlink-->
<div class="feature">
	<img src="<?php echo $row['thumb']?>" width="252" height="393" alt="feature"/>
	<h2><?php echo $obj->truncateString($row['name'],30,true);?></h2>
	<p>
		<?php echo $row['intro'];?>
	</p>
	<p class="stock">IN STOCK</p>
	<div class="btn_addtocart">
		<p class="our_price">Our price : <span class="detail_price"><?php echo $row['cur_price'].'$';?></span></p>
		<p class="sale">
			<?php
				$obj->getPrice($pro_id);
			?> 
		</p>
		<a href="#" class="btn_cart" pro_id='<?php echo $pro_id;?>'>Add to cart</a>
		<div class="paypal">
			<p class="lock">Safe, Secure Shopping</p>
			<a href="#"><img src="images/paypal.png" alt="paypal"/> </a>
			<a href="#"><img src="images/mastercard.png" alt="visa"/> </a>
			<a href="#"><img src="images/american.png" alt="visa"/> </a>
			<a href="#"><img src="images/visa.png" alt="visa"/> </a>

		</div><!--.paypal-->
	</div><!--.btn_addtocart-->
</div><!--.feature-->
<div class="desc">
	<div id="desc_tabs">
		<ul>
			<li><a href="#tabs-1">Author</a></li>
			<li><a href="#tabs-2">Book Reference</a></li>
		</ul>
		<div id="tabs-1">
			<?php $obj->getAuthor($author_id); ?>
		</div>
		<div id="tabs-2">
			<?php $obj->getBookref("AND `author_id`='$author_id'",'ORDER BY `cdate` DESC ','LIMIT 0,20');?>
		</div>
	</div>
	<script type="text/javascript">
		$(function() {
			$( "#desc_tabs" ).tabs();
		});
	</script>

	<div class="comment">
		<h4>Product review</h4>
		<?php
			$obj->getComment($pro_id);
		?>
        <span class='star' style='display:block;color:red;' id='error'></span>
		<form action="index.php?com=products&&viewtype=comment" method="post" name="frm_comment">
			<fieldset>
				<legend>Write a comment</legend>
				<input type="hidden" name="id" value="<?php echo $pro_id;?>" />
				<input type="hidden" name="link" value="<?php echo ROOTHOST;?>index.php?com=products&&viewtype=detail&&id=<?php echo $pro_id;?>">
				<p>
					<label>Your name</label>
					<input type="text" name="name" class="c_name" />
				</p>
				<p>
					<label>email </label>
					<input type="text"  name="email" class="c_title"/>
				</p>
				<p>
					<label>Message </label>
					<textarea name="content" class="c_mes"></textarea>
				</p>
				<p>
					<input type="submit" name="submit" value="Send" onclick="return checkcomment();"/>

				</p>
			</fieldset>
		</form>
		
	</div><!--.comment-->
</div><!--.desc-->

<div class="like">
	<h3>You may also like</h3>
	<?php
		$obj->getLike($cat_id);
	?>
</div>
<div style='clear:both;height:10px;'></div>
<script type='text/javascript'>
	$(document).ready(function(){
		$('.btn_cart').click(function(){
			var proid= $(this).attr('pro_id');
			$.post('addcart.php',{'proid':proid},function(data){
			//alert(data);
				alert('Add Cart Sucess !');
				window:location="index.php?com=products&&viewtype=detail&&id="+proid;
			})
		})
	})   
    function checkcomment(){ 
    	var error=false;
    	if($('.c_name').val()==''){
    		error=true;
    	}
    	if($('.c_title').val()==''){
    		error=true;
    	}
        if($('.c_mes').val()==''){
    		error=true;    		
    	}
    	if(error){
    		$('#error').show();
    		$('#error').html('Có những trường yêu cầu chưa được điền, bạn hãy điền đầy đủ trước khi coment !');
    		return false;
    	}
    	return true;
    }
</script>
<!--.like-->
