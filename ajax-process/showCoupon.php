<?php

session_start();
include_once '../connections.php';

$cdata = gets("select * from coupon order by id;");
$output = '';

foreach ($cdata as $key) 
{
	$output.= '<tr>';		
	$output.= '<th scope="row">'.$key['id'].'</th>';						
	$output.= '<td>'.$key['code'].'</td>';				
	$output.= '<td>'.$key['percentenge'].'</td>';		
	$output.= '<td><a onclick="editCoupon('.$key['id'].')" type="button" class="btn btn-success"><i style="margin-right:5px" class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></td>';		
	$output.= '<td><a onclick="deleteCoupon('.$key['id'].')" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';		
	$output.= '</tr>';					
}

$dt = array('output' => $output );

echo json_encode($dt);
?>