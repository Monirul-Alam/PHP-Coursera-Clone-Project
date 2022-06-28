<?php

session_start();
include_once '../connections.php';

$flag = false;
$ms = '';


$uname = $_SESSION['username'];
$udata = get("select * from users where user_name='".$uname."';");
$uid = $udata['id'];


$cpnCode = $_GET['cpn'];
$count = rows("select * from coupon where code ='".$cpnCode."';");
if ($count == 1) 
{
	$ms.= 'Coupon valid';
	$userCount = rows("select * from ussedcoupon where uid = $uid;");
	if ($userCount == 1) 
    {
    	$cpndata = get("select * from coupon where code ='".$cpnCode."';");
	    $cpnid = $cpndata['id'];
	    update("update ussedcoupon set cpnid = $cpnid where uid=$uid");
	    $flag = true;
    }
    else
    {
    	$ms.= 'Coupon valid';
    	$cpndata = get("select * from coupon where code ='".$cpnCode."';");
	    $cpnid = $cpndata['id'];
	    insert("insert into ussedcoupon (uid , cpnid) values ($uid , $cpnid);");
	    $flag = true;
    }
}
else
{
	$ms.= 'Coupon invalid';
}

$dt = array('msg' => $ms , 'success'=> $flag );

echo json_encode($dt);