
<?php

session_start();
include("connections.php");

if(isset($_SESSION['username']))
{
    if($_SESSION['type']=="user")
    {
        header("Location: profile.php");exit();
    }
    else if($_SESSION['type']=="admin")
    {
        header("Location: Admin/Dashboard.php");exit();
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    $user_name =$_POST['user_name'];
    $password =$_POST['password'];


    $data = get("select * from users where user_name='$user_name' and password='$password'");
    $count = rows("select * from users where user_name='$user_name' and password='$password'");
    if($count==1)
    {
        
        $_SESSION['username'] = $data['user_name'];
        if($data['type']=="user")
        {
            $_SESSION['type'] = $data['type'];
            header("Location: profile.php");exit();
        }
        else if($data['type']=="admin")
        {
            $_SESSION['type'] = $data['type'];
            header("Location: Admin/Dashboard.php");exit();
        }
        
    }
    else{
        echo '<h1 style="color:red;text-align:center;">Invalid info provided!</h1>';
    }
  
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <style type="text/css">
   
    #text{
        height :25px;
        border-radius: 5px;
        padding: 4px;
        border : solid thin #aaa;
        width: 100%;
    }

    #button{
        padding : 10px;
        width: 100px;
        color: #ffff;
        background-color: blue;
        border: none;
    }

    #box{
        margin: auto;
        width: 300px;
        padding: 20px;
        margin-top:100px;
    }



    </style>
    <div class="container">
        <div class="mid">
            <div id="box">
    
                <form method="post">
                <h2>Login </h2>
                <input id="text" type="text" name="user_name"><br><br>
                <input id="text" type="password" name="password"><br><br>
                <input id="button" type="submit" value="login"><br><br>
                <p style="font-size: 20px;">Don't have an account?</p>
                <a href="signup.php"> Signup</a><br><br>
                
                </form>
            </div>
        </div>
    </div>


    <?php


include("footer.php");


?>
</body>
</html>