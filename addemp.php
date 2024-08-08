<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
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
        input {
            display: block;
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button.btn {
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
        }
        button.btn:hover {
            background: #0f1c2e;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="server/addempH.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="psw" placeholder="Password" required>
            <input type="text" name="ads" placeholder="Address">
            <input type="text" name="post" placeholder="Designation">
            <input type="text" name="iban" placeholder="IBAN">
            <input type="number" name="salary" placeholder="Salary" min="0">
            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
