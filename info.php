

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
       }
        header{
    position: fixed;
    /* top: 0;
    left: 0; */
    width: 20vh;
    height: 100vh;
    padding: 20px 100px;
    background-color: black;
    /* background: green; */

}
.navigation a{
    position: relative;
    font-size: 1.1em;
    color: #fff;
    text-decoration: none;
    margin: 5px;
    font-weight: 500;
   
    
}
.navigation a::after{
    content: '';
    position: absolute;
    left: 0;
    bottom: 6px;
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
  

    </style>
<body>
    <header>
    <nav class="navigation">
            <a href="profile.php">Profile</a>
            <a href="pswchange.php">change password</a>
           
            
        </nav>
    </header>
</body>
</html>