<style>
    input{
         height: 5vh;
         width: 57vw;
         position: absolute;
         bottom: 50px;
         margin-left: 200px;
         border: 1px solid black;
         border-radius: 5px;

         
    }

    button{
        height: 5vh;
        width: 5vw;
        background-color: black;
        color: white;
        border: 0.7px solid ;
        border-radius: 10px;
        position: absolute;
        bottom: 50px;
        margin-left: 930px;
    }
    /* button a{
        text-decoration: none;
        color: white;
    } */
    .message{
        position: relative;
        height: fit-content;
        width: fit-content; 
        border: 1px solid black;
        border-radius: 8px;
    
    }
    
</style>

<?php 
include "include/configue.php";
session_start();



// $senderid = $_SESSION['userid'];
// $query1 = "SELECT message FROM `livechat` WHERE senderid = :senderid";
// $query1 = $dbh->prepare($query1);
// $query1->bindParam(":senderid", $senderid);
// $query1->execute();
// $query1 = $query1->fetchAll(PDO::FETCH_ASSOC);

// if (!empty($query1)) {
//     foreach ($query1 as $key1) {
//         echo '<div class="message">' . $key1['message'] . '</div><br>';
//     }
// } else {
//     echo "No messages found for this user.";
// }


    $productid = $_GET['productid'];
    $userid = $_SESSION['userid'];

    $query = "SELECT * FROM `addtocart` WHERE `userid` = :userid AND `productid` = :productid ";
    $query = $dbh->prepare($query);
    $query->bindParam(":userid", $userid);
    $query->bindParam(":productid", $productid);
    $query->execute();
    $key = $query->fetch(PDO::FETCH_ASSOC);

        $productid = $key['productid'];
        $userid = $key['userid'];
    

?>



<?php
    $productid = $_GET['productid'];
    $query2 = "SELECT userid FROM `addproduct` WHERE productid = :productid";
    $query2 = $dbh->prepare($query2);
    $query2->bindParam(":productid", $productid);
    $query2->execute();
    $key2 = $query2->fetch(PDO::FETCH_ASSOC);

    $recieverid = $key2["userid"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live chat</title>
</head>
<body>
    <div id="chat">
        <form action="server/livechath.php" method="post">
            <input type="text" name="message" placeholder="Type your message">
            <input type="hidden" name="productid" value="<?php echo $productid; ?>">
            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
            <input type="hidden" name="userids" value="<?php echo $recieverid; ?>">
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>

<?php 

    $senderid = $_SESSION['userid'];
    $productid = $_GET['productid']; 
 
$query1 = "SELECT * FROM `livechat` WHERE (senderid = :senderid AND recieverid = :recieverid) OR (senderid = :recieverid AND recieverid = :senderid)";
$query1 = $dbh->prepare($query1);
$query1->bindParam(":senderid", $senderid);
$query1->bindParam(":recieverid", $recieverid);
$query1->execute();
$query1 = $query1->fetchAll(PDO::FETCH_ASSOC);

if (!empty($query1)) {
    foreach ($query1 as $key1) {
        echo '<div class="message">' . $key1['senderid']. $key1['message'] . '</div><br>';
        
    }
}

?>
