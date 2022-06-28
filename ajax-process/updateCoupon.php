<?php
session_start();
include_once '../connections.php';


$code =  $_GET['val'];
$perC =  $_GET['vl'];
$cid =  $_GET['id'];
$flag = false;
$ms = '';


if(!empty($code) && !empty($perC))
{
    $row = update("update coupon set code='$code', percentenge = $perC  where id=$cid");
    if($row == 1) 
    {
    	$flag = true;
    	$ms.= 'Coupon updated!';
    }
}
else
{
	$ms.= 'Please Fill all the input first!';
}

$dt = array('ms' => $ms , 'success'=> $flag);

echo json_encode($dt);

