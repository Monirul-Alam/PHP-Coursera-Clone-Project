<?php
include_once 'connections.php';
if(isset($_SESSION['username']))
{ 

$uname = $_SESSION['username'];
$udata = get("select * from users where user_name='".$uname."';");
$uid = $udata['id'];
$count = rows("select * from cart where uid = $uid;");
?>
        
        <li><a href="index.php" class=""><i class="fa fa-book" aria-hidden="true"></i> Course</a></li>
        <li><a href="profile.php" class=""><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
        <li><a href="myCourse.php" class=""><i class="fa fa-home" aria-hidden="true"></i> My Course</a></li>
        <li><a href="about.php" class=""><i class="fa fa-home" aria-hidden="true"></i> About</a></li>
        <li><a href="contact.php" class=""><i class="fa fa-phone" aria-hidden="true"></i> Contact</a></li>
	<li><a href="cart.php"><i class="fa fa-shopping-cart"><span id="count-cart"><?php echo $count;?></span></i> Cart</a></li>

		
<?php }
else{ ?>
        <li><a href="index.php" class=""><i class="fa fa-book" aria-hidden="true"></i> Course</a></li>
        <li><a href="about.php" class=""><i class="fa fa-home" aria-hidden="true"></i> About</a></li>
        <li><a href="contact.php" class=""><i class="fa fa-phone" aria-hidden="true"></i> Contact</a></li>
        <li><a href="login.php" class=""><i class="fa fa-lock" aria-hidden="true"></i> Login</a></li>
        <li><a href="signup.php" class=""><i class="fa fa-home" aria-hidden="true"></i> Sign Up</a></li>
        

<?php }