<?php

function menu($link)
{		
echo '
	<div class="container-fluid">
          <h2 class="text-danger text-center ">Ineventory Management</h2>
		<div class="row">				
			<div class="col-sm-12 bg-light text-center">	
      <form method=post>
      <input type=hidden name=session_name value=\''.session_name().'\'>
		<table>
			<tr><td>
				<button  class="btn btn-primary btn-block" formaction=new_bill.php type=submit  name=action value=new_bill>Add Bill</button>
			</td>
			<td><button  class="btn btn-primary btn-block" formaction=supplier_details.php type=submit name=action value=supplier_detail>Supplier Details</button>
			</td>
			<td>
				<button  class="btn btn-primary btn-block" formaction=item.php type=submit  name=action value=item>Item Details</button>
			</td></tr>		
		
		</table>';
}
?>
