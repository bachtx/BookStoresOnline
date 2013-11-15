<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>bookStore Online</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.bxslider.css" rel=" stylesheet" type="text/css"/>
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui.js" ></script>
	<script src="js/gfscript.php" ></script>
    <script src="js/jquery.bxslider.js"></script>
	
    <script type="text/javascript">
        $(function() {
            $( "#tabs_products" ).tabs();
        });
    </script>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
</head>
<body>
    <div class="header">
        <div class="top">
            <div class="box">
                 <marquee align="center" direction="left" height="28" scrollamount="4" width="100%" behavior="alternate">
                    <span style="color: #fff; font-size: 15px;line-height:30px; font-weight: bold;">Hello Welcome to Website</span>
                </marquee>
            </div><!--.box-->
        </div><!--.top-->
        <div class="main_header">
            <div class="box_main_header">
                <h1><a href="home.html"><img src="images/logo.png" alt="logo" class="logo"/></a></h1>
                <form action="search.html" method="POST">
                    <input type="text" name="txtsearch" placeholder='Search'/>
                    <input type="submit" name="search" value=''/>
                </form>
                <div class="cart">
                    <div class="col1">
						<?php 
							$count=0;
							if(isset($_SESSION['CART']))
								$count=count($_SESSION['CART']);														
						?>
                        <p class="y_cart"><span class="your_cart">Your cart</span> (<?php echo $count;?> items)</p>
                        <p><a href="<?php echo ROOTHOST;?>shopcart.html" class="checkout" style="margin-left:88px;">Checkout</a></p>
                    </div><!--.col1-->
                    <div class="col2">
                        <img src="images/star.png" alt="star"/>
                        <p class="p_20">20</p>
                        <p class="wish_list">Wish list</p>
                    </div><!--.col2-->
                </div><!--.cart-->
            </div><!--.box-->
        </div><!--.main_header-->
        <div class="nav_menu">
            <div class="box">
                <ul>

                    <li <?php if(($_SERVER['REQUEST_URI'] == '/BookStore_Online/home.html') || ($_SERVER['REQUEST_URI'] == '/BookStore_Online/')) echo "class='hover'"?>><a href="home.html">Home</a></li>
                    <li <?php if($_SERVER['REQUEST_URI'] == '/BookStore_Online/products.html') echo "class='hover'"?>><a href="products.html">Products</a></li>
					<li <?php if($_SERVER['REQUEST_URI'] == '/BookStore_Online/book1.html') echo "class='hover'"?>><a href="book1.html">Books 1$</a></li>
                    <li <?php if($_SERVER['REQUEST_URI'] == '/BookStore_Online/payment.html') echo "class='hover'"?>><a href="payment.html">Payment</a></li>
                    <li <?php if($_SERVER['REQUEST_URI'] == '/BookStore_Online/support.html') echo "class='hover'"?>><a href="support.html">Support</a></li>
                    <li <?php if($_SERVER['REQUEST_URI'] == '/BookStore_Online/contacts.html') echo "class='hover'"?>><a href="contacts.html">Contacts</a></li>
                </ul>
                <script type="text/javascript">
//                    $(document).ready(function(){
//                    	var url = window.location.href;
                    	//var url1 = document.write(url.slice(0));
                    	//alert(url);
//                      	alert(url);
                    	//$('a[href="products.html"]').parent().addClass("hover");
//                         $("li").click(function(){ 	
//                             $("li.hover").removeClass("hover");
//                             $(this).addClass("hover");

//                         })
                    })
                </script>
            </div><!--.box-->
        </div><!--.nav_menu-->
    </div><!--header-->
    <div class="content">
        <div class="box">
            <?php 
				$this->loadComponent(); 
			?>
        </div><!--.box-->
    </div><!--.content-->
    <div class="footer">
        <div class="main_footer">
            <div class="box">
               <?php 
					require_once ('libs/cls.contents.php');
					$objcontents = new CLS_CONTENTS;
					for ($i=1;$i<=3;$i++){
					$objcontents=new CLS_CONTENTS();
                    $name=$objcontents->getNameCat($i);
					?>
				<div class='col' id='col<?php echo $i; ?>'>
						<h4><a href="<?php echo ROOTHOST.$name."-gr".$i.".html";?>"><?php echo $objcontents->getNameCat($i); ?></a></h4>
						<ul>
							<?php
							$objcontents->getList(' AND `cat_id` ='.$i,"",' LIMIT 0,7');
							while($row=$objcontents->Fetch_Assoc()){
							?>                   
								<li><a href="<?php echo ROOTHOST.$row['title']."-bv".$row['con_id'].".html";?>"><?php echo $row['title'];?></a><span class="border"></span></li>
				   <?php }?>
				   </ul>
               </div><!--.col-->
			   <?php } ?>
                <div class="col" id="col4">
                    <h4 title="Bài vi?t m?i nh?t">Sharing On Social</h4>
					<div class="fb-like-box" data-href="https://www.facebook.com/thietkeweb.igf" data-width="200" data-show-faces="true" data-stream="false" data-show-border="true" data-header="false"></div>
                </div><!--.col-->
            </div><!--box-->
        </div><!--.main_footer-->
        <div class="footer_info">
            <p> We accept all major Credit Card/Debit Card/Internet Banking </p>
            <a href="#"><img src="images/mastercard.png" alt="visa"/> </a>
            <a href="#"><img src="images/american.png" alt="visa"/> </a>
            <a href="#"><img src="images/visa.png" alt="visa"/> </a>

            <div class="footer_bottom">
                <p> Conditions of Use Privacy Notice © 2012-2013, Booksonline, Inc. or its affiliates </p>
            </div><!--.footer_bottom-->
        </div><!--.footer_info-->
    </div><!--.footer-->
</body>
</html> 