<?php
include "include/configue.php";
$productid = $_GET['productid'];

$query = "SELECT * FROM `addproduct` WHERE productid = :productid";
$query = $dbh->prepare($query);
$query->bindParam(":productid", $productid);
$query->execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        form {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            max-width: 100%;
            box-sizing: border-box;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            display: block;
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="file"] {
            padding: 5px;
        }
        button {
            width: 100%;
            height: 40px;
            background: #162938;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            color: #fff;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
        }
        button:hover {
            background: #0f1c2e;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php  
        foreach ($query as $key) {
        ?>
        <form action="server/editproducth.php" method="post" enctype="multipart/form-data">
            <input type="text" name="productid" style="display: none;" value="<?php echo htmlspecialchars($key['productid']); ?>">
            <input type="text" name="pname" placeholder="Product Name" value="<?php echo htmlspecialchars($key['pname']); ?>">
            <input type="text" name="pram" placeholder="RAM" value="<?php echo htmlspecialchars($key['pram']); ?>">
            <input type="text" name="prom" placeholder="ROM" value="<?php echo htmlspecialchars($key['prom']); ?>">
            <input type="text" name="pcam" placeholder="Camera" value="<?php echo htmlspecialchars($key['pcam']); ?>">
            <input type="text" name="pbat" placeholder="Battery" value="<?php echo htmlspecialchars($key['pbat']); ?>">
            <input type="number" name="price" placeholder="Price" value="<?php echo htmlspecialchars($key['price']); ?>">
            <input type="file" name="files[]">
            <button type="submit">Done</button>
        </form>
        <?php
        }
        ?>
    </div>
</body>
</html>
