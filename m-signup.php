<?php
session_start();

include("connections.php");
if(isset($_SESSION['username']))
{
    header("Location: profile.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    $user_name =$_POST['user_name'];
    $password =$_POST['password'];

    if(!empty($user_name) && !empty($password))
    {
        
       $query= "insert into users (user_name,password,type) values ('$user_name','$password','user')";
    
       $row = insert($query);
       if($row == 1)
       {
          $_SESSION['username'] = $user_name;
          header("refresh: 2; url = profile.php");
          exit();
       }
       else
       {
          echo "Failed to create your user account!";
       }
       
    }
    else
    {
        echo '<h3 style="color:red;text-align:center;">Please Provide Valid Information</h3>';
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
    <title>Signup</title>
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
        <?php //include 'menu.php'; ?>
        <div id="box">
            <form method="post">
            <h2>Sign Up </h2>
            <input id="text" type="text" name="user_name" placeholder="Username"><br><br>
            <input id="text" type="password" name="password" placeholder="New Password"><br><br>
            <input id="button" type="submit" value="signup"><br><br>
            <p style="font-size: 20px;">Do you have an account?</p>
            <a href="login.php"> Login</a><br><br>
            
            </form>
        </div>
    </div>
</div>
    <?php


include("footer.php");


?>
</body>
</html>