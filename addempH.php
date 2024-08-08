<?php
session_start();
include "../include/configue.php";
$userid = 0;
$name = $_POST['name'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$ads = $_POST['ads'];
$post = $_POST['post'];
$iban = $_POST['iban'];
$salary = $_POST['salary'];
$status = 'employee';
$createDate = date("Y-m-d H:i:s");



$query = "INSERT INTO `signin`( `name`, `email`, `psw`,  `ads`, `status`) VALUES ( :name,  :email, :psw, :ads, :status)";
$query = $dbh->prepare($query);
$query->bindparam(":name", $name);
$query->bindparam(":email", $email);
$query->bindparam(":psw", $psw);
$query->bindparam(":ads", $ads);
$query->bindparam(":status", $status);
$query->execute();
echo 'done';    
$userid=$dbh->lastInsertId();
$query1 = "INSERT INTO `emp`( `userid`, `post`, `iban`, `salary`, `createDate`) VALUES ( :userid, :post, :iban, :salary, :createDate)";
$query1 = $dbh->prepare($query1);
$query1->bindparam(":userid", $userid);
$query1->bindparam(":post", $post);
$query1->bindparam(":iban", $iban);
$query1->bindparam(":salary", $salary);
$query1->bindparam(":createDate", $createDate);

$query1->execute();
echo 'done';    


    $redirect="../index.php";
    header("Location: " . $redirect);
    exit;
?>
