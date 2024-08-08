<?php
include "../include/configue.php";
session_start();

$likes = intval($_GET['like']) + 1;

$productid=$_GET['productid'];
 '<h5>User Id</h5>'. $userid  = $_SESSION['userid'];

$query = "INSERT INTO `plikes`( `productid`, `userid`) VALUES ( :productid,:userid)";

$query = $dbh->prepare($query);
$query->bindparam(":productid", $productid);
$query->bindparam(":userid", $userid);

$query->execute();

$redirect="../index.php";
header("Location: " . $redirect);
exit;
?>
