<?php
include "../include/configue.php";
session_start();


     $quantity = $_POST['quantity'];
     $productid = $_POST['productid'];
     $userid = $_POST['userid'];
    $status='Processing';
    $createDate = date("Y-m-d H:i:s");
    
    $query = "SELECT price FROM `addproduct` WHERE productid = :productid";
    $query = $dbh->prepare($query);
    $query->bindParam(":productid", $productid);
    $query->execute();
    $key = $query->fetch(PDO::FETCH_ASSOC);


   $pricePerProduct = $key['price'];
    
    $query1 = "SELECT * FROM `order` WHERE `userid` = :userid AND `productid` = :productid";
    $query1 = $dbh->prepare($query1);
    $query1->bindParam(":userid", $userid);
    $query1->bindParam(":productid", $productid);
    $query1->execute();

    if ($query1->rowCount() > 0) {
        echo "order Already placed";
        $row = $query1->fetch(PDO::FETCH_ASSOC);
        // $existingQuantity = $row['quantity'];
        $newQuantity = $_POST['quantity'];
        
        $newPrice = $pricePerProduct * $newQuantity;
        $query2 = "UPDATE `order` SET `quantity` = :newQuantity, `price` = :newPrice WHERE `userid` = :userid AND `productid` = :productid";
        $query2 = $dbh->prepare($query2);
        $query2->bindParam(":newQuantity", $newQuantity);
        $query2->bindParam(":userid", $userid);
        $query2->bindParam(":productid", $productid);
        $query2->bindParam(":newPrice", $newPrice);
        $query2->execute();
     
    } else {
       
        $price = $pricePerProduct * $quantity; 
        
        $query3 = "INSERT INTO `order`( `productid`, `userid`, `quantity`, `price`, `status`, `createDate`) VALUES  (:productid, :userid, :quantity, :price, :status, :createDate)";
        $query3 = $dbh->prepare($query3);
        $query3->bindParam(":userid", $userid);
        $query3->bindParam(":productid", $productid);
        $query3->bindParam(":quantity", $quantity);
        $query3->bindParam(":price", $price);
        $query3->bindParam(":createDate", $createDate);
        $query3->bindParam(":status", $status);
        $query3->execute();
    
    }

    $redirect = "../order.php";
    header("Location: " . $redirect);
    exit;

?>
