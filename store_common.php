<?php


function menu()
{

	echo '
		<div class="dropdown btn-group m-0 p-0">
		<form method=post class="form-group m-0 p-0">
			<input type=hidden name=session_name value=\''.session_name().'\'>
			<button class="btn btn-primary " formaction=new_bill.php type=submit name=action value=new_general><b>New Bill</b></button>
			<button class="btn btn-primary " formaction=search_bill.php type=submit name=action value=search_bill><b>Search Bill</b></button>
			<!--<button class="btn btn-primary " formaction=edit_bill.php type=submit name=action value=start_edit_bill><b>Edit Bill</b></button>-->
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><b>New</b></button>
			<div class="dropdown-menu">		
					<button class="btn btn-link "  formaction=supplier_details.php type=submit name=action value=supplier>Supplier Details</button><hr>
					<button class="btn btn-link "  formaction=itemtype.php type=submit name=action value=item>Item Details</button>
			</div>
			
		</form>
	</div>';	
		
}

/////// supplier name ////

function get_supplier_id($link)
{
	    if(!$result=run_query($link,'deadstock','select id,supplier_name from supplier order by id'))
        {
			return false;
		}
   echo '<select name=supplier_id>';
   while($ar=mysqli_fetch_assoc($result))
   { 
	 echo '<option value=\''.$ar['id'].'\'>'.$ar['supplier_name'].'</option>';
   }
   echo '</select>';
}

/////// item name ////////

function get_item_id($link)
{
	if(!$result=run_query($link,'deadstock','select * from item_type order by item_type_id'))
    {
		return false;
	}
    echo '<select name=item_type_id>';
    while($ar=mysqli_fetch_assoc($result))
    {
       echo '<option value=\''.$ar['item_type_id'].'\'>'.$ar['item_name'].'</option>';
    }
    echo '</select>';
}
function insert_bill($link,$d,$t,$post)
{ 
	$sql='INSERT INTO '.$t.'(bill_no,supplier_id,order_no,bill_date,bill_recieve_date,sgst,cgst,igst,discount) 
		  VALUES (\''.$_POST['bill_no'].'\',\''.$_POST['supplier_id'].'\',\''.$_POST['order_no'].'\',\''.$_POST['bill_date'].'\',\''.$_POST['bill_receive_date'].'\',\''.$_POST['sgst'].'\',\''.$_POST['cgst'].'\',\''.$_POST['igst'].'\',\''.$_POST['discount'].'\')';

	$result=run_query($link,$d,$sql);

    if($result==false)
	{
		echo '<h3 class="text-danger">No record inserted</h3>';
	}
	else
	{
		echo '<h3 class="text-success">Record Saved Successfully</h3>';
	}
	
}	
//////////////////  Insert Item    ///////////////	

function read_one_item($link,$bill_id)
{

echo'<div class="container">';
	echo' <div class="row">';
	echo'<div class="col-*-12 mx-auto">';
		echo '<form method=post>
			<table class="table table-striped table-bordered" align="center">
			<input type=hidden name=session_name value=\''.session_name().'\'>
			<br>
				<tr class="bg-dark text-primary"><th colspan="2" align="center"><h3>Item</h3></th></tr>
				<tr><td> Bill ID:</td><td>';
echo '<input type=text readonly name=bill_id value=\''.$bill_id.'\'>';
echo'</td></tr>
		<tr><td> Item Name:</td><td>';
		get_item_id($link);
echo'</td></tr>
		<tr><td> Challan No:</td><td><input type="text" name="challan_no" placeholder="Enter Challan No seprated by comas"></td></tr>
		<tr>
		<td>Item Unit Price:</td><td><input type="text" name="unit_price" placeholder="Enter Price"></td></tr>
		<tr><td>Quantity:</td><td><input type="text" name="quantity" placeholder="Enter Quantity"></td></tr>
		<tr><td></td><td><button class="btn btn-info " type=submit name=action value=item_save>Item Save</td></tr>
	
	</table>
	</form>
	<!--</div>
	</div>-->
	</div>';
	
}

function insert_item($link,$d,$t,$post)
{ 
	$sql='INSERT INTO '.$t.'(bill_id,item_type_id,challan_no,unit_price,quantity) 
		  VALUES (\''.$_POST['bill_id'].'\',\''.$_POST['item_type_id'].'\',\''.$_POST['challan_no'].'\',\''.$_POST['unit_price'].'\',\''.$_POST['quantity'].'\')';
 
	$result=run_query($link,$d,$sql);
	
    if($result==false)
	{
		echo '<h3 style="color:red;">No record inserted</h3>';
	}
	else
	{
		echo '<h3 style="color:green;">Record Saved Successfully</h3>';
	}
}
function insert_supplier_details($link,$d,$t,$post)
{
	$sql='insert into '.$t.'(supplier_name,phone_no,address,supplier_gst_no)
			values (\''.$_POST['supplier_name'].'\', \''.$_POST['phone_no'].'\', \''.$_POST['address'].'\', \''.$_POST['supplier_gst_no'].'\')';
	//echo $sql;
	$result=run_query($link,$d,$sql);
	if($result==false)
	{
		echo '<h3 style="color:red;">No record inserted</h3>';
	}
	else
	{
		echo '<h3 style="color:green;">Record Saved Successfully</h3>';
	}
}
function insert_itemtype_details($link,$d,$t,$post)
{
	$sql='insert into '.$t.'(item_name, hsn_code) values (\''.$_POST['item_name'].'\', \''.$_POST['hsn_code'].'\')';
//echo $sql;
	$result=run_query($link,$d,$sql);
	if($result==false)
	{
		echo '<h3 style="color:red;">No record inserted</h3>';
	}
	else
	{
		echo '<h3 style="color:green;">Record Saved Successfully</h3>';
	}
}

function display_bill_header($link,$bill_id)
{
	$sql='select * from bill where bill_id=\''.$bill_id.'\'';
	
	$result=run_query($link,'deadstock',$sql);
	
	//print_r($ar);
	
	
	
	echo '<table class="table table-bordered">
		<thead class="thead-light">

		<tr>

		<th>Bill Id</th>

		<th>(ID)Supplier Name</th>

		<th>Bill No</th>
		
		<th>Order No</th>

		<th>Bill Date</th>
		
		<th>Bill Recieve Date</th>
		
		<th>SGST</th>
		
		<th>CGST</th>
		
		<th>IGST</th>
		
		<th>Discount</th>
		
		
		</tr>
		
		</thead>';
		
		//////////////
		
/////////////////////////


		
	while($row=get_single_row($result))
	{
		$sql='select supplier_name from supplier where id=\''.$row['supplier_id'].'\'';
		
		$result=run_query($link,'deadstock',$sql);
		
		$ar=get_single_row($result);
		//print_r($ar);
		echo '<tr>';

		echo '<td>' . $row['bill_id'] . '</td>';
		
		echo '<td>' .'('. $row['supplier_id'] .')' .$ar['supplier_name'].'</td>';

		echo '<td>' . $row['bill_no'] . '</td>';
		
		echo '<td>' . $row['order_no'] . '</td>';

		echo '<td>' . $row['bill_date'] . '</td>';
		
		echo '<td>' . $row['bill_recieve_date'] . '</td>';
		
		echo '<td>' . $row['sgst'] . '</td>';
		
		echo '<td>' . $row['cgst'] . '</td>';
		
		echo '<td>' . $row['igst'] . '</td>';
		
		echo '<td>' . $row['discount'] . '</td>';
		
		echo '</tr>';
	
	}	
	
}

function display_all_items($link,$bill_id)
{
	
	echo '<table class="table table-bordered" >
	
		<thead class="thead-light">

		<tr>

		<th>Bill Id</th>

		<th> (Item ID)Item Name</th>

		<th>Challan No</th>

		<th>Item Unit Price</th>
		
		<th>Quantity</th>
		
		<th>Total</th>

		</tr>
		
		</thead>';
		
		$sql='select * from item where bill_id=\''.$bill_id.'\'';
		
		$result=run_query($link,'deadstock',$sql);
		
		
		while($row=get_single_row($result))
		{
			echo '<tr>';

			echo '<td>' . $row['bill_id'] . '</td>';

			echo '<td>' .'('. $row['item_type_id'] . ')' .get_item_name($link,$row['item_type_id']).'</td>';

			echo '<td>' . $row['challan_no'] . '</td>';

			echo '<td>' . $row['unit_price'] . '</td>';
		
			echo '<td>' . $row['quantity'] . '</td>';
			
			echo '<td>' .($row['unit_price']*$row['quantity']) . '</td>';
			
			echo '</tr>';
		}
}

function calculate_all($link,$bill_id)
{
	$sql_bill='select * from bill where bill_id=\''.$bill_id.'\'';
	$result_bill=run_query($link,'deadstock',$sql_bill);
	$bill_details=get_single_row($result_bill);
	
	$sgst=$bill_details['sgst'];
	$cgst=$bill_details['cgst'];
	$igst=$bill_details['igst'];
	$discount=$bill_details['discount'];
	
	$sql_item='select * from item where bill_id=\''.$bill_id.'\'';
	$result_item=run_query($link,'deadstock',$sql_item);
	$item_total=0;
	while($item_details=get_single_row($result_item))
	{
		$item_total=$item_total+$item_details['unit_price']* $item_details['quantity'];		
	}
	ECHO'<div class="container">
			<div class="row">
			<div class="col mx-auto">';
	echo '<table class="table table-bordered table-striped">
			<tr>
				<td>Total Amount Before Tax</td>
				<td>'.$item_total.'</td>
			</tr>
			<tr>
				<td>Total Tax Value</td>
				<td>'.($sgst+$cgst+$igst).'</td>
			</tr>
			<tr>
				<td>Total Amount After Tax</td>
				<td>'.($item_total+$sgst+$cgst+$igst).'</td>
			</tr>			
			<tr>
				<td>Discount</td>
				<td>'.($discount).'</td>
			</tr>
			<tr>
				<td>Net Amount</td>
				<td>'.round($item_total+$sgst+$cgst+$igst-$discount).'</td>
			</tr>						
	</table>';
	ECHO'</div>';
	
}

function get_item_name($link,$item_type_id)
{
		$sql='select item_name from item_type where item_type_id=\''.$item_type_id.'\'';
		$result=run_query($link,'deadstock',$sql);
		$ar=get_single_row($result);	
		return $ar['item_name'];
}

function display_bill($link,$bill_id)
{
	display_bill_header($link,$bill_id);
	display_all_items($link,$bill_id);
	calculate_all($link,$bill_id);
}
function search_bill($link)
{
	$where='';
	if(isset($_POST['chk_bill_no']))
	{
		$where=$where . ' bill_no like \'%'.$_POST['bill_no'].'%\' and ';
	}
	if(isset($_POST['chk_order_no']))
	{
		$where=$where.' order_no like \'%'.$_POST['order_no'].'%\' and ';
	}
	if(isset($_POST['chk_supplier_id']))
	{
		$where=$where.' supplier_id like \'%'.$_POST['supplier_id'].'%\' and ';
	}
	if(isset($_POST['chk_bill_date']))
	{
		$where=$where.' bill_date like \'%'.$_POST['bill_date'].'%\' and ';
	}
	if(isset($_POST['chk_bill_receive_date']))
	{
		$where=$where.' bill_receive_date like \'%'.$_POST['bill_receive_date'].'%\' and ';
	}
	//echo $where;
	if(strlen($where)>1)
	{
		//echo $where.':one<br>';
		$where=substr($where,0,-4);
		//echo $where.':two<br>';
		$sql='select * from bill where ';
		$sql=$sql.$where;	
		//echo $sql.':threeeeeeeee<br>';
	}
	else
	{
		echo 'Give some condition';
	}

		$result=run_query($link,'deadstock',$sql);	
		/*while($row=get_single_row($result))
		{
			//echo '<pre>';print_r($row);
			display_bill($link,$row['bill_id']);
		}*/
		
		/////////////////////////////////////////////////jdfhjhk/////////////
		
		while($row=get_single_row($result))
		{
			search_bill_edit($link,$row['bill_id']);
		}
		//////////////
		
		/*while($row=get_single_row($result))
		{
			
		edit_bill($link,$row['bill_id']);
		edit_bill_i($link,$row['bill_id']);
		}*/
////////////////////////	
}
function search_bill_edit($link,$bill_id)
{
$sql='select * from bill where bill_id=\''.$bill_id.'\'';
			$result=run_query($link,'deadstock',$sql);
			//ECHO'</br>';
			echo '<form method=post>';
						echo'<div class="container">
							<div class="row">
							<div class="col mx-auto">';
			//echo '<form method=post>';
			//echo'<div class="container">
					//<div class="row">
					//<div class="col mx-auto">';
					
			echo '<table class="table table-bordered">
					<thead class="thead-light">
					<tr>
					<th>Bill Id</th>
					<th>Bill No</th>
					<th>Supplier ID (Name)</th>
					
					<!--<th>Order No</th>
					<th>Bill Date</th>
					<th>Bill Recieve Date</th>
					<th>SGST</th>
					<th>CGST</th>
					<th>IGST</th>
					<th>Discount</th>-->
					</tr>
					</thead>';
					while($row=get_single_row($result))
					{
						$sql='select supplier_name from supplier where id=\''.$row['supplier_id'].'\'';
						$result=run_query($link,'deadstock',$sql);
						$ar=get_single_row($result);
						//echo'</br>';
			///echo '<br/>';
			//echo '<br/>';
						
						echo'<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
							<input type=hidden name=bill_id value=\''.$row['bill_id'].'\'>';
						echo '<tr>';
						echo '<td>' ;
						echo'<button class="btn btn-link" type=submit name=action value=edit_bill >\''.$row['bill_id'].'\'</button>';
						echo'</td>';
						echo '<td>' . $row['bill_no'] . '</td>';
						echo '<td>' . $row['supplier_id'] . '('.$ar['supplier_name'].')</td>';
						//print_r($row);
						//echo '<td>' . $row['order_no'] . '</td>';
						//echo '<td>' . $row['bill_date'] . '</td>';
						//echo '<td>' . $row['bill_recieve_date'] . '</td>';						
						//echo '<td>' . $row['sgst'] . '</td>';						
						//echo '<td>' . $row['cgst'] . '</td>';						
						//echo '<td>' . $row['igst'] . '</td>';						
						//echo '<td>' . $row['discount'] . '</td>';						
						echo '</tr>';
						echo'</table>';
						echo'</div>
					</div>
			</div>';
						echo'</form>';					
					}
					//print_r($ar);	
		}
function edit_bill($link, $bill_id)
{
	$sql='select * from bill where bill_id=\''.$bill_id.'\'';
	
	$result=run_query($link,'deadstock',$sql);
	
	//print_r($ar);
	echo '</br>';
	echo '</br>';
	echo '</br>';
	echo '<form method=post>
			<div class="container">
			<div class="row">
			<div class="col mx-auto">
		<table class="table table-bordered">
		<thead class="thead-light">

		<tr >
		<th >Action</th>

		<th>Bill Id</th>

		<th>(ID)Supplier Name</th> 

		<th>Bill No</th>
		
	<!--<th>Order No</th>

		<th>Bill Date</th>
		
		<th>Bill Recieve Date</th>
		
		<th>SGST</th>
		
		<th>CGST</th>
		
		<th>IGST</th>
		
		<th>Discount</th>-->
	
		</tr>
		
		</thead>';
	
		
	while($row=get_single_row($result))
	{
		$sql='select supplier_name from supplier where id=\''.$row['supplier_id'].'\'';
		
		$result=run_query($link,'deadstock',$sql);
		
		$ar=get_single_row($result);
		//print_r($row);
		echo '<tr>';
		
		echo'<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
		     <input type=hidden name=bill_id value=\''.$row['bill_id'].'\'>';
		
		echo'<td><button class="btn btn-info" type=submit name=action  value=edit_info ><b>Edit</b></button> 
		<button class="btn btn-danger" type=submit name=action  value=delete_b ><b>X</b></button> </td>';

		echo '<td>' . $row['bill_id'] . '</td>';
		
		echo '<td>' .'('.$row['supplier_id'] . ')'.$ar['supplier_name'].'</td>';

		echo '<td>' . $row['bill_no'] . '</td>';
		
		//echo '<td>' . $row['order_no'] . '</td>';

		//echo '<td>' . $row['bill_date'] . '</td>';
		
		//echo '<td>' . $row['bill_recieve_date'] . '</td>';
		
		//echo '<td>' . $row['sgst'] . '</td>';
		
		//echo '<td>' . $row['cgst'] . '</td>';
		
		//echo '<td>' . $row['igst'] . '</td>';
		
		//echo '<td>' . $row['discount'] . '</td>';
		
		echo '</tr>';
		//echo '<tr>';
		//echo'<td><button class="btn btn-info" type=submit name=action  value=insert_item><b>Add Item</b></button>';
		//echo '</tr>';
		echo '</table>';
		
		echo '</form>';	
	}
}
/////////////////////////////////////////
//////////////////////////////////////
function add_item($link,$bill_id)
{
	echo'<td><button class="btn btn-info" type=submit name=action  value=insert_item><b>Add Item</b></button>';
}
///////////////////////////////////
//////////////////////////////

function edit_bill_i($link, $bill_id,$item_type_id=0)
//function edit_bill_i($link, $bill_id,$item_type_id)
{
	$sql='select * from item where bill_id=\''.$bill_id.'\'';
	
	$result=run_query($link,'deadstock',$sql);
	//echo '</br>';
	
	//print_r($ar);
	/////////////////////////////////
	///echo '<form method=post>
	//echo'<div class="container">
			//<div class="row">
			//<div class="col-*-6 mx-auto">';
	////////////////////////////////
	
		ECHO'<table class="table table-bordered">
		<thead class="thead-light">

		<tr>
		
		<th>Action</th>

		<th>Bill Id</th>
		
		<th>(Item ID) Item Name</th>

		<th>Challan No</th>

		<th>Item Unit Price</th>
		
		<th>Quantity</th>
		
		<th>Total</th>
	
		</tr>
		
		</thead>';
		
echo '<tr>';

///////////////////////////////////////////////////////////464//////////////////////////////
while($row=get_single_row($result))
{
	if($row['item_type_id']!=$item_type_id)
	{
		//echo '<tr>';
		echo'<form method=post>';
		//echo'<div>';
		echo'<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			 <input type=hidden name=bill_id value=\''.$row['bill_id'].'\'>
		     <input type=hidden name=item_type_id value=\''.$row['item_type_id'].'\'>';
		echo'<td><button class="btn btn-info " type=submit name=action value=edit_bill><b>Edit</b></button> 
			 <button class="btn btn-danger " type=submit name=action  value=delete_i ><b>X</b></button> </td>';
		echo '<td>' . $row['bill_id'] . '</td>';
		echo '<td>' .'('. $row['item_type_id'] .')'.get_item_name($link,$row['item_type_id']).'</td>';
		echo '<td>' . $row['challan_no'] . '</td>';
		echo '<td>' . $row['unit_price'] . '</td>';
		echo '<td>' . $row['quantity'] . '</td>';
		echo '<td>' . ($row['unit_price']*$row['quantity']) . '</td>';
		//echo '</div>';	
		echo '</form>';	
		echo '</tr>';
		
	}
	else
	{
		edit_info_i($link,$bill_id,$item_type_id);			
	}
}
echo '</tr>';
//echo '<tr>';
//echo'<td><button class="btn btn-info" type=submit name=action  value=add_item><b>Add Item</b></button>';
//echo '</tr>';
echo '</table>';
echo'</div>';
//////////////////////////////////////////////////////464///////////////
/*
	while($row=get_single_row($result))
	{
		//echo '<tr>';
		if($row['item_type_id']!=$item_type_id)
		{
			echo '<tr>';
			/////////////////////////////////////////////////////////
			echo'<form method=post>';
			////////////////////////////////////////
			echo'<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
				 <input type=hidden name=bill_id value=\''.$row['bill_id'].'\'>
			   <input type=hidden name=item_type_id value=\''.$row['item_type_id'].'\'>';
			//echo '<tr>';
			echo'<td><button class="btn btn-info " type=submit name=action value=edit_bill><b>Edit</b></button> &nbsp;
			<button class="btn btn-danger " type=submit name=action  value=delete_i ><b>X</b></button> </td>';

			//echo'<td><button class="btn btn-info " type=submit name=action  value=edit_info_i ><b>Edit</b></button> &nbsp;
			//<button class="btn btn-danger " type=submit name=action  value=delete_i ><b>X</b></button> </td>';			//echo '<td>' . $row['bill_id'] . '</td>';
			
			echo '<td>' . $row['bill_id'] . '</td>';
			
			echo '<td>' .'('. $row['item_type_id'] .')'.get_item_name($link,$row['item_type_id']).'</td>';

			echo '<td>' . $row['challan_no'] . '</td>';
			
			echo '<td>' . $row['unit_price'] . '</td>';
			
			echo '<td>' . $row['quantity'] . '</td>';

			echo '<td>' . ($row['unit_price']*$row['quantity']) . '</td>';
				
			echo '</tr>';
			
			//echo '</tr>';

			echo '</table>';
			////////////////
			echo '</form>';	
		}
		else
		{
			edit_info_i($link,$bill_id,$item_type_id);			
		}

	///////////////////////////
	}*/
		//echo '</tr>';

		//echo '</table>';
		////////////////////
		//echo '</form>';	
		//////////////////
}
function delete_b ($link,$bill_id)
{
	$sql='delete from bill where bill_id=\''.$bill_id.'\'';
	//echo $sql;
	$result=run_query($link,'deadstock',$sql);
	
	if(!$result)
	{ 
			echo "<h4 class=text-danger><br>Record deleting failed.</h4>";
			echo "<h4 class=text-danger><br>First delete bill item.</h4>";	 	 
	}
	else
	{
			echo "<h4 class=text-success><br>Record deleted successfully.</h4>";
	}
}

function delete_i($link,$bill_id,$item_type_id)
{	   
	$sql='delete from item where bill_id=\''.$bill_id.'\' AND item_type_id=\''.$item_type_id.'\'' ;
	//$sql='delete from item where bill_id=\''.$_POST['bill_id'].'\' AND item_type_id=\''.$_POST['item_type_id'].'\'' ;
	//echo $sql;
		
	$result_i=run_query($link,'deadstock',$sql);
	
	if(!$result_i)
	{ 
			echo "<h4 class=text-danger><br>Record deleting failed.</h4>";
			
	}
	else
	{
			echo "<h4 class=text-success><br>Record deleted successfully.</h4>";
	}
}

/*function edit_info($link,$bill_id)
{
	$sql='select * from bill where bill_id=\''.$bill_id.'\'';
	
	$result=run_query($link,'deadstock',$sql);
	
	while($row=get_single_row($result))
	{
		$sql='select supplier_name from supplier where id=\''.$row['supplier_id'].'\'';
		
		$result=run_query($link,'deadstock',$sql);
		
		$ar=get_single_row($result);

	//print_r($ar);

	echo'<div class="container" >
				<div class="row">
				<div class="col-*-6 mx-auto">';
	echo '<form method=post>
		<table class="table table-bordered">
		<thead class="thead-light">
		<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
		<input type=hidden name=bill_id value=\''.$row['bill_id'].'\'>
		<tr><th>Bill Id</th><td><input type=text readonly name="bill_id" value=\''.$row['bill_id'].'\'></td></tr>
		
		<tr><th>Supplier ID (Name)</th>';
		/////////////////////////////////
		//$result=run_query($link,'deadstock','select supplier_name from supplier order by id');
		$sql='select supplier_name from supplier where id=\''.$row['supplier_id'].'\'';
		
		$result=run_query($link,'deadstock',$sql);
		
		//$ar=get_single_row($result);
		
		echo'<td><select name=supplier_id>';
		
		while($ar=get_single_row($result))
		{ 
			echo '<option value=\''.$ar['id'].'\'>'.$ar['supplier_name'].'</option>';
		}
		
		echo '</select></td></tr>';

		echo'<tr><th>Bill No</th><td><input type="text" name="bill_no" value=\''.$row['bill_no'].'\'></td></tr>
		
		<tr><th>Order No</th><td><input type="text" name="order_no" value=\''.$row['order_no'].'\'></td></tr>

		<tr><th>Bill Date</th><td><input type="date" name="bill_date" value=\''.$row['bill_date'].'\'></td></tr>
		
		<tr><th>Bill Recieve Date</th><td><input type="date" name="bill_recieve_date" value=\''.$row['bill_recieve_date'].'\'></td></tr>
		
		<tr><th>SGST</th><td><input type="text" name="sgst" value=\''.$row['sgst'].'\'></td></tr>
		
		<tr><th>CGST</th><td><input type="text" name="cgst" value=\''.$row['cgst'].'\'></td></tr>
		
		<tr><th>IGST</th><td><input type="text" name="igst" value=\''.$row['igst'].'\'></td></tr>
		
		<tr><th>Discount</th><td><input type="text" name="discount" value=\''.$row['discount'].'\'></td></tr>';
		
		/*$sql_i='select * from item where bill_id=\''.$bill_id.'\'';
		
		$result_i=run_query($link,'deadstock',$sql_i);
		
		while($row_i=get_single_row($result_i))
		{
			echo '
				<!--<tr><th>Bill Id</th><td><input type="text" name="bill_id" value=\''.$row_i['bill_id'].'\'></td></tr>-->
				
				<tr><th>Item ID (Item Name)</th><td></td></tr>
		
				<tr><th>Challan No</th><td><input type="text" name="challan_no" value=\''.$row_i['challan_no'].'\'></td></tr>

				<tr><th>Item Unit Price</th><td><input type="text" name="unit_price" value=\''.$row_i['unit_price'].'\'></td></tr>

				<tr><th>Quantity</th><td><input type="text" name="quantity" value=\''.$row_i['quantity'].'\'></td></tr>';
			}*/
			///////////
		/*echo '<tr><td></td><td><button class="btn btn-success " type=submit name=action value=save>Save</button>&nbsp;&nbsp;
		<button class="btn btn-danger "type=submit name=action value=cancel>Cancel</button></td></tr>
		</thead>';
		print_r($ar);
		echo '</table>';
			
		echo '</form>';	
		
		echo '</div>';
	}
}*/
////////////////fhdddddk//////////////////
function edit_info($link,$bill_id)
{
	$sql='select * from bill where bill_id=\''.$bill_id.'\'';
	
	$result=run_query($link,'deadstock',$sql);
	
	while($row=get_single_row($result))
	{
		$sql='select supplier_name from supplier where id=\''.$row['supplier_id'].'\'';
		
		$result=run_query($link,'deadstock',$sql);
		//$ar=get_single_row($result);
	//print_r($ar);
	echo '<form method=post>
		<table class="table table-bordered">
			<thead class="thead-light">
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			<input type=hidden name=bill_id value=\''.$row['bill_id'].'\'>
			<tr>
				<th>Action</th>
				<th>Bill Id</th>
				<th>(ID)Supplier Name</th>';
	echo'<th>Bill No</th>
		 <th>Order No</th>
		 <th>Bill Date</th>
		 <th>Bill Recieve Date</th>
		 <th>SGST</th>
		 <th>CGST</th>
		 <th>IGST</th>
		 <th>Discount</th></tr>
		<tr>
			<td><button class="btn btn-success " type=submit name=action value=save>Save</button>
			<td><input type=text readonly name="bill_id" value=\''.$row['bill_id'].'\'></td>';
	$sql='select supplier_name from supplier where id=\''.$row['supplier_id'].'\'';
	$result=run_query($link,'deadstock',$sql);
	echo'<td><select name=supplier_id>';
	while($ar=get_single_row($result))
	{ 
		echo '<option value=\''.$ar['id'].'\'>'.$ar['supplier_name'].'</option>';
	}
	echo '</select></td>';
	echo'<td><input type="text" name="bill_no" value=\''.$row['bill_no'].'\'></td>
		<td ><input type="text" name="order_no" value=\''.$row['order_no'].'\'></td>
		<td><input type="date" name="bill_date" value=\''.$row['bill_date'].'\'></td>
		<td><input type="date" name="bill_recieve_date" value=\''.$row['bill_recieve_date'].'\'></td>
		<td><input type="text" name="sgst" value=\''.$row['sgst'].'\'></td>
		<td><input type="text" name="cgst" value=\''.$row['cgst'].'\'></td>
		<td><input type="text" name="igst" value=\''.$row['igst'].'\'></td>
		<td><input type="text" name="discount" value=\''.$row['discount'].'\'></td></tr>';
	echo'</thead>';
	echo '</table>';
	//echo '</div>';
	//echo '</div></div>';
	echo '</form>';		
	}
}
////////////////////////////fghigitzzzedy/////////////////////////////

function update_bill($link)
{
		$sql_ub='update bill set
							
							bill_no=\''.$_POST['bill_no'].'\',
							order_no=\''.$_POST['order_no'].'\',
							bill_date=\''.$_POST['bill_date'].'\',
							bill_recieve_date=\''.$_POST['bill_recieve_date'].'\',
							sgst=\''.$_POST['sgst'].'\',
							cgst=\''.$_POST['cgst'].'\',
							igst=\''.$_POST['igst'].'\',
							discount=\''.$_POST['discount'].'\'
				where 
							bill_id=\''.$_POST['bill_id'].'\'';	
							
				
		$result=run_query($link,'deadstock',$sql_ub);
		
		if(!$result)
		{ 
			echo "<h4 class=text-danger><br>Data update failed</h4>";	 
		}
		else
		{
			echo "<h4 class=text-success><br>Data updated successfully</h4>";
		}
}
////////////////////////////////////////////////////////////////////////////////1343//////////////////////////////
function edit_info_i($link,$bill_id,$item_type_id=0)
{	
		$sql_i='select * from item where bill_id=\''.$bill_id.'\' and item_type_id=\''.$item_type_id.'\'';
		
		$result_i=run_query($link,'deadstock',$sql_i);

		//print_r($row_i);
		
			while($row_i=get_single_row($result_i))
			{
				echo '<form method=post>';
				//echo'<div class="container">
					//<div class="row">
					//<div class="col-*-6 mx-auto">';
				//echo '<table class="table table-bordered">
					//<thead class="thead-light">
					echo'<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
					<input type=hidden  name=bill_id value=\''.$row_i['bill_id'].'\'>
					<input type=hidden name=item_type_id value=\''.$row_i['item_type_id'].'\'>';
				//echo '<tr>
					//<th>Action</th>
					//<th>Bill Id</th>';
				//echo '<th>(Item ID) Item Name</th>';
				//echo '<th>Challan No</th>
					//<th>Item Unit Price</th>
					//<th>Quantity</th></tr>';
				echo'<tr></tr><td><button class="btn btn-success" type=submit name=action value=save1>Save</button></td>';
				echo'<td><input type=text readonly name="bill_id" value=\''.$row_i['bill_id'].'\'></td>';
					$sql='select item_name from item_type where item_type_id=\''.$row_i['item_type_id'].'\'';
					$result=run_query($link,'deadstock',$sql);
					
					while($row=get_single_row($result))
					{
						echo '<td>' .'('. $row_i['item_type_id'] .')' .$row['item_name'].'</td>';
					}
				echo '</select></td>';
				echo'<td><input type="text" name="challan_no" value=\''.$row_i['challan_no'].'\'></td>
					<td><input type="text" name="unit_price" value=\''.$row_i['unit_price'].'\'></td>
					<td><input type="text" name="quantity" value=\''.$row_i['quantity'].'\'></td></tr>
					</thead>';
				echo '</div></div></div>';
		
	echo '</form>';	
	}
	//echo '</table>';	
}
////////////////////////////////////1343///////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/*function edit_info_i($link,$bill_id,$item_type_id)
{	
		$sql_i='select * from item where bill_id=\''.$bill_id.'\'';
		
		$result_i=run_query($link,'deadstock',$sql_i);

		//print_r($row_i);
		
			while($row_i=get_single_row($result_i))
			{
				echo '<form method=post>';
				echo'<div class="container">
					<div class="row">
					<div class="col-*-6 mx-auto">';
				echo '<table class="table table-bordered">
					<thead class="thead-light">
					<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
					<input type=hidden  name=bill_id value=\''.$row_i['bill_id'].'\'>
					<input type=hidden name=item_type_id value=\''.$row_i['item_type_id'].'\'>';
				
				echo '<tr><th>Bill Id</th><td><input type=text readonly name="bill_id" value=\''.$row_i['bill_id'].'\'></td></tr>';

				//echo '<tr><th>Item ID (Item Name)</th>';
				/////////////////////////////
					/*$sql='select item_name from item_type where item_type_id=\''.$row_i['item_type_id'].'\'';
					$result=run_query($link,'deadstock',$sql);
					
					echo '<td><select name=item_type_id type= readonly>';
					while($row=get_single_row($result))
					{
						echo '<option value=\''. $row_i['item_type_id'] .'\'>'.$row['item_name'].'</option>';

						//echo '<td>' . $row_i['item_type_id'] . '('.$row['item_name'].')</td>';
					}
					echo '</select></td></tr>';*/
				
					/////////////////////////////
				/*echo '<tr><th>Item ID (Item Name)</th>';
					$sql='select item_name from item_type where item_type_id=\''.$row_i['item_type_id'].'\'';
					$result=run_query($link,'deadstock',$sql);
					
					while($row=get_single_row($result))
					{
						echo '<td>' . $row_i['item_type_id'] . '('.$row['item_name'].')</td>';
					}
				echo '</select></td></tr>';
					
				echo '<tr><th>Challan No</th><td><input type="text" name="challan_no" value=\''.$row_i['challan_no'].'\'></td></tr>

				<tr><th>Item Unit Price</th><td><input type="text" name="unit_price" value=\''.$row_i['unit_price'].'\'></td></tr>

				<tr><th>Quantity</th><td><input type="text" name="quantity" value=\''.$row_i['quantity'].'\'></td></tr>';
				
				echo'<tr><td></td><td><button class="btn btn-success" type=submit name=action value=save1>Save</button>&nbsp;&nbsp;
				
				<button class="btn btn-danger" type=submit name=action value=cancel>Cancel</button></td></tr>
				
				</thead>';
		
		echo '</table>';
			
		echo '</div></div></div>';
		
	echo '</form>';	
	}
		
}*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_item($link)
{
	//UPDATE `item` SET `challan_no`=3,`unit_price`=3300,`quantity`=3 WHERE `bill_id`=205 AND `item_type_id`=1 
	$sql_ui='update item set
	                        
							challan_no=\''.$_POST['challan_no'].'\',
							unit_price=\''.$_POST['unit_price'].'\',
							quantity=\''.$_POST['quantity'].'\'
				where 
							bill_id=\''.$_POST['bill_id'].'\' AND item_type_id=\''.$_POST['item_type_id'].'\'';
	$result_i=run_query($link,'deadstock',$sql_ui);
	
	if(!$result_i)
	{ 
			echo "<h4 class=text-danger><br>Data update failed</h4>";	 
	}
	else
	{
			echo "<h4 class=text-success><br>Data updated successfully</h4>";
	}
}
?>
