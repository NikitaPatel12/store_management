<?php
//$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';

//never include head(), it is called by verify_login.php
////////User code below/////////////////////	

require_once 'store_common.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);


menu($link);

if($_POST['action']=='new_general')
{
// get_sql($link);
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';

echo'<div class="container">
	 <div class="row">
	 <div class="col-*-6 mx-auto">
	<form method=post>
	<table class="table table-striped table-bordered" align="center">
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<tr class="table-warning" align="center"><th colspan="2"><h3>Bill Details</h3></th></tr>
	<tr>
	<td>Bill No :</td><td><input type="text" name="bill_no" placeholder="Enter Bill Number"></td></tr>
	<tr><td>Bill Date:</td><td><input type="date" name="bill_date" ></td></tr>
	<tr><td>Bill Receive Date:</td><td><input type="date" name="bill_receive_date" ></td></tr>
	<tr><td>Supplier Name:</td><td>';
	get_supplier_id($link);
	echo'</td></tr>
	<tr><td>Order Number:</td><td><input type="text" name="order_no" placeholder="Enter Order Number"></td></tr>
	<tr><td>Order Date:</td><td><input type="date" name="order_date" ></td></tr>
	
	<tr><td>SGST:</td><td><input type="text"  name="sgst" placeholder="Enter SGST Amount"></td></tr>
	<tr><td>CGST:</td><td><input type="text"  name="cgst" placeholder="Enter CGST Amount"></td></tr>
	<tr><td>IGST:</td><td><input type="text"  name="igst" placeholder="Enter IGST Amount"></td></tr>
	<tr><td>Bill Discount :</td><td><input type="text"  name="discount" placeholder="Enter Bill Discount"></td></tr>
	<tr><td></td><td><button class="btn btn-success" type=submit name=action value=bill_save  >save</td></tr>
	</table>
	</form>
	</div>';
}
//////////////user code ends////////////////
if($_POST['action']=='bill_save')
{
	insert_bill($link,'deadstock','bill',$_POST);
	$last=last_autoincrement_insert($link);
	
	display_bill_header($link,$last);
	read_one_item($link,$last);
	//display_all_items($link,$_POST['bill_id']);
	//code for reading bill data
}

if($_POST['action']=='item_save')
{
	
	insert_item($link,'deadstock','item',$_POST);
	
	display_bill_header($link,$_POST['bill_id']);
	read_one_item($link,$_POST['bill_id']);
	display_all_items($link,$_POST['bill_id']);
	calculate_all($link,$_POST['bill_id']);
	//code for reading item data
}






//print_r($_POST);
tail();
?>
