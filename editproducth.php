<?php
include "../include/configue.php";

$productid= $_POST['productid'];
$pname = $_POST['pname'];
$pram = $_POST['pram'];
$prom = $_POST['prom'];
$pcam = $_POST['pcam'];
$pbat = $_POST['pbat'];
$price = $_POST['price'];



$query = "UPDATE `addproduct` SET  `pname`=:pname, `pram`=:pram,`prom`=:prom,`pcam`=:pcam, `pbat`=:pbat, `price`=:price  where productid=:productid";

$query = $dbh->prepare($query);

$query->bindparam(":pname", $pname);
$query->bindparam(":pram", $pram);
$query->bindparam(":prom", $prom);
$query->bindparam(":pcam", $pcam);
$query->bindparam(":pbat", $pbat);
$query->bindparam(":price", $price);
$query->bindparam(":productid", $productid);
// $query->bindparam(":like", $like);

$query->execute();

$redirect="../viewproducts.php";
header("Location: " . $redirect);
exit;
?>