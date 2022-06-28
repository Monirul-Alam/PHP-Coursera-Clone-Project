<?php

session_start();
include_once '../connections.php';

$flag = false;
$ms = '';
$cid = $_GET['id'];
$cnt = delete("delete from coupon where id = $cid;");

if ($cnt == 1) 
{
	$ms = 'Coupon deleted!';
	$flag = true;
}
else
{
	$ms = 'Coupon deleted!';
}


$dt = array('ms' => $ms , 'success' => $flag);

echo json_encode($dt);
?>