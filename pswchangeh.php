<?php
session_start();
include "../include/configue.php";


// $query="SELECT * FROM `signin` where psw =:psw ";
// $query = $dbh->prepare($query);
// $query->bindparam(":psw", $psw); 
// $query->execute();
// $query=$query->fetchAll(PDO::FETCH_ASSOC);


// foreach($query as $key){
    
//     $psws = $key['psw'];
    
// }

// if('pswo'== $psws){

    $userid = $_SESSION['userid'];
    $psw = $_POST['psw'];
    $cpsw = $_POST['cpsw'];

$query = "UPDATE `signin` SET  `psw`=:psw, `cpsw`=:cpsw where userid=:userid";

$query = $dbh->prepare($query);

$query->bindparam(":userid", $userid);
$query->bindparam(":psw", $psw);
$query->bindparam(":cpsw", $cpsw);

$query->execute();
// }

// else{
//     echo "password is not matched";
// }
$redirect="../info.php";
header("Location: " . $redirect);
exit;
?>