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
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $ps =$_POST['password'];
    $password = passEncrypt($ps);
    
    if(!empty($user_name) && !empty($ps) && !empty($fname) && !empty($lname))
    {
        
       $query= "insert into users (fname,lname,user_name,password,type) values ('$fname','$lname','$user_name','$password','user')";
    
       $row = insert($query);
       if($row == 1)
       {
          $_SESSION['username'] = $user_name;
          $_SESSION['type'] = 'user';
          echo "<script> alert('Signup Successful'); </script>";
          header("Location: profile.php");
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- displays site properly based on user's device -->
  <link rel="stylesheet" href="css/signupstyle.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
  
  <title>Signup Form</title>

  
  
</head>
<body>
  <section id="intro">
    <div class="container">
      <div class="left-col">
        <h1>Buy Courses <br> and learn by online </h1>
        <p>See how experienced developers solve problems in real-time. Watching scripted tutorials is great, 
          but understanding how developers think is invaluable.</p>
      </div>
      <div class="right-col">
        <div class="top-card">
          <p><span>Register for New Account </p>
        </div>
        <div class="form-container">
          <form method="post">
            <div class="field-group">
              <label for="first-name">First Name</label>
              <input name='fname' id="first-name" type="text" placeholder="First Name">
              <img src="img/icon-error.svg" class="error-icon" alt="">
              <p class="error-text">First Name cannot be empty</p>              
            </div>
            <div class="field-group">
              <label for="last-name">last Name</label>
              <input name='lname' id="last-name" type="text" placeholder="Last Name">
              <img src="img/icon-error.svg" class="error-icon" alt="">
              <p class="error-text">Last Name cannot be empty</p>              
            </div>
            <div class="field-group">
              <label for="Email">Username</label>
              <input name='user_name' id="Email" value="" type="text" placeholder="Username">
              <img src="img/icon-error.svg" class="error-icon" alt="">
              <p class="error-text">Looks like this is not email</p>              
            </div>
            <div class="field-group">
              <label for="password">Password Address</label>
              <input name='password' id="password" value="" type="password" placeholder="Password">
              <img src="img/icon-error.svg" class="error-icon" alt="">
              <p class="error-text">Password cannot be empty</p>              
            </div>
            <button type="submit">Register Now</button>
            <p class="form-footer">By clicking the button, you are agreeing to our <span>Terms and Services</span></p>
            <p class="form-footer">Do you have an account? <span><a href="login.php"> Login</a></span></p>
          </form>
        </div>
        
      </div>
    </div>
  </section>

  

  
  
  <footer>
    <p class="footer">
      &copy;2021 E-shoppers
    </p>
  </footer>
  <script>
  const form = document.querySelector('.form-container form');
  const inputs = document.querySelectorAll('.form-container input');

form.addEventListener('submit', (e) => {
	
	inputs.forEach((input) => {
		// console.log(input.value);
		if (!input.value) 
    {
			input.parentElement.classList.add('error');
      e.preventDefault();
		} 
    else 
    {
			input.parentElement.classList.remove('error');
/*			if (input.type == 'email') 
      {
				if (validateEmail(input.value)) 
        {
					input.parentElement.classList.remove('error');
				} 
        else 
        {
					input.parentElement.classList.add('error');
				}
			}*/
		}
	});
});

/*function validateEmail (email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}*/
  </script>
</body>
</html>