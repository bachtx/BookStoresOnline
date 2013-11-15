<?php
ini_set('display_errors', '1');
defined("ISHOME") or die("Can't acess this page, please come back!");
$memid="";
if(isset($_GET["id"]))
	$memid=(int)$_GET["id"];

if(  $memid!=$_SESSION['IGFUSERID']){
	echo ('<div id="action" style="background-color:#fff"><h3 align="center">Báº¡n khÃ´ng cÃ³ quyá»�n truy cáº­p. <a href="index.php">Vui lÃ²ng quay láº¡i trang chÃ­nh</a></h3></div>');
} else {

if(!isset($objmember)) $objmember = new CLS_USERS(); 

if(isset($_POST["txtnewpass"])) {
	$user = $_POST["txtusername"];
	$newpass = $_POST["txtnewpass"];
	$result = $objmember->ChangePass_User($user,$newpass);
	if($result) {
		echo '<div id="action"><h3 style="color:#3399FF">Máº­t kháº©u Ä‘Ã£ Ä‘Æ°á»£c Ä‘á»•i thÃ nh cÃ´ng !</h3></div>';
	}
	else
		echo '<div id="action"><h3 style="color:red">Lá»—i trong quÃ¡ trÃ¬nh lÆ°u trá»¯. Máº­t kháº©u chÆ°a Ä‘Æ°á»£c Ä‘á»•i.</h3></div>';
}
$objmember->getMemberByID($memid);
?>
<script language="javascript">
  function checkinput(){
	  if($("#txtpassword").val()==''){
	  	$("#pass_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Vui lÃ²ng nháº­p máº­t kháº©u Ä‘ang sá»­ dá»¥ng hiá»‡n táº¡i').addClass('check_error').fadeTo(900,1);
		})
		$("#txtpassword").focus();
		return false;
	  }
	  if($("#txtnewpass").val()==''){
	  	$("#newpass_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Vui lÃ²ng nháº­p máº­t kháº©u má»›i').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass").focus();
		return false;
	  }
	  if($("#txtnewpass2").val()==''){
	  	$("#newpass2_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Vui lÃ²ng nháº­p láº¡i máº­t kháº©u má»›i láº§n 2').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass2").focus();
		return false;
	  }
	  if($("#txtnewpass").val()!='' && $("#txtnewpass2").val()!='' && $("#txtnewpass").val()!=$("#txtnewpass2").val() ){
	  	$("#newpass2_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Máº­t kháº©u má»›i nháº­p 2 láº§n khÃ´ng khá»›p nhau. Vui lÃ²ng nháº­p chÃ­nh xÃ¡c.').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass2").focus();
		return false;
	  }
	  return true;
  }
</script>
<div id="action">
<form method="post" action="#" name="frm_action" id="frm_action">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr><td colspan="2">CÃ¡c má»¥c Ä‘Ã¡nh dáº¥u <font color="red">*</font> lÃ  thÃ´ng tin báº¯t buá»™c</td></tr>
      <tr>
        <td width="235" align="right" bgcolor="#EEEEEE"><strong>TÃªn Ä‘Äƒng nháº­p<font color="red"> *</font></strong></td>
        <td width="750">
          <input name="txtusername" type="text" class="required" id="txtusername" value="<?php echo $objmember->UserName;?>" minlength="3"<?php if($objmember->isAdmin()==false) echo '  readonly="readonly"';?>/>
          <span id="msgbox" style="display:none"></span>
          <input type="hidden" name="checkuser" id="checkuser" value="" />
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Máº­t kháº©u hiá»‡n táº¡i <font color="red">*</font></strong></td>
        <td>
		<?php //if($objmember->isAdmin()==true) { ?>
        <input type="password" name="txtpassword" id="txtpassword" value="<?php echo $objmember->Password;?>" readonly/> 
        <?php //} else { ?>
<!--         <input type="password" name="txtpassword" id="txtpassword" class="required" value=""/> -->
        <?php //} ?>
        <label id="pass_error" class="check_error"></label>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Máº­t kháº©u má»›i <font color="red">*</font></strong></td>
        <td><input type="password" name="txtnewpass" id="txtnewpass" class="required" value=""/>
        <label id="newpass_error" class="check_error"></label>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Nháº­p láº¡i máº­t kháº©u má»›i <font color="red">*</font></strong></td>
        <td><input type="password" name="txtnewpass2" id="txtnewpass2" class="required"/>
        <label id="newpass2_error" class="check_error"></label>
        </td>
      </tr>
    </table>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
</form>
</div>
<?php }?>