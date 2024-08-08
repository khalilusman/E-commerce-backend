<?php
session_start();
include "../include/configue.php";
$userid = 0;
$name = $_POST['name'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$cpsw = $_POST['cpsw'];
$ads = $_POST['ads'];
$status = 'user';






$query = "SELECT * FROM signin WHERE email=:email";
$query = $dbh->prepare($query);
$query->bindParam(":email", $email);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
 echo 'email already exist';
    // $newURL = "../signup.php";
    // header('location: ' . $newURL);
    // exit();
} else {


$query = "INSERT INTO `signin`(`userid`, `name`, `email`, `psw`, `cpsw`, `ads`, `status`) VALUES (:userid, :name,  :email, :psw, :cpsw,  :ads, :status)";

$query = $dbh->prepare($query);
$query->bindparam(":userid", $userid);
$query->bindparam(":name", $name);
$query->bindparam(":email", $email);
$query->bindparam(":psw", $psw);
$query->bindparam(":cpsw", $cpsw);
$query->bindparam(":ads", $ads);
$query->bindparam(":status", $status);
$query->execute();   
}

    $redirect="../index.php";
    header("Location: " . $redirect);
    exit;
?>
