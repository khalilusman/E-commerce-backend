<?php
include "../include/configue.php";
session_start();

$email = $_POST['email'];
$psw = $_POST['psw'];

$query = "SELECT * FROM signin WHERE email=:email";

$query = $dbh->prepare($query);
$query->bindParam(":email", $email);
$query->execute();


$result = $query->fetchAll(PDO::FETCH_ASSOC);
if ($result) {
    foreach ($result as $key) {
        $psws = $key['psw'];
        $emails = $key['email'];
        $userids = $key['userid'];
        $accountStatus = $key['status'];
        if ($accountStatus == 'user' && $psw == $psws) {
             'user' . $userids;
            $_SESSION['userid'] = $userids;
            $_SESSION['accountStatus'] = 'user';
        } else if ($accountStatus == 'admin' && $psw == $psws) {
            'admin' . $userids;
             $_SESSION['userid'] = $userids;
            $_SESSION['accountStatus'] = 'admin';
        } else if ($accountStatus == 'employee' && $psw == $psws) {
             'employee' . $userids;
            $_SESSION['userid'] = $userids;
            $_SESSION['accountStatus'] = 'employee';

        } else if ($psw != $psws) {
            echo 'psw not matched';
        } else if ($email != $emails) {
            echo 'email not matched';
        }
    }
} else {
    echo 'email not matched 1';
}
$redirect = "../index.php";
header("Location: " . $redirect);
exit;
?>