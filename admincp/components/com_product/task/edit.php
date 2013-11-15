<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$obj->getList(' WHERE `pro_id`='.$id,' LIMIT 0,1');
	$row=$obj->Fetch_Assoc();
}
?>
<div id="action">
 <script language="javascript">
 function checkinput(){
	if($("#txtname").val()==""){
	 	$("#txtname_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên sách').fadeTo(900,1);
		});
	 	$("#txttitle").focus();
	 	return false;
	}
	if($("#txtcode").val()==""){
	 	$("#txtcode_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập mã cho sách').fadeTo(900,1);
		});
	 	$("#txtcode").focus();
	 	return false;
	}
	return true;
 }
$(function() {
	$( "#date1" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
	$( "#date2" ).datepicker({ dateFormat: 'dd-mm-yy' });
});

$(document).ready(function() {
	$("#txtname").blur(function(){
		if ($("#txtname").val()=="") {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập tên sách').fadeTo(900,1);
			});
		}
	});
	$("#txtcode").blur(function(){
		if ($("#txtcode").val()=="") {
			$("#txtcode_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập mã sách').fadeTo(900,1);
			});
		}
	});
	
});
 </script>

  <form id="frm_action" name="frm_action" method="post" action="">
  Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
  <fieldset>
   <legend><strong>Info book&nbsp;</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="126" align="right" bgcolor="#EEEEEE"><strong>Group Books<font color="red">*</font></strong></td>
        <td>
          <select name="cbo_cate" id="cbo_cate">
            <?php 
			  if(!isset($objcata)) $objcata=new CLS_CATALOGS();
			  	echo $objcata->getListCate("option");
			?>
			<script language="javascript">
				cbo_Selected('cbo_cate',<?php echo $row['cat_id'];?>);
			</script>
          </select></td>
		<td width='126' align="right" bgcolor="#EEEEEE"><strong>Create Date</strong></td>
        <td><input id = "date1" type="text" name="txtcreadate" value="<?php echo date('d-m-Y',strtotime($row['cdate']));?>"/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Book Name<font color="red">*</font></strong></td>
			<td>
			  <input name="txtname" type="text" class="txtname"  id="txtname" size="35"  value="<?php echo $row['name'];?>"/>
			  <label class="txtname_err" ></label></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Modify Date</strong></td>
			<td><input id = "date2" type="text" name="txtmodify" value="<?php echo date('d-m-Y',strtotime($row['mdate']));?>"/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Book Code<font color="red">*</font></strong></td>
			<td><input name="txtcode" type="text" id="txtcode"  size="35" value="<?php echo $row['code'];?>" />
			<label class="txtcode_err"></label></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Author</strong></td>
			<td><?php echo $_SESSION["IGFUSERLOGIN"];?></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Old Price</strong></td>
			<td><input name="txt_oldprice" type="text" value='<?php echo $row['old_price'];?>' /> $</td>
			<td align="right" bgcolor="#EEEEEE"><strong>Images  </strong></td>
			<td><input size="35" name="txtthumb"  type="text" value="<?php echo $row['thumb'];?>"/><a href="#" onclick="OpenPopup('extensions/upload_image.php');">Chọn</a></td>			
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Author</strong></td>
			<td>
				<select name="cbo_author" id="cbo_author">
				<option value=''>Chọn tác giả</option>
				<?php 
				  if(!isset($objauthor)) $objauthor=new CLS_AUTHOR();
					$objauthor->getListAuthor();				
				?>
				<script language="javascript">
				cbo_Selected('cbo_author',<?php echo $row['author_id'];?>);
			</script>
			  </select>
			</td>
			<td align="right" bgcolor="#EEEEEE"><strong>Publisher<font color="red">*</font></strong></td>
			<td><input name="txtpublisher" type="text" class="txtpublisher" size="35" value='<?php echo $row['publisher'];?>' />			
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Curent Price</strong></td>
			<td><input name="txt_curprice" type="text" value='<?php echo $row['cur_price'];?>'/> $</td>
			<td align="right" bgcolor="#EEEEEE"><strong>isHot&nbsp;</strong></td>
			<td><input name="opt_hot" type="radio" id="radio" value="1" <?php if($row['ishot']==1) echo 'checked';?> />
			 Yes
			  <input name="opt_hot" type="radio" id="radio2" value="0"  <?php if($row['ishot']==0) echo 'checked';?> />
			  No</td>
        </tr>
	   <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Quantity:</strong></td>
			<td><input name="txt_quantity" type="text" value='<?php echo $row['quantity'];?>'/></td>
			<td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
			<td><input name="optactive" type="radio" value="1" <?php if($row['isactive']==1) echo 'checked';?>/>
			Yes
			<input name="optactive" type="radio" value="0"  <?php if($row['isactive']==0) echo 'checked';?>/>
			No</td>
       </tr>
       <tr>
         <td colspan="4" align="left"><hr size="1" color="#EEEEEE" width="100%" />
			<input name="txtid" type="hidden" value='<?php echo $id;?>' /> 
		 </td>
        </tr>
      </table>
      </fieldset>
    <br style="clear:both" />
    <strong>Intro</strong>
    <textarea name="txtintro" id="txtintro" cols="45" rows="5"><?php echo stripslashes($row['intro']);?></textarea>
     <script language="javascript">
            var oEdit2=new InnovaEditor("oEdit2");
            oEdit2.width="100%";
            oEdit2.height="100";
            oEdit2.cmdAssetManager ="modalDialogShow('extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit2.REPLACE("txtintro");
			document.getElementById("idContentoEdit2").style.height="100px";
      </script>
    <br style="clear:both" />
    <strong>Description&nbsp;</strong></legend>
    <textarea name="txtfulltext" id="txtfulltext" cols="45" rows="5"><?php echo stripslashes($row['fulltext']);?></textarea>
    <script language="javascript">
            var oEdit1=new InnovaEditor("oEdit1");
            oEdit1.width="100%";
            oEdit1.height="300";
            oEdit1.cmdAssetManager ="modalDialogShow('extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit1.REPLACE("txtfulltext");
            document.getElementById("idContentoEdit1").style.height="225px";
    </script>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>