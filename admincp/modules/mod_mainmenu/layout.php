
	<?php 
		if($UserLogin->isLogin()==true){
		if($UserLogin->isAdmin() == TRUE){
	?>


<ul>
    <li>
        <a href="index.php" class="active"><span>Systems</span></a>
        <ul class="submenu">                       
			<li><a href="index.php?com=group"><span>Group Users</span></a></li>
            <li><a href="index.php?com=users"><span>List Users</span></a></li>
            <li><a href="index.php?com=users&task=logout"><span>Logout</span></a></li>     				
        </ul>
    </li>
    <li><a href="#"><span>Books Management</span></a>
         <ul class="submenu">                       
			<li><a href="index.php?com=catalogs&task=add"><span>Add Group Book</span></a></li>
            <li><a href="index.php?com=catalogs"><span>List Group Book</span></a></li>
            <li><a href="index.php?com=product&task=add"><span>Add Book</span></a></li>  
            <li><a href="index.php?com=product"><span>List Book</span></a></li>     				
        </ul>
    </li>
	 <li><a href="#"><span>Author Management</span></a>
         <ul class="submenu">                       
			<li><a href="index.php?com=author&task=add"><span>Add Author</span></a></li>
            <li><a href="index.php?com=author"><span>List Author</span></a></li>            	
        </ul>
    </li>
    <li><a href="#"><span>Order Management</span></a>
         <ul class="submenu">                       
			<li><a href="index.php?com=orders&task=list"><span>New Order</span></a></li>
            <li><a href="index.php?com=orders&task=process"><span>Processing Order</span></a></li>
            <li><a href="index.php?com=orders&task=finished"><span>Finished Order</span></a></li> 
			<li><a href="index.php?com=orders&task=cancel"><span>Cancle Order</span></a></li>			
        </ul>
    </li>
    <li><a href="#"><span>Contents Management</span></a>
         <ul class="submenu">                       
			<li><a href="index.php?com=categories&task=add"><span>Add Categories</span></a></li>
            <li><a href="index.php?com=categories"><span>List Categories</span></a></li>
            <li><a href="index.php?com=content&task=add"><span>Add Contens</span></a></li>
            <li><a href="index.php?com=content"><span>List Contents</span></a></li>                             				
        </ul>
    </li>    
    <li><a href="#"><span>Support</span></a>
        
    </li>
</ul>
	<?php }else{?>
	
	<ul>
		<li>
        <a href="index.php" class="active"><span>Systems</span></a>
	        <ul class="submenu">                       
				
	            <li><a href="index.php?com=users&task=logout"><span>Logout</span></a></li>     				
	        </ul>
    	</li>
		<li><a href="#"><span>Books Management</span></a>
         <ul class="submenu">                       
			<li><a href="index.php?com=catalogs&task=add"><span>Add Group Book</span></a></li>
            <li><a href="index.php?com=catalogs"><span>List Group Book</span></a></li>
            <li><a href="index.php?com=product&task=add"><span>Add Book</span></a></li>  
            <li><a href="index.php?com=product"><span>List Book</span></a></li>     				
        </ul>
    </li>
	 <li><a href="#"><span>Author Management</span></a>
         <ul class="submenu">                       
			<li><a href="index.php?com=author&task=add"><span>Add Author</span></a></li>
            <li><a href="index.php?com=author"><span>List Author</span></a></li>            	
        </ul>
    </li>
    <li><a href="#"><span>Order Management</span></a>
         <ul class="submenu">                       
			<li><a href="index.php?com=orders&task=list"><span>New Order</span></a></li>
            <li><a href="index.php?com=orders&task=process"><span>Processing Order</span></a></li>
            <li><a href="index.php?com=orders&task=finished"><span>Finished Order</span></a></li> 
			<li><a href="index.php?com=orders&task=cancel"><span>Cancle Order</span></a></li>			
        </ul>
    </li>
    <li><a href="#"><span>Contents Management</span></a>
         <ul class="submenu">                       
			<li><a href="index.php?com=categories&task=add"><span>Add Categories</span></a></li>
            <li><a href="index.php?com=categories"><span>List Categories</span></a></li>
            <li><a href="index.php?com=content&task=add"><span>Add Contens</span></a></li>
            <li><a href="index.php?com=content"><span>List Contents</span></a></li>                             				
        </ul>
    </li>    
    <li><a href="#"><span>Support</span></a>
        
    </li>
	</ul>
	<?php
	} 	
	}
	?>
