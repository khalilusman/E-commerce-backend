<?php
include "../include/configue.php";
session_start();

$message = $_POST['message'];
$productid = $_POST['productid'];
$senderid = $_POST['userid'];
$recieverid = $_POST['userids']; 

$query = "INSERT INTO `livechat` (`senderid`, `productid`, `message`, `recieverid`) VALUES (:senderid, :productid, :message, :recieverid)";
$query = $dbh->prepare($query);
$query->bindParam(":senderid", $senderid); 
$query->bindParam(":recieverid", $recieverid); 
$query->bindParam(":productid", $productid);
$query->bindParam(":message", $message); 
$query->execute();

$redirect = "../livechat.php";
header("Location: " . $redirect);
exit;
?>
