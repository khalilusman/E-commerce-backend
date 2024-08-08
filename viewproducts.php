<?php
include "include/configue.php";
session_start();

if(isset($_SESSION['userid'])){
    echo "User id " . $_SESSION['userid'];
    
}
else{
    echo "No user";
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Index page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <style>
        *{margin: 0;padding: 0;}
        #main{width: 100%; height: 80px; background-color: gray; padding-top: 20px; box-sizing: border-box;}
        #main a{padding:10px 20px; margin: 0px 10px; float:left; border-radius:10px; background-color:wheat;color: black; box-sizing: border-box; }
        #card{margin: 80px; float: left; width: fit-content;}
        li{color: black;}
        .btn a{text-decoration: none;  color: white;}
    </style>
</head>
<body>
    

    <div id="main">
        <?php
if(isset($_SESSION['userid'])){
    echo '<a href="server/logouth.php">Logout</a>
    <a href="addproduct.php">Add Product</a>
    <a href="index.php">Home</a>
';
   
   }
   else{
    echo '<a href="signup.php">Signup</a>
    <a href="login.php">Login</a>';
   
   }
?>
    </div>



<?php 
$userid=$_SESSION['userid'];
$query="SELECT * FROM `addproduct` where userid =:userid ";
$query = $dbh->prepare($query);
$query->bindparam(":userid", $userid); 
$query->execute();
$query=$query->fetchAll(PDO::FETCH_ASSOC);

foreach($query as $key){
?>

    <div id="card">
    <div class="card" style="width: 17rem;">
  
  <div class="card-body">
    <h5 class="card-title">Card title </h5> <?php  echo   $key['pname']; ?>
</div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item" style="display: none;"><h5 class="card-title" >Product id</h5> <?php echo  $key['productid']; ?></li>
    <li class="list-group-item" style="display: none;"><h5 class="card-title">userid</h5> <?php echo  $key['userid']; ?></li>
    <li class="list-group-item"><h5 class="card-title">RAM</h5> <?php echo  $key['pram']; ?></li>
    <li class="list-group-item"><h5 class="card-title">ROM</h5> <?php  echo $key['prom']; ?></li>
    <li class="list-group-item"><h5 class="card-title">Camera</h5> <?php  echo $key['pcam']; ?></li>
    <li class="list-group-item"><h5 class="card-title">Battery</h5> <?php  echo $key['pbat']; ?></li>
    <li class="list-group-item"><h5 class="card-title">Price</h5> <?php  echo $key['price']; ?></li>
    
    <button class="btn btn-success"><a href="editproduct.php?<?php echo "productid=". $key['productid'];  ?>">Edit</a></button>
         <button class="btn btn-danger"><a href="server/deleteproducth.php?<?php echo "productid=". $key['productid'];  ?>">Delete</a></button>
 
 </li>
</ul></div></div>

<?php
}
?>

        
    </div>
</body>
</html>