<?php
//$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';

//never include head(), it is called by verify_login.php
////////User code below/////////////////////	

require_once 'store_common.php';

$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
menu($link);

//print_r($_POST);

//////////////user code ends////////////////
tail();
?>
