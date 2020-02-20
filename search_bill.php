
<?php

require_once 'base/verify_login.php';

//never include head(), it is called by verify_login.php
////////User code below/////////////////////	

require_once 'store_common.php';
//require_once 'new_bill.php';
//require_once 'edit_bill.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
menu($link);
//print_r($_POST);

if($_POST['action']=='search_bill')
{
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo'<div class="container" >
				<div class="row">
				<div class="col-*-6 mx-auto">';
	echo '<form method=post>
			<table class="table table-bordered" align="center">
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			<tr class="table-info"><th colspan="2" align="center">Bill Details</th></tr>
			<tr>
			<td>Bill No :</td>
			<td><input type="text" name="bill_no" placeholder="Enter Bill Number">&nbsp;&nbsp;
			<input type="checkbox"  name="chk_bill_no"></td></tr>

			<tr><td>Supplier Name:</td><td>';
			get_supplier_id($link);
	//echo'&nbsp;&nbsp;<input type="checkbox" name="chk_supplier_name"></td></tr>';
	/////////////////////////////////////////////////////
			echo'&nbsp;&nbsp;<input type="checkbox" name="chk_supplier_id"></td></tr>';
	////////////////////////////////////////////////////////////
			echo'<tr><td>Order Number:</td><td><input type="text" name="order_no" placeholder="Enter Order Number">&nbsp;&nbsp;<input type="checkbox" name="chk_order_no"></td></tr>
			<tr><td>Bill Date:</td><td><input type="date" name="bill_date" >&nbsp;&nbsp;<input type="checkbox" name="chk_bill_date"></td></tr>
			<tr><td>Bill Receive Date:</td><td><input type="date" name="bill_receive_date" >&nbsp;&nbsp;<input type="checkbox" name="chk_bill_recieve_date"></td></tr>
			<!--<tr><td>SGST:</td><td><input type="text"  name="sgst" placeholder="Enter SGST Amount"></td></tr>
			<tr><td>CGST:</td><td><input type="text"  name="cgst" placeholder="Enter CGST Amount"></td></tr>
			<tr><td>IGST:</td><td><input type="text"  name="igst" placeholder="Enter IGST Amount"></td></tr>
			<tr><td>Bill Discount :</td><td><input type="text"  name="discount" placeholder="Enter Bill Discount"></td></tr>-->
			<tr><td></td><td><button class="btn btn-primary"  type=submit name=action  name=search_Bill value=search>Search</td></tr>
			<!--<tr><td></td><td><button class="btn btn-primary"  type=submit name=action value=add_item>Add Item</td></tr>-->
	
		</table>
	</form>
	</div>';

}
echo'</br>';
echo'</br>';
echo'</br>';
echo'</br>';
if($_POST['action']=='search')
{
	search_bill($link);	
}
///////////////////////////////////////////////////////////////////////
if(isset($_POST['action']))
{
	//$item_type_id =isset($_POST['item_type_id'])? $_POST['item_type_id'] : '';
	if($_POST['action']=='edit_bill')
	{
			edit_bill($link,$_POST['bill_id']);
			if(isset($_POST['item_type_id']))
			{
				edit_bill_i($link,$_POST['bill_id'],$_POST['item_type_id']);
			}
			
			else
			{
				edit_bill_i($link,$_POST['bill_id'],0);	
							
			}
			read_one_item($link,$_POST['bill_id']);	
			while($_POST['action']=='item_save')
			{
			read_one_item($link,$_POST['bill_id']);	
		}
	}
	/*if($_POST['action']=='add_item')
	{       
		read_one_item($link,$_POST['bill_id']);	
		edit_bill($link,$_POST['bill_id']);
		edit_bill_i($link,$_POST['bill_id']);	
	}*/
	if($_POST['action']=='item_save')
	{
		read_one_item($link,$_POST['bill_id']);
		edit_bill($link,$_POST['bill_id']);
		insert_item($link,'deadstock','item',$_POST);
				
		edit_bill_i($link,$_POST['bill_id']);
					//edit_info_i($link, $_POST['bill_id'],$_POST['item_type_id']=0);
	}
	if($_POST['action']=='edit_info')
	{
			edit_info($link,$_POST['bill_id']);
			display_all_items($link,$_POST['bill_id']);
			calculate_all($link,$_POST['bill_id']);
	}
	
	/*if($_POST['action']=='edit_info_i')
	{
		display_bill_header($link,$_POST['bill_id']);
		edit_info_i($link,$_POST['bill_id'],$_POST['item_type_id']);
	}*/
	
	if($_POST['action']=='delete_b')
	{
		delete_b($link,$_POST['bill_id']);	
		edit_bill_i($link,$_POST['bill_id']);
	}

	if($_POST['action']=='delete_i')
	{
		//edit_bill($link,$_POST['bill_id']);
		//edit_bill_i($link,$_POST['bill_id']);
			delete_i($link,$_POST['bill_id'],$_POST['item_type_id']);
			edit_bill($link,$_POST['bill_id']);
			edit_bill_i($link,$_POST['bill_id'],$_POST['item_type_id']);	
	}
	if($_POST['action']=='save')
	{
		update_bill($link);
		display_bill_header($link,$_POST['bill_id']);
		display_all_items($link,$_POST['bill_id']);
		calculate_all($link,$_POST['bill_id']);
	}
	elseif($_POST['action']=='save1')
	{
		update_item($link);	
		edit_bill($link,$_POST['bill_id']);
		edit_bill_i($link,$_POST['bill_id']);
		//edit_info_i($link,$_POST['bill_id'],$_POST['item_type_id']);
		//display_bill_header($link,$_POST['bill_id']);
		//display_all_items($link,$_POST['bill_id'],$_POST['item_type_id']);
		calculate_all($link,$_POST['bill_id'],$_POST['item_type_id']);
	}
	else
	{
		return;
	}
	
	
}	
///////////////////////////////////////////////hhhhhhhhhhhhhhtgf///////////////
?>

