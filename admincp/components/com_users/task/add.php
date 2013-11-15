<?php
	defined("ISHOME") or die("Can not acess this page, please come back!");
	
	if($UserLogin->isAdmin()==false ){
		echo ('<div id="action" style="background-color:#fff"><h3 align="center">Báº¡n khÃ´ng cÃ³ quyá»�n truy cáº­p. <a href="index.php">Vui lÃ²ng quay láº¡i trang chÃ­nh</a></h3></div>');
	} else {
?>

<div id="action">
<script language="javascript">

function checkinput(){
	return true;
}
$(document).ready(function()
{
	$('#txtbirthday').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1900:<?php echo date("Y");?>'
    });
	
	$("#txtusername").blur(function(){
		$("#msgbox").removeClass().addClass('messagebox').text('Kiá»ƒm tra dá»¯ liá»‡u...').fadeIn("slow");
		$.post("user_availabity.php",{ user_name:$(this).val() } ,function(data){
		  if($.trim(data)=='nodata' || $.trim(data)=='') {
		  	$("#msgbox").fadeTo(200,0.1,function(){ 
			  //add message and change the class of the box and start fading
			  $(this).html('Vui lÃ²ng nháº­p tÃªn Ä‘Äƒng nháº­p').addClass('messageboxerror').fadeTo(900,1);
			});
		  }
		  else if($.trim(data)=='no'){
		  	$("#msgbox").fadeTo(200,0.1,function(){ 
			  $(this).html('TÃªn Ä‘Äƒng nháº­p nÃ y Ä‘Ã£ tá»“n táº¡i. Vui lÃ²ng nháº­p tÃªn Ä‘Äƒng nháº­p khÃ¡c').addClass('messageboxerror').fadeTo(900,1);
			});		
			document.getElementById("checkuser").value="false";
          }
		  else {
			$("#msgbox").fadeTo(200,0.1,function(){ 
			  $(this).html('TÃªn Ä‘Äƒng nháº­p cÃ³ thá»ƒ sá»­ dá»¥ng').addClass('messageboxok').fadeTo(900,1);	
			});
			document.getElementById("checkuser").value="true";
		  }
        });
	});
});
 </script>
  <form id="frm_action" name="frm_action" method="post" action="">
    <fieldset>
	<legend><strong>ThÃ´ng tin tÃ i khoáº£n ngÆ°á»�i dÃ¹ng</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr><td colspan="2">CÃ¡c má»¥c Ä‘Ã¡nh dáº¥u <font color="red">*</font> lÃ  thÃ´ng tin báº¯t buá»™c</td></tr>
      <tr>
        <td width="160" align="right" bgcolor="#EEEEEE"><strong>TÃªn Ä‘Äƒng nháº­p<font color="red"> *</font></strong></td>
        <td width="788">
          <input name="txtusername" type="text" id="txtusername" size="30" class="required" minlength="3"/>
          <span id="msgbox" style="display:none"></span>
          <input type="hidden" name="checkuser" id="checkuser" value="" />
          <input name="txttask" type="hidden" id="txttask" value="1" />
          </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Máº­t kháº©u<font color="red"> *</font></strong></td>
        <td>
          <input name="txtpassword" type="password" id="txtpassword" size="30" class="required"/>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Nháº­p láº¡i máº­t kháº©u <font color="red">*</font></strong></td>
        <td><input name="txtrepass" type="password" id="txtrepass" size="30" class="required" /></td>
      </tr>
    </table>
    </fieldset>
    <fieldset>
	<legend><strong>ThÃ´ng tin ngÆ°á»�i dÃ¹ng</strong></legend>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="170" align="right" bgcolor="#EEEEEE"><strong>Há»� & Ä‘á»‡m</strong><font color="red"> *</font></strong></td>
        <td width="246"><strong><input name="txtfirstname" type="text" id="txtfirstname" size="30" class="required"/>
         
          </strong></td>
        <td width="191" align="right" bgcolor="#EEEEEE"><strong>NgÃ y sinh&nbsp;</strong></td>
        <td width="297"><input type="text" name="txtbirthday" id="txtbirthday" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>TÃªn <font color="red">*</font></strong></td>
        <td> <input name="txtlastname" type="text" id="txtlastname" size="30" class="required"/></td>
        <td align="right" bgcolor="#EEEEEE"><strong>Giá»›i tÃ­nh&nbsp;</strong></td>
        <td>
          <input type="radio" name="optgender" value="0" checked="checked" />Nam
          <input type="radio" name="optgender" value="1" />N&#7919;</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Ä�á»‹a chá»‰ &nbsp;</strong></td>
        <td><label>
          <input name="txtaddress" type="text" id="txtaddress" size="30" />
        </label></td>
        <td align="right" bgcolor="#EEEEEE"><strong>Ä�iá»‡n thoáº¡i bÃ n&nbsp;</strong></td>
        <td><input type="text" name="txtphone" id="txtphone" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Email&nbsp;</strong></td>
        <td><input name="txtemail" type="text" id="txtemail" size="30" class="required email"/></td>
        <td align="right" bgcolor="#EEEEEE"><strong>Ä�iá»‡n thoáº¡i di Ä‘á»™ng&nbsp;</strong></td>
        <td><input type="text" name="txtmobile" id="txtmobile" class="required"/></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>NhÃ³m quyá»�n <font color="red">*</font></strong></td>
        <td>
        <select name="cbo_gmember" id="cbo_gmember">
        	<option value="0" style="font-weight:bold; background-color:#cccccc">Chá»�n nhÃ³m quyá»�n</option>
			<?php 
			 if(!isset($obju)) $obju = new CLS_GUSER();
			  $obju->getListGmem(0,1); 
			  unset($obju);
			?>
        </select>
        </td>
        <td align="right" bgcolor="#EEEEEE"><strong>TÃ¬nh tráº¡ng &nbsp;</strong></td>
        <td><input name="optactive" type="radio" value="1" checked /> Active
          <input name="optactive" type="radio" value="0" /> Deactive</td>
      </tr>
    </table>
      <label>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
      </label>
    </fieldset>
  </form>
</div>
<?php }?>