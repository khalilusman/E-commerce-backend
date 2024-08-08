<?php

include "include/configue.php";
session_start();

if (isset($_SESSION['userid'])) {
    if ($_SESSION['accountStatus'] == 'user') {
        echo ' User ';
        echo ' id = ';
        echo $_SESSION['userid'];
    } else if ($_SESSION['accountStatus'] == 'admin') {
        echo ' Admin ';
        echo ' id = ';
        echo $_SESSION['userid'];
    } else if ($_SESSION['accountStatus'] == 'employee') {
        echo ' Employee ';
        echo ' id = ';
        echo $_SESSION['userid'];
    }
} else {
    echo 'Logged Out';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #main {
            width: 100%;
            height: 80px;
            background-color: gray;
            padding-top: 20px;
            box-sizing: border-box;
        }
        #main a {
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 10px;
            background-color: wheat;
            color: black;
            text-decoration: none;
        }
        #card {
            margin: 20px;
            width: fit-content;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .likes {
            display: none;
            background-color: lightgray;
            padding: 5px 10px;
            border-radius: 5px;
            width: fit-content;
        }
        .like-button:hover + .likes {
            display: block;
        }
        .content {
            text-align: center;
            line-height: 100px;
            font-size: 50px;
        }
        .list-group-item {
            background-color: #f8f9fa;
        }
    </style>
  
</head>
<body>
    <div id="main" class="d-flex justify-content-center align-items-center">
        <?php
        if (isset($_SESSION['userid'])) {
            if ($_SESSION['accountStatus'] == 'user') {
                echo '<a href="server/logouth.php">Logout</a>
                      <a href="info.php">Info</a>
                      <a href="addtocart.php">My cart</a>';
            } else if ($_SESSION['accountStatus'] == 'admin') {
                echo '<a href="server/logouth.php">Logout</a>
                      <a href="addproduct.php">Add Product</a>
                      <a href="viewproducts.php">View Products</a>
                      <a href="info.php">Info</a>
                      <a href="addemp.php">Add Employee</a>
                      <a href="dml.php">dml</a>
                      <a href="addtocart.php">My cart</a>';
            } else if ($_SESSION['accountStatus'] == 'employee') {
                echo '<a href="server/logouth.php">Logout</a>
                      <a href="info.php">Info</a>
                      <a href="addtocart.php">My cart</a>';
            }
        } else {
            echo '<a href="signup.php">Signup</a>
                  <a href="login.php">Login</a>';
        }
        ?>
    </div>

    <div class="container mt-4">
        <div class="row">
            <?php
            $userid = $_SESSION['userid'];
            $query = "SELECT * FROM `addproduct`";
            $query = $dbh->prepare($query);
            $query->execute();
            $query = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($query as $key) {
            ?>
                <div id="card" class="col-md-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <button class="like-button btn btn-secondary btn-sm">Likes</button>
                                <div class="likes">
                                    <?php
                                    $productid = $key['productid'];

                                    $query4 = "SELECT * FROM `plikes` WHERE productid=:productid";
                                    $query4 = $dbh->prepare($query4);
                                    $query4->bindParam(":productid", $productid);
                                    $query4->execute();
                                    $query4 = $query4->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($query4 as $key4) {
                                        $likeusers = $key4['userid'];
                                        $query5 = "SELECT * FROM `signin` WHERE userid=:likeusers";
                                        $query5 = $dbh->prepare($query5);
                                        $query5->bindParam(":likeusers", $likeusers);
                                        $query5->execute();
                                        $query5 = $query5->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($query5 as $key5) {
                                            echo $key5['name'] . '<br>';
                                        }
                                    }

                                    $userLiked = false;

                                    foreach ($query4 as $key4) {
                                        if ($key4['userid'] == $userid) {
                                            $userLiked = true;
                                            break;
                                        }
                                    }
                                    ?>
                                </div>
                            </h5>
                            <?php
                            if ($userLiked) {
                                echo '<a href="server/unlike.php?productid=' . $key['productid'] . '&userid=' . $userid . '" class="btn btn-danger">Unlike</a>';
                            } else if (isset($_SESSION['userid'])) {
                                echo '<a href="server/plikes.php?productid=' . $key['productid'] . '&user=' . $userid . '&like=' . $likeusers . '" class="btn btn-success">Like</a>';
                            } else {
                                echo 'Login to like';
                            }
                            ?>

                            <h5 class="card-title mt-3">Product Name: <?php echo $key['pname']; ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php
                            $productid = $key['productid'];
                            $query2 = "SELECT * FROM `productimg` WHERE productid = :productid";
                            $query2 = $dbh->prepare($query2);
                            $query2->bindParam(":productid", $productid);
                            $query2->execute();
                            $query2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                            echo '<li class="list-group-item">';
                            if (count($query2) <= 100) {
                                if($query2) {
                                    $image = $query2[0]['images'];
                                    $image = str_replace("../", "", $image);
                                    echo '<img src="' . $image . '" alt="no img" class="img-fluid">';
                                } else {
                                    echo 'no image';
                                }
                            } else {
                                echo 'Not enough elements in the array.';
                            }
                            echo '</li>';
                            ?>

                            <li class="list-group-item"><strong>Seller ID:</strong> <?php echo $key['userid']; ?></li>
                            <li class="list-group-item"><strong>RAM:</strong> <?php echo $key['pram']; ?></li>
                            <li class="list-group-item"><strong>ROM:</strong> <?php echo $key['prom']; ?></li>
                            <li class="list-group-item"><strong>Camera:</strong> <?php echo $key['pcam']; ?></li>
                            <li class="list-group-item"><strong>Battery:</strong> <?php echo $key['pbat']; ?></li>
                            <li class="list-group-item"><strong>Price:</strong> <?php echo $key['price']; ?></li>

                            <li class="list-group-item">
                                <form class="add-to-cart-form" action="server/addtocarth.php" method="post">
                                    Quantity: <input type="number" name="quantity" value="1" class="form-control mb-2">
                                    <input type="hidden" name="productid" value="<?php echo $key['productid']; ?>">
                                    <input type="hidden" name="userid" value="<?php echo $_SESSION['userid']; ?>">
                                    <button class="btn btn-success" type="submit">Add to Cart</button>
                                </form>
                            </li>
                            <li class="list-group-item">
                                <form class="order-form" action="server/orderh.php" method="post">
                                    Quantity: <input type="number" name="quantity" value="1" class="form-control mb-2">
                                    <input type="hidden" name="productid" value="<?php echo $key['productid']; ?>">
                                    <input type="hidden" name="userid" value="<?php echo $_SESSION['userid']; ?>">
                                    <button class="btn btn-primary" type="submit">Order</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
