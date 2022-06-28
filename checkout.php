<?php

session_start();
include 'connections.php';
?>
<?php include 'header/header.php';?>

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li class="active">Checkout</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Courses</td>
							<td class="description"></td>
							<td class="price">Price</td>
							
						</tr>
					</thead>
					<tbody id="cartBody">
						

						

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">

				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span id="card-total">$59</span></li>
							<li id="discountval">Discount <span>$0</span></li>
							<li>Total <span id="total-value">$61</span></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Username <span id="user-name">$59</span></li>
							<li>First Name <span id="fname">$59</span></li>
							<li>Last Name <span id="lname">$59</span></li>
						</ul>
					</div>
				</div>
				
						
				
			</div>
			<div class="row">
				<h2>Enter Your master Card number</h2>
				<input id="master-card"  type="number" class="form-control" name="mnumber">
				<p></p>
			</div>
			<div class="row">
				<br><br>
			    <a onclick="Checkout()" class="btn btn-success">Enroll</a>
			</div>
		</div>
	</section><!--/#do_action-->

<script>
	        Loadcart();
            function Loadcart()
			{
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange =function()
			  {
                if(this.readyState == 4 && this.status == 200)
				{
                  var rs = JSON.parse(this.responseText);
				  //console.log(rs.output);
				  document.getElementById("card-total").innerHTML = rs.total;				  
				  document.getElementById("user-name").innerHTML = rs.username;
				  document.getElementById("fname").innerHTML = rs.fname;
				  document.getElementById("lname").innerHTML = rs.lname;
				  document.getElementById("count-cart").innerHTML = rs.count;
                  document.getElementById("cartBody").innerHTML = rs.output;
                  //alert(rs.message);


				  document.getElementById("discountval").innerHTML = 'Discount('+rs.disPrcntng+'%) <span>'+rs.discount+'</span>';
				  document.getElementById("total-value").innerHTML = rs.subtotal;                
				}
              };
              xhttp.open("GET","ajax-process/checkoutLoader.php",true);
              xhttp.send();
            }


            function Checkout()
			{
			  var card = document.getElementById("master-card").value;
			  console.log(card);
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange =function()
			  {
                if(this.readyState == 4 && this.status == 200)
				{

                  
                  var rs = JSON.parse(this.responseText);
				  
                  alert(rs.ms);
                  if(rs.success == true)
                  {window.location.href = 'http://localhost/course/myCourse.php';}
                }
              };
              xhttp.open("GET","ajax-process/checkoutControll.php?card="+card , true);
              xhttp.send();
            }
</script>

<?php


include("footer.php");


?>
</body>
</html>