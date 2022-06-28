<?php

session_start();
include("connections.php");
?>
<?php include 'header/header.php';?>





	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-99">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-left">Shop Items</h2>
						
						
						    <?php
								$data = gets("select * from course");
								//print_r($data);
								foreach($data as $value)
								{
								echo '<div class="col-sm-3"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center">';
								echo '<img height="200" src="http://localhost/course/uploads/image/'.$value['image'].'" >';
								echo '<h2>$'.$value['price'].'</h2>';
								echo '<p>'.$value['cname'].'</p>';
								if(isset($_SESSION['username']))
								{
									echo '<a onclick="addToCart('.$value['id'].')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>';
								}
								echo '</div></div></div></div>';
							    }
							?>
						
	
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
<script>
            function addToCart(id)
			{
              //alert(id);
              var id= id;
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange =function()
			  {
                if(this.readyState == 4 && this.status == 200)
				{
                  var rs = JSON.parse(this.responseText);
				  //alert(rs[count]);
				  //console.log(rs.count);
                  document.getElementById("count-cart").innerHTML = rs.count;
                  alert(rs.message);
                }
              };
              xhttp.open("GET","ajax-process/addtocard.php?id="+id,true);
              xhttp.send();
            }
</script>
	
<?php


include("footer.php");


?>
</body>
</html>