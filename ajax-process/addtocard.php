<?php
include '../connections.php';
session_start();

$ms ='';
$uname = $_SESSION['username'];
$udata = get("select * from users where user_name='".$uname."';");
$uid = $udata['id'];

$cid = $_GET["id"];
$cdata = get("select * from course where id='".$cid."';");

$ciid = $cdata['id'];
$cname = $cdata['cname'];
$price = $cdata['price'];
$image = $cdata['image'];



$checkEnroll = rows("select * from enrolled where uid = $uid and cid=$ciid;");
if($checkEnroll == 0)
{
	$row = rows("select * from cart where uid = $uid and cid=$ciid;");
	if($row == 0)
	{
		$count  = insert("insert into cart (uid,cid,cname,price,img) values ($uid, $ciid,'$cname', $price , '$image');");
		if($count==1)
		{
		   $ms.='Course Added to the Cart!';
		}
		else
		{
		   $ms.='Course Added failed!';
		}
	}
	else
	{
		$ms.='Already Added to the Cart!';
	}
}
else
{
	$ms.= 'You have already enrolled this course!'; 
}


$count = rows("select * from cart where uid = $uid;");
$json = array('message'=>$ms, 'count'=> $count);

echo json_encode($json);
