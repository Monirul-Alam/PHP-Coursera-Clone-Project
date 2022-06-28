<?php

session_start();
include("connections.php");
if(!isset($_SESSION['username']))
{ 
  header("Location: login.php");exit();  
}
?>

<?php include 'header/header.php';?>


<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-99">
					<div class="features_items">
						<h2 class="title text-left">Enrolled Courses</h2>
						<div id="cbody"></div>			
					</div>
				</div>
			</div>
		</div>
</section>

<script>
	        Loadcart();
            function Loadcart()
			{
				console.log("Running");
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange =function()
			  {
                if(this.readyState == 4 && this.status == 200)
				{
                  var rs = JSON.parse(this.responseText);
				  //console.log(rs.output);
                  document.getElementById("cbody").innerHTML = rs.output;
                  //alert(rs.message);
                }
              };
              xhttp.open("GET","ajax-process/loadCourse.php",true);
              xhttp.send();
            }
       
</script>
<?php


include("footer.php");


?>
</body>
</html>