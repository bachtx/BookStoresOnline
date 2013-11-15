<?php
	defined("ISHOME") or die("Can't acess tdis page, please come back!");
?>
<style type="text/css">
fieldset{
	overflow: hidden;
	clear: both;
	display: block; border: 1px dotted #ccc
}
div.clear{ clear: both;}
div.fun_icon{
	width: 145px;
	height: 110px;
	text-align: center;
	display: block;
	float: left;
	margin: 10px;
	overflow: hidden;
	border: #DDDDDD 1px solid;
}
div.fun_icon img{ width: 80px; height: 80px; margin: 3px; border: none; clear:both}
</style>


<?php
if(!isset($objuser)) $objuser = new CLS_USERS();
$check_isadmin = $objuser->isAdmin();
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0" widtd="100%">
  <tr>
    <td valign="top" scope="col">
    <div class="fun_icon"><a href="index.php?com=gusers"><img src="images/icon-user.jpg"/></a><div>Assignment Users</div></div>
    <div class="fun_icon"><a href="index.php?com=users"><img src="images/user-info-icon.png"/></a><div>Manager User</div></div>
    <div class="fun_icon"><a href="index.php?com=catalogs"><img src="images/icon_catalog.png"/></a><div>Catalogs</div></div>
	<div class="fun_icon"><a href="index.php?com=product"><img src="images/icon_menu.png"/></a><div>Products</div></div>
    <div class="fun_icon"><a href="index.php?com=categories"><img src="images/icon_category.gif"/></a><div>Catagories</div></div>
    <div class="fun_icon"><a href="index.php?com=content"><img src="images/icon_article.png"/></a><div>Contents</div></div>   
	</td>
	<td width="200"></td>
</table>