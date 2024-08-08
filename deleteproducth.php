<?php
session_start();
include "../include/configue.php";

$productid = $_GET['productid'];
$query = "DELETE FROM `addproduct` WHERE productid=:productid ";
$query = $dbh->prepare($query);
$query->bindparam(":productid", $productid);
$query->execute();
$redirect="../viewproducts.php";
header("Location: " . $redirect);
exit;
?>