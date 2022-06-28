<?php

session_start();
include_once '../connections.php';

$uname = $_SESSION['username'];
$udata = get("select * from users where user_name='".$uname."';");
$uid = $udata['id'];


$cdata = gets("select * from enrolled  where uid='".$uid."';");
$output = '';
foreach ($cdata as $key) 
{		
	
									 
	/*$output.= '<li><a href="addvideo.php/?id='.$key['id'].'">'.$key['cname'].'</a></li>';
	$output.= '<li><img height="300" width="300" src="http://localhost/course/uploads/image/'.$key['img'].'" ></li>';
	$output.= '<li><a class="btn btn-primary" href="http://localhost/course/Admin/viewPlaylist.php?id='.$key['id'].'">View</a></li>';*/
	$output.= '<div class="col-sm-3"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center">';
	$output.= '<img height="200" src="http://localhost/course/uploads/image/'.$key['img'].'" >';
	$output.= '<p>'.$key['cname'].'</p>';
	$output.= '<a href="viewPlist?id='.$key['cid'].'"  class="btn btn-default add-to-cart"><i class="fa fa-play"></i>View Playlist</a>';
	$output.= '</div></div></div></div>';
				
}


$count = rows("select * from enrolled where uid = $uid;");
$dt = array('output' => $output , 'count'=> $count );

echo json_encode($dt);
//echo $output;
?>