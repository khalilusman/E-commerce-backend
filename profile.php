<!-- <?php
include "include/configue.php";
session_start();

// if(isset($_SESSION['userid'])){
//     echo "User id " . $_SESSION['userid'];
    
// }
// else{
//     echo "No user";
    
// }
// if(isset($_SESSION['email'])){
//     echo "Email " . $_SESSION['email'];
    
// }
// else{
//     echo "No user";
    
// }
// if(isset($_SESSION['name'])){
//     echo "Name " . $_SESSION['name'];
    
// }
// else{
//     echo "No user";
    
// }

?> -->









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
        header{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 20px 50px;
    background-color: black;
    /* background: green; */

}
.navigation a{
    position: relative;
    font-size: 1.1em;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    margin-left: 40px;
}
.navigation a::after{
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 100%;
    height: 1.5px;
    background: #fff;
    border-radius: 5px;
    transform-origin: right;
    transform: scaleX(0);
    transition: transform .5s;
}
.navigation a:hover::after{
    transform: scaleX(1);
    transform-origin: left ;
}
  .pro{
    margin: 90px 450px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 70vh;
      width: 60vh;
      border: 2px dotted black;
      flex-direction: column;
  }
  h4{
    display: flex;
    margin: 20px;
    width: fit-content;
    padding: 5px;
    justify-content: center;
    align-items: center;
    border-bottom: 1px solid black;

  }
  .btn a{text-decoration: none;  color: white;}

    </style>
<body>
    <header>
    <nav class="navigation">
            <a href="info.php">Back</a>
        
        </nav>
    </header>

    <div class="pro">

     <?php



$userid=$_SESSION['userid'];
$query2="SELECT * FROM `signin` where userid =:userid ";
$query2 = $dbh->prepare($query2);
$query2->bindparam(":userid", $userid); 
$query2->execute();
$key2 = $query2->fetch(PDO::FETCH_ASSOC);

$email = $key2['email'];
$name = $key2['name'];

echo '<h4>User ID: ' . $userid . '</h4>';
echo '<h4>Email: ' . $email . '</h4>';
echo '<h4>Name: ' . $name . '</h4>';
?>




<?php 

$query="SELECT * FROM `signin` where userid =:userid ";
$query = $dbh->prepare($query);
$query->bindparam(":userid", $userid); 
$query->execute();
$query=$query->fetchAll(PDO::FETCH_ASSOC);

foreach($query as $key){
?>

<button class="btn btn-success"><a href="editprofile.php?<?php echo "userid=". $key['userid'];  ?>">Edit</a></button>


<?php
}
?>

    </div>
</body>
</html>