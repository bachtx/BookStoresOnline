<script type='text/javascript'>
$(function() {
	$( "#date1" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
	$( "#date2" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
</script>
<div id="action">
  <form id="frm_action" name="frm_action" method="post" action="">
  Những mục đánh dấu   <font color="red">*</font> là yêu cầu bắt buộc.
  <fieldset>
   <legend><strong>Add new posts&nbsp;</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="126" align="right" bgcolor="#EEEEEE"><strong>Category<font color="red">*</font></strong></td>
        <td>
          <select name="cbo_cate" id="cbo_cate">
            <?php 
			  if(!isset($objcata)) $objcata=new CLS_CATEGORIES();
			  	echo $objcata->getListCate("option");
			?>
          </select></td>
		<td width='126' align="right" bgcolor="#EEEEEE"><strong>Create Date</strong></td>
        <td><input id = "date1" type="text" name="txtcreadate" value=""/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Title<font color="red">*</font></strong></td>
			<td >
			  <input name="txtname" type="text" class="txtname" size="35" />
			  <label class="txtname_err" ></label></td>
			  <td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
			<td><input name="optactive" type="radio" value="1" checked='true' />
			Yes
			<input name="optactive" type="radio" value="0" />
			No</td>
			
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Url<font color="red">*</font></strong></td>
			<td><input name="txtcode" type="text" class="txtcode" size="35" />
			<label class="txtcode_err"></label></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Author</strong></td>
			<td><input type="text" name="txtauthor" value="<?php echo $_SESSION["IGFUSERLOGIN"];?>"/></td>
        </tr>
		
       <tr>
         	<td align="right" bgcolor="#EEEEEE"><strong>Images  </strong></td>
			<td><input size="35" name="txtthumb" value="" type="text"/><a href="#" onclick="OpenPopup('extensions/upload_image.php');">Upload</a></td>
        	<td></td>
        	<td></td>
        </tr>
      </table>
      </fieldset>
    <br style="clear:both" />
    <strong>Intro</strong>
    <textarea name="txtintro" id="txtintro" cols="45" rows="5">&nbsp;</textarea>
     <script language="javascript">
            var oEdit2=new InnovaEditor("oEdit2");
            oEdit2.width="100%";
            oEdit2.height="100";
            oEdit2.cmdAssetManager ="modalDialogShow('extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit2.REPLACE("txtintro");
			document.getElementById("idContentoEdit2").style.height="100px";
      </script>
    <br style="clear:both" />
    <strong>Fulltext&nbsp;</strong></legend>
    <textarea name="txtfulltext" id="txtfulltext" cols="45" rows="5">&nbsp;</textarea>
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