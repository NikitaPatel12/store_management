<?php

require_once 'base/verify_login.php';

//never include head(), it is called by verify_login.php
////////User code below/////////////////////	

require_once 'store_common.php';
$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
menu($link);


///////////

		/*echo'<div class="container">
			 <form method=post>
			 <br>
			 <table align="center">
			 <input type=hidden name=session_name value=\''.$_POST['session_name'].'\'> 
			 <tr><td><b>Bill ID:</b></td><td><input type="text" name=bill_id>&nbsp;&nbsp;<button class= "btn btn-success" type="submit" name=action value="edit_bill">Enter</td></tr>';			
		echo '</table></form></div><br>';


print_r($_POST);
;*/

//if(isset($_POST['item_type_id'])){
   //$item_type_id = $_POST['item_type_id'];
//}
if(isset($_POST['action']))
{
	//$item_type_id =isset($_POST['item_type_id'])? $_POST['item_type_id'] : '';
	/*if($_POST['action']=='edit_bill')
	{
			edit_bill($link,$_POST['bill_id']);
			edit_bill_i($link,$_POST['bill_id']);
	}*/
	
	if($_POST['action']=='edit_info')
	{
			edit_info($link,$_POST['bill_id']);
	}
	
	if($_POST['action']=='edit_info_i')
	{
		edit_info_i($link,$_POST['bill_id'],$_POST['item_type_id']);
	}
	
	if($_POST['action']=='delete_b')
	{
		delete_b($link,$_POST['bill_id']);	
	}
	if($_POST['action']=='delete_i')
	{
			delete_i($link,$_POST['bill_id'],$_POST['item_type_id']);
			//delete_i($link,$bill_id,$item_type_id);	
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
		//edit_info($link,$_POST['bill_id']);
		edit_info_i($link,$_POST['bill_id'],$_POST['item_type_id']);
		display_bill_header($link,$_POST['bill_id']);
		display_all_items($link,$_POST['bill_id'],$_POST['item_type_id']);
		calculate_all($link,$_POST['bill_id'],$_POST['item_type_id']);
	}
	else
	{
		return;
	}
	
}	


?>

