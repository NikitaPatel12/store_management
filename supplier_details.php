
<?php
//$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
require_once 'base/verify_login.php';
require_once 'store_common.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
menu($link);
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo'<div class="container">
	<div class="row">
	<div class="col-*-12 mx-auto">
	<form method=post>
	<table class="table table-striped table-bordered"  align="center">
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<tr class="bg-dark text-danger" align="center"><th colspan="2" align="center"><h3>Supplier Details</h3></th></tr>
	<tr>
	<!--<td>Supplier ID:</td><td><input type="number" name="supplier_id" placeholder="Enter supplier ID"></td></tr>-->
	<tr><td><b>Supplier Name:</b> </td><td><input type="text" name="supplier_name" placeholder="Enter supplier Name"></td></tr>
	<tr><td><b>Phone Number:</b></td><td><input type="text" length="12" name="phone_no" placeholder="Enter supplier Phone Number"></td></tr>
	<tr><td><b>Address:</b></td><td><input type=textarea  rows="5" cols="50" name="address" placeholder="Enter supplier Address"></td></tr>
	<tr><td><b>GST No:</b></td><td><input type="text" length="15" name="supplier_gst_no" placeholder="Enter supplier GST Number"></td></tr>
	<tr><td colspan="2" align="center"><button class="btn btn-success"  type=submit name=action value=supplier_save>save</td></tr>
	</table>
	</form>
	</div>';
	//print_r($_POST);
	
if($_POST['action']=='supplier_save')
{
	insert_supplier_details($link,'deadstock','supplier',$_POST);
	
	$last=last_autoincrement_insert($link);
	
}
?>
