
<?php
require_once 'base/verify_login.php';
require_once 'common.php';
//$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
echo'<div class="container">
	<table class=table table-bordered border="2" align="center">
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<tr><th  colspan="2" align="center">Department Details</th></tr>
	<tr>
	<td>Item Unit Price:</td><td><input type="text" name="unit_price" placeholder="Enter Price"></td></tr>
	<tr><td>Quantity:</td><td><input type="text" name="quantity" placeholder="Enter Quantity"></td></tr>
	<tr><td>Date of Reciept:</td><td><input type="date" name="date_of_reciept" ></td></tr>
	<tr><td>Date of Installation:</td><td><input type="date" name="date_of_installation" ></td></tr>
	<tr><td>Register Name:</td><td><input type="text" name="reg_name" placeholder="Enter Reigster Name"></td></tr>
	<tr><td>Register Page Number:</td><td><input type="text" name="reg_page_no" placeholder="Enter Reigster Page No."></td></tr>
	<tr><td></td><td><button  type=submit name=action value=bill_save  name=bill_save value=save>save</td></tr>
	</table>';



?>

