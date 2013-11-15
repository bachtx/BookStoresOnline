<?php
	defined("ISHOME") or die("Can't acess this page, please come back!")
?>

<div id="action">
  <form id="frm_action" name="frm_action" method="post" action="">
  Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong>Name:&nbsp;<font color="red">*</font></strong></td>
        <td>
          <input name="txtname" type="text" class="txtname" size="40"/>
          <label class="txtname_err check_error"></label>          
		</td>
      </tr>
      
      <tr>
      	<td align="right" bgcolor="#EEEEEE"><strong>Level</strong></td>
      	<td>
      	<select name="isadmin">
      		<option value="Admin">Admin</option>
      		<option value="Mod">Mod</option>
      	</select>
      	</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Public:&nbsp;</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" checked="true"/>Yes
        <input name="optactive" type="radio" id="radio2" value="0"/>No</td>
      </tr>
    </table>

    <fieldset>
<legend><strong>Description:</strong></legend>
           <textarea name="txt_metadesc" id="txt_metadesc" cols="45" rows="5"></textarea>
        	<script language="javascript">
        		var oEdit2=new InnovaEditor("oEdit2");
        		oEdit2.width="100%";
        		oEdit2.height="100";
        		oEdit2.cmdAssetManager ="modalDialogShow('extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
        		oEdit2.REPLACE("txt_metadesc");
        		document.getElementById("idContentoEdit2").style.height="100px";
        	</script>
      <label>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;"/>
      </label>
    </fieldset>
  </form>
</div>
