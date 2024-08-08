<?php
session_start();
include "../include/configue.php";

$userid = $_GET['userid'];
$productid = $_GET['productid'];
$query = "DELETE FROM `plikes` WHERE userid=:userid AND productid=:productid";
$query = $dbh->prepare($query);
$query->bindparam(":userid", $userid);
$query->bindparam(":productid", $productid);
$query->execute();
$redirect="../index.php";
header("Location: " . $redirect);
exit;
?>