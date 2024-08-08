<?php
include "../include/configue.php";

$userid= $_POST['userid'];
$name = $_POST['name'];
$email = $_POST['email'];
$ads = $_POST['ads'];


$query = "UPDATE `signin` SET  `name`=:name, `email`=:email, `ads`=:ads where userid=:userid";

$query = $dbh->prepare($query);

$query->bindparam(":name", $name);
$query->bindparam(":email", $email);
$query->bindparam(":ads", $ads);
$query->bindparam(":userid", $userid);

$query->execute();

$redirect="../profile.php";
header("Location: " . $redirect);
exit;
?>