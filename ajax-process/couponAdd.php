<?php
session_start();
include_once '../connections.php';


$code =  $_GET['val'];
$perC =  $_GET['vl'];
$flag = false;
$ms = '';


if(!empty($code) && !empty($perC))
{
	
    $row = insert("insert into coupon (code , percentenge) values ('$code',$perC);");
    if($row == 1) 
    {
    	$flag = true;
    	$ms.= 'New coupon created!';
    }
}
else
{
	$ms.= 'Please Fill all the input first!';
}

$dt = array('ms' => $ms , 'success'=> $flag);

echo json_encode($dt);

