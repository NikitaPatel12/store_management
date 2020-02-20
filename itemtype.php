<?php

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
	<table class="table  table-striped table-bordered"  align="center">
	<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
	<tr class="bg-info text-dark"><th colspan="2" ><h3>Item Details</h3></th></tr>
	<tr>
	<td><b>Item Name:</b></td><td><input type="text" name="item_name" placeholder="Enter Item Name"></td></tr>
	<tr><td> <b>HSN Code:</b></td><td><input type="text" name="hsn_code" placeholder="Enter HSN code"></td></tr>	
	<tr><td colspan="2" align="center"><button class="btn btn-success"  type=submit name=action  value=itemtype_save>save</td></tr>
	</table>
	</form>
	</div>';
//print_r($_POST);

if($_POST['action']=='itemtype_save')
{
	insert_itemtype_details($link,'deadstock','item_type',$_POST);
	
	$last=last_autoincrement_insert($link);
	
}

?>
