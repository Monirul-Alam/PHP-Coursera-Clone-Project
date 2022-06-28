<?php

session_start();
include_once '../connections.php';

$ms = '';
$flag = false;


$uname = $_SESSION['username'];
$udata = get("select * from users where user_name='".$uname."';");
$uid = $udata['id'];

$row = delete("delete from ussedcoupon where uid=$uid");
if($row == 1)
{
	$ms.='deleted!';
	$flag = true;
}

$dt = array('msg' => $ms , 'success'=> $flag );

echo json_encode($dt);