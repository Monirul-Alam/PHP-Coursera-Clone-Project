
<?php
session_start();

//include("conections.php");
if(!isset($_SESSION['username']))
{ 
  header("Location: login.php");exit();  
}

?>


<?php include 'header/header.php';?>
<div class="container">
      <br>  
      <h1>Thank you for being with us!</h1><br>
      <a class="btn btn-danger" href="logout.php">Logout</a>
      <br><br>
      Hello , <?php echo $_SESSION['username'];?>
    
</div>
</body>
<?php


include("footer.php");


?>
</html>