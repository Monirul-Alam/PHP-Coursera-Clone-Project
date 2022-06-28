<?php


include_once '../connections.php';
session_start();

$flag = false;
$ms = '';
$cardNumber = $_GET['card'];

if(!empty($cardNumber))
{
	$uname = $_SESSION['username'];
    $udata = get("select * from users where user_name='".$uname."';");
    $uid = $udata['id'];

    $cartRow = rows("select * from cart where uid = $uid;");
    if($cartRow > 0)
    {
    	$cdata = gets("select * from cart where uid = $uid;");
	    foreach ($cdata as $key) 
		{
			$uiid = $key['uid'];
			$cname = $key['cname'];
			$cid = $key['cid'];
			$image = $key['img'];
			insert("insert into enrolled (uid,cid,cname,img) values ($uiid, $cid,'$cname',  '$image');");			
		}
		delete("delete from cart where  uid = $uid;");
		delete("delete from ussedcoupon where  uid = $uid;");
		$flag = true;
		$ms.= 'Successfully enrolled!';
	}
	else
	{
		$ms.= 'Add some course to the cart first!';
	}
}
else
{
    $ms.= 'Please type your master card number!';
}




$dt = array('ms' => $ms , 'success'=> $flag);

echo json_encode($dt);
?>