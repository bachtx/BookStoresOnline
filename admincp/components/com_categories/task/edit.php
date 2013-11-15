<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=$_GET["id"];
$obj->getList(' And id='.$id,' limit 0,1');
$row=$obj->Fetch_Assoc();
?>
<div id="action">
<form id="frm_action" name="frm_action" method="post" action="">
	<div>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</div>
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong>Name <font color="red">*</font></strong></td>
        <td>
          <input name="txtname" type="text" class="txtname" value="<?php echo $row['name'];?>" size="40">
          <label class="txtname_err check_error"></label>
	      <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['id'];?>"></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Cat_id&nbsp;</strong></td>
        <td>
            <select name="cbo_cat" id="cbo_cat">
              <option value="0" selected="selected"  style="background-color:#eeeeee; font-weight:bold">
              <?php echo "Root";?></option>
               <?php
                if(!isset($objCata))
                $objCata=new CLS_CATEGORIES();
                $obj->ListCategory($id,$row['cat_id'],0,1);
               ?>
            </select></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Public &nbsp;</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" <?php if($row['isactive']==1) echo "checked";?>/>
	       Yes
        <input name="optactive" type="radio" id="radio2" value="0" <?php if($row['isactive']==0) echo "checked";?>/>
	       No </td>
      </tr>
    </table>
    <fieldset>
    <legend><strong>Description:</strong></legend>
            <textarea name="txt_metadesc" id="txtdesc" cols="45" rows="5"><?php echo $row['desc'];;?></textarea>
        	<script language="javascript">
				var oEdit1=new InnovaEditor("oEdit1");
				oEdit1.width="100%";
				oEdit1.height="300";
				oEdit1.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
				oEdit1.REPLACE("txtdesc");
				document.getElementById("idContentoEdit1").style.height="225px";
			</script>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
    </fieldset>
  </form>
</div>