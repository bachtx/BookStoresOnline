<?php
include('libs/cls.contacts.php');
$contact= new CLS_CONTACTS();
$regexp = "/^[A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
$send=0;
if(isset($_POST['submit'])){
	if(empty ($_POST['name'])) {echo "<script>alert('Please type your name.');</script>";}
	else if(empty ($_POST['email'])) {echo "<script>alert('Please type your email.');</script>";}
	else if (!preg_match($regexp, $_POST['email'])) {echo "<script>alert ('This is not an email address. Please type in your real email.');</script>";}
	else if($_POST['reason']=='------ Please select a reason') {echo "<script>alert('Please choose a reason.');</script>";}
	else if(empty ($_POST['message'])) {echo "<script>alert('Please type your message.');</script>";}
	else if(empty ($_POST['txt_sercurity'])) {echo "<script>alert('You must type in the security code.');</script>";}
	else if($_SESSION['SERCURITY_CODE']!=$_POST['txt_sercurity']) {echo "<script>alert('You entered a wrong security code. Please try again.');</script>";}
	else {
		$contact->email=$_POST['email'];
		$contact->name=$_POST['name'];
		$contact->reason=$_POST['reason'];
		$contact->subject=$_POST['subject'];
		$contact->message=$_POST['message'];
		
		//$contact->sendmail();
		include('extensions/phpmailer/sendmail.php');
	}
}

?>
<div class="detail_jumlink">
	<p>Home  <span class="bg_jumlink"></span>  <?php echo 'Contacts';?> </p>
</div><!--detail_jumlink-->
<div class="main_wrap">
	<div class="sidebar">
		<h3>Categories</h3>
		<?php
			$catalogs=new CLS_CATALOGS();
			$catalogs->getListCatalogs();
		?>
	</div><!--sidebar-->
	<div class="primary" id = "product_page">
		<div class='contact_page'><br/>
			<p>This is the <b><i>BookStores Online</i></b> support team. Please feel free to contact us via the information below or send us an a message.  We will be happy to receive your message of all kinds.</p><br/>
			<p>For us to help you or execute your requests easier, please choose a reason below. You may either ask any question about us, our policy, or anything related to the order and transaction process that you are not sure; give us a feedback; or introduce us your book or any book to store on this site; or anything else. All will be appreciated.</p><br/>
			<p>----------------------------------</p>
			<p class='name'> BookStore Online</p>
				<table name='intro'>
					<tr>
						<td class='bold'>Address</td>
						<td >: 12Ath Floor, LADECO Building, 266 Doi Can, Ha Noi, Vietnam</td>
					</tr>
					<tr>
						<td class='bold'>Telephone</td>
						<td>: (+84-4)  3514 9883  </td>
					</tr>
					<tr>
						<td class='bold'>Email</td>
						<td>: ngabt@smartosc.com </td>
					</tr>
					<tr>
						<td class='bold'>Website</td>
						<td>: http://wwww.bookstores.heliohost.com</td>
					</tr>
				</table>	
			<div class='mess'>
				<p class='title'>Send a message</p>
				<br/>
				<form method='post' action=''>
				<table>
					<tr>
						<td>Your Name: <span>*</span></td>
						<td><input type='text' name='name'></td>
					</tr>
					<tr>
						<td>Your Email: <span>*</span></td>
						<td><input type='text' name='email'></td>
					</tr>
					<tr>
						<td>Reason: <span>*</span></td>
						<td>
							<select name='reason'>
								<option>------ Please select a reason</option>
								<option>Feedback</option>
								<option>Questions</option>
								<option>Submission</option>
								<option>Other</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Subject: <span>*</span></td>
						<td><input type='text' name='subject'></td>
					</tr>
					<tr>
						<td>Message: <span>*</span></td>
						<td><textarea name='message'></textarea></td>
					</tr>
					<tr>
					  <td align="right">Security Code: <span>*</span></td>
					  <td>
							<input style="float:left;" type="text" size="7" name="txt_sercurity" id="txt_sercurity" class="text" AUTOCOMPLETE="off" width="40px"/> 
						  <img src="extensions/captcha/CaptchaSecurityImages.php?width=75&height=24" align="left" alt="" height="28px;"/><br/>
						  
					  </td>
					</tr>
					<tr>
						<td></td><td><input type='submit' name='submit' value='Send'></td>
					</tr>
				</table>
				</form>
			</div><!--mess-->
		</div><!--.contact_page-->
	</div><!--.primary-->
</div><!--.main_wrapp-->


