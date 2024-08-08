<?php
include "include/configue.php";
$userid = $_GET['userid'];

$query = "SELECT * FROM `signin` WHERE userid = :userid";
$query = $dbh->prepare($query);
$query->bindParam(":userid", $userid);
$query->execute();
$query = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px;
            background: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #ffffff;
            font-size: 1em;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background: #0056b3;
            transform: scale(1.03);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php  
        foreach ($query as $key) {
        ?>
        <form action="server/editprofileh.php" method="post">
            <input type="text" name="userid" style="display: none;" value="<?php echo htmlspecialchars($key['userid']); ?>">
            <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($key['name']); ?>">
            <input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($key['email']); ?>">
            <input type="text" name="ads" placeholder="Address" value="<?php echo htmlspecialchars($key['ads']); ?>">
            <button type="submit">Done</button>
        </form>
        <?php
        }
        ?>
    </div>
</body>
</html>
