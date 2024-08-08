<?php
 include "../include/configue.php";
 session_start();
 $pname = $_POST['pname'];
$pram = $_POST['pram'];
$prom = $_POST['prom'];
$pcam = $_POST['pcam'];
$pbat = $_POST['pbat'];
$pQnt = $_POST['pQnt'];
$price = $_POST['price'];
$userid=$_SESSION['userid'];



$query = "INSERT INTO `addproduct`( `pname`, `pram`, `prom`, `pcam`, `pbat`,`pQnt`, `price`, `userid`) VALUES ( :pname, :pram, :prom, :pcam, :pbat,:pQnt, :price, :userid)";


$query = $dbh->prepare($query);

$query->bindparam(":pname", $pname);
$query->bindparam(":pram", $pram);
$query->bindparam(":prom", $prom);
$query->bindparam(":pcam", $pcam);
$query->bindparam(":pbat", $pbat);
$query->bindparam(":pQnt", $pQnt);
$query->bindparam(":price", $price);
$query->bindparam(":userid", $userid);

$query->execute();








$last_id = $dbh->lastInsertId();

$countfiles = count($_FILES['files']['name']);
for ($i = 0; $i < $countfiles; $i++) {
    $filename = $_FILES['files']['name'][$i];
    $target_file = '../productimg/' . time() . $filename;

        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_file)) {
            $query1 = "INSERT INTO `productimg`(`images`, `productid`) VALUES (:target_file, :last_id)";
            $query1 = $dbh->prepare($query1);
            $query1->bindParam(":target_file", $target_file);
            $query1->bindParam(":last_id", $last_id);
            $query1->execute();
     }
}








$redirect="../index.php";
header("Location: " . $redirect);
exit;

?>