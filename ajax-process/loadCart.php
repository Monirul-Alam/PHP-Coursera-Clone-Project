<?php

session_start();
include_once '../connections.php';

$cpn = '';
$flag = false;
$discount = 0;
$disPrcnt = 0;
$total = 0;
$subtotal = 0;
$output = '';

$uname = $_SESSION['username'];
$udata = get("select * from users where user_name='".$uname."';");
$uid = $udata['id'];


$cdata = gets("select * from cart where uid='".$uid."';");

$count = rows("select * from cart where uid = $uid;");

if ($count == 0) 
{
	$output.= '<tr><td  colspan="4"><h2 style="color:red;text-align:center;">The cart is empty!</h2></td></tr>';
}
else
{
	foreach ($cdata as $key) 
	{
		$output.= '<tr>';		
		$output.= '<td class="cart_product">';						
		$output.= '<a><img src="http://localhost/course/uploads/image/'.$key['img'].'" width="200" height="200"></a>';							
		$output.= '</td>';						
		$output.= '<td class="cart_description">';						
		$output.= '<h4><a href="">'.$key['cname'].'</a></h4>';							
		$output.= '<p>Course ID: '.$key['cid'].'</p>';							
		$output.= '</td>';						
		$output.= '<td class="cart_price">';						
		$output.= '<p>$'.$key['price'].'</p>';							
		$output.= '</td>';						
								
								
		$output.= '<td class="cart_delete">';						
		$output.= '<a onclick="removeCart('.$key['id'].')" class="cart_quantity_delete" ><i class="fa fa-times"></i></a>';							
		$output.= '</td>';						
		$output.= '</tr>';					
	}
}


$sum = get("select sum(price) as sum from cart where uid = $uid;");
$sum = $sum['sum'];
$total = $sum;


$hasdiscount = rows("select * from ussedcoupon where uid = $uid;");
if($hasdiscount == 1)
{
	$disData = get("select * from coupon where id = (select cpnid from ussedcoupon where uid = $uid)");
	$disPrcnt = $disData['percentenge'];
	$cpn.= $disData['code'];
	
    $subtotal = $sum - ($sum*$disPrcnt/100);
    $discount = $sum-$subtotal;
}
else
{
	$subtotal = $total;
}


$dt = array('output' => $output , 'count'=> $count , 'total' => $total , 'subtotal' => $subtotal , 
	'discount'=>$discount , 'disPrcntng'=>$disPrcnt , 'cpn' => $cpn);

echo json_encode($dt);
?>