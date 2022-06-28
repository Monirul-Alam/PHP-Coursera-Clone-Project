<?php

session_start();
include_once '../connections.php';

$uname = $_SESSION['username'];
$udata = get("select * from users where user_name='".$uname."';");
$uid = $udata['id'];

$CartId= $_GET["id"];
$ms = '';
$row = delete("delete from cart where id = $CartId and uid = $uid;");
if ($row == 1) 
{
	$ms.= 'Item removed from the cart'; 
}
else
{
	$ms.= 'Item remove failed!'; 
}
$dt = array('message' => $ms , 'count'=> 2);

echo json_encode($dt);
//echo $output;
?>