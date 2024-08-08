<?php
include "include/configue.php";
session_start();

if (isset($_SESSION['userid'])) {
    echo "User id " . $_SESSION['userid'];

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
        #main button{ margin: 2px 200px;  border-radius:10px;  width: fit-content; }
        /* #main a{padding:10px 20px; margin: 0px 10px; float:left; border-radius:10px; background-color:wheat;color: black; box-sizing: border-box; } */
        #card{margin: 80px; float: left; width: fit-content;}
        li{color: black;}
        .btn a{text-decoration: none;  color: white;}
       
    </style>
</head>
<body>
    <div id="main">
        <?php 
        if (isset($_SESSION['userid'])) {
            $userid = $_SESSION['userid'];

          
            $query = "SELECT * FROM `addtocart` WHERE userid = :userid";
            $query = $dbh->prepare($query);
            $query->bindParam(":userid", $userid); 
            $query->execute();
            
            while ($key = $query->fetch(PDO::FETCH_ASSOC)) {
        
                $productid = $key['productid'];
                $query2 = "SELECT * FROM `addproduct` WHERE productid = :productid";
                $query2 = $dbh->prepare($query2);
                $query2->bindParam(":productid", $productid);
                $query2->execute();
                $key2 = $query2->fetch(PDO::FETCH_ASSOC);
                
                
                ?>
     <div id="card">
         <div class="card" style="width: 17rem;">
         <button class="btn btn-success"><a href="livechat.php?<?php echo "productid=". $key['productid'];?>">Chat</a></button>
             <div class="card-body">
                            <h5 class="card-title">User id</h5> <?php echo $key2['userid']; ?>
                            <h5 class="card-title">Card title</h5> <?php echo $key2['pname']; ?>
                        </div>
             <ul class="list-group list-group-flush">
                <li class="list-group-item"><h5 class="card-title">Product id</h5> <?php echo $key2['productid']; ?></li>
                <li class="list-group-item"><h5 class="card-title">RAM</h5> <?php echo $key2['pram']; ?></li>
                <li class="list-group-item"><h5 class="card-title">ROM</h5> <?php echo $key2['prom']; ?></li>
                <li class="list-group-item"><h5 class="card-title">Camera</h5> <?php echo $key2['pcam']; ?></li>
                <li class="list-group-item"><h5 class="card-title">Battery</h5> <?php echo $key2['pbat']; ?></li>
                <li class="list-group-item"><h5 class="card-title">Price</h5> <?php echo $key2['price']; ?></li>
                
                <li class="list-group-item"><h5 class="card-title">Quantity</h5> <?php echo $key['quantity']; ?></li>
                <li class="list-group-item"><h5 class="card-title">Total price</h5> <?php echo $key['price']; ?></li>

               
        <br>
       
                        </ul>
                    
                    </div>
                </div>

               
                <?php
}
} else {
    echo "No user";
}   
?>
  
    </div>
</body>
</html>
