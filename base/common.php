<?php


function login()
{
//echo '<br>';
echo'<div class="card" >
		<img class="card-img" src="image/item2.jpg" alt="card image" height="615"  >
			<div class="card-img-overlay">
			<br>
			<br>
			<br><br><br>
		<div class="row">
		<div class="col-sm-3  mx-auto card p-1 bg-light">
		
			<form method=post action=start.php >
			
				<div class="form-group">
					<div class="col-sm-5 bg-light  mx-auto ">
					
					<img src="./image/219983.png" height="80" width="80" class="rounded-circle" > 
					<h4><center><b>LOGIN</b></center></h4>
				</div>
				<div class="form-group">
						<label for=user><b>Login ID</b></label>
						<input  class="form-control" id=user type=text name=login placeholder=Username>
				</div>
				<div class="form-group">						
						<label for=password><b>Password</b></label>
						<input  class="form-control" id=password type=password name=password placeholder=Password>
						<input type=hidden name=session_name value=\''.session_name().'\'>
				</div>
				<div class="form-group">						
						<button class="form-control btn btn-primary" type=submit name=action value=login><b>Login</b></button>
				</div>
			</form>
		</div>
		</div>	
		</div>	
      </div>          

</div>

		<div>
		</div>
		
		</div> 
	
</div>';
        echo'		   </div>
			</div>
		 </div>';	
		
}

function head($title='blank')
{
	if(!isset($GLOBALS['nojunk']))
	{
		echo '
		<!DOCTYPE html>
		<html lang="en">
		<head>
		  <title>'.$title.'</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="icon" href="favicon.ico">
		  <script src="bootstrap/jquery-3.3.1.js"></script>
		  <script src="bootstrap/popper.js"></script>
		  <script src="bootstrap/js/bootstrap.min.js"></script> 
		</head>
		<body>
		<div class="container">';
	}
}
//		 <meta http-equiv="refresh" content="60">

function tail()
{
	if(!isset($GLOBALS['nojunk']))
	{
		echo '</div></body></html>';
	}
}


/////////////////////////////////////


function get_link($u,$p)
{
	$link=mysqli_connect('127.0.0.1',$u,$p);
	if(!$link)
	{
		echo 'error1:'.mysqli_error($link); 
		return false;
	}
	return $link;
}
function get_remote_link($ip,$u,$p)
{
	$link=mysqli_connect($ip,$u,$p);
	if(!$link)
	{
		echo 'error1:'.mysqli_error($link); 
		return false;
	}
	return $link;
}
function run_query($link,$db,$sql)
{
	$db_success=mysqli_select_db($link,$db);
	
	if(!$db_success)
	{
		echo 'error2:'.mysqli_error($link); return false;
	}
	else
	{
		$result=mysqli_query($link,$sql);
	}
	
	if(!$result)
	{
		echo 'error3:'.mysqli_error($link); return false;
	}
	else
	{
		return $result;
	}	
}

function get_single_row($result)
{
		if($result!=false)
		{
			return mysqli_fetch_assoc($result);
		}
		else
		{
			return false;
		}
}


function my_safe_string($link,$str)
{
	return mysqli_real_escape_string($link,$str);
} 

function  last_autoincrement_insert($link)
{
	return mysqli_insert_id($link);
}

function my_count_rows($result)
{
	return mysqli_num_rows($result);
}



////////////////////////////////////////

?>
