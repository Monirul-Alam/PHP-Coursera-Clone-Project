<?php

session_start();
include_once '../connections.php';

$cid = $_GET['id'];
$cdata = get("select * from coupon where id = $cid;");



$dt = array('id' => $cdata['id'] , 'code' => $cdata['code'] ,'percent' => $cdata['percentenge'] );

echo json_encode($dt);
?>