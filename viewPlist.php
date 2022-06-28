<?php

session_start();
include 'connections.php';
if(!isset($_SESSION['username']))
{ 
  header("Location: login.php");exit();  
}


if(!isset($_GET['id']))
{ 
  header("Location: myCourse.php");exit();
}
else
{
	//
}


?>

<?php include 'header/header.php';?>


<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-99">
					<div class="features_items">
						<?php

                           if(isset($_GET['id']))
                           {
                           	$id = $_GET['id'];
                           	$data = get("select * from course where id= $id");
                           	//print_r($data);
                           	echo '<h2 class="title text-left">'.$data['cname'].'</h2>';
                           	echo '<img height="250" width="350" src="http://localhost/course/uploads/image/'.$data['image'].'" ><br><br>';
                           }

						?>			
					</div>
				</div>
				<div class="col-sm-99">
					<div class="features_items">
						<h2 class="title text-left">Playlist of <?php echo $data['cname'];?></h2>
						<?php

                           if(isset($_GET['id']))
                           {
                           	$id = $_GET['id'];
                           	$playlist = gets("select * from playlist where cid= $id order by id");
                           	$cnt = 1;
                           	foreach ($playlist as $value) 
                           	{
                           		
                           		echo '<div class="col-sm-3">
                           		<div class="product-image-wrapper">
                           		<div class="single-products">
                           		<div class="productinfo text-center">';
                           		echo '<video width="300" controls>
										<source src="http://localhost/course/uploads/video/'.$value['video'].'" type="video/mp4">
										<source src="http://localhost/course/uploads/video/'.$value['video'].'" type="video/mkv">
								</video>';
                           		echo '<h2>'.$cnt++.'.'.$value['title'].'</h2>';
                           		
                           		echo '</div></div></div></div>';
                           	}
                           }

						?>
					</div>
				</div>
			</div>
		</div>
</section>

<script>
	  //       Loadcart();
   //          function Loadcart()
			// {
			// 	console.log("Running");
   //            var xhttp = new XMLHttpRequest();
   //            xhttp.onreadystatechange =function()
			//   {
   //              if(this.readyState == 4 && this.status == 200)
			// 	{
   //                var rs = JSON.parse(this.responseText);
			// 	  //console.log(rs.output);
   //                document.getElementById("cbody").innerHTML = rs.output;
   //                //alert(rs.message);
   //              }
   //            };
   //            xhttp.open("GET","ajax-process/loadCourse.php",true);
   //            xhttp.send();
   //          }
       
</script>
<?php


include("footer.php");


?>
</body>
</html>