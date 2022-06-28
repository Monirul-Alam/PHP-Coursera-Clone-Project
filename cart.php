<?php

session_start();
include 'connections.php';
?>
<?php include 'header/header.php';?>

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Course</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td></td>
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
		
			
			  <div class="form-group">
				<label for="exampleInputEmail1">Apply Coupon Code</label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter coupon code">
				<button type="submit" class="btn btn-primary" onclick="couponApply()">Apply</button>
			    <button type="submit" style="margin-top: 16px;" onclick="couponClear()" class="btn btn-danger">Clear</button>
			  </div>
			 
			  

			



			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">

				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span id="card-total">0</span></li>
							<li id="discountval">Discount <span>0</span></li>
							<li>Total <span id="total-value">0</span></li>
						</ul>
							<a class="btn btn-default check_out" href="checkout.php">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

<script>
            function couponClear()
            {
            	var cpn = document.getElementById("exampleInputEmail1").value;
            	document.getElementById("exampleInputEmail1").value='';
            	if(cpn.length != 0)
	            {
              	  var xhttp = new XMLHttpRequest();
	              xhttp.onreadystatechange =function()
				  {
	                if(this.readyState == 4 && this.status == 200)
					{
	                  var rs = JSON.parse(this.responseText);
					  console.log(rs);
					  if(rs.success == true)
					  	{ 
					  		document.getElementById("exampleInputEmail1").value = ''; 
					  		Loadcart();
					    }
	                }
	              };
	              xhttp.open("GET","ajax-process/couponClear.php",true);
	              xhttp.send();	
	            }
            }


            function couponApply()
            {
              var cpn = document.getElementById("exampleInputEmail1").value;
              if(cpn.length == 0)
              {
              	alert('Enter a valid coupon!');
              }
              else
              {
              	  var xhttp = new XMLHttpRequest();
	              xhttp.onreadystatechange =function()
				  {
	                if(this.readyState == 4 && this.status == 200)
					{
	                  var rs = JSON.parse(this.responseText);
					  if(rs.success == true)
					  { 
					  	Loadcart();
					  }
					  else 
					  {
					  	document.getElementById("exampleInputEmail1").value = '';
					  	alert(rs.msg);
					  } 

					  //document.getElementById("card-total").innerHTML = rs.total;
					  //document.getElementById("total-value").innerHTML = rs.total;
					  //document.getElementById("count-cart").innerHTML = rs.count;
	                  //document.getElementById("cartBody").innerHTML = rs.output;
	                  //alert(rs.message);
	                }
	              };
	              xhttp.open("GET","ajax-process/cpnAdd.php?cpn="+cpn,true);
	              xhttp.send();	
	          }

            }





            Loadcart();
            function Loadcart()
			{
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange =function()
			  {
                if(this.readyState == 4 && this.status == 200)
				{
                  var rs = JSON.parse(this.responseText);
				  //console.log(rs.subtotal);
				  document.getElementById("card-total").innerHTML = rs.total;
				  document.getElementById("discountval").innerHTML = 'Discount('+rs.disPrcntng+'%) <span>'+rs.discount+'</span>';
				  document.getElementById("total-value").innerHTML = rs.subtotal;
				  document.getElementById("exampleInputEmail1").value = rs.cpn;
				  document.getElementById("count-cart").innerHTML = rs.count;
                  document.getElementById("cartBody").innerHTML = rs.output;
                  //alert(rs.message);
                }
              };
              xhttp.open("GET","ajax-process/loadCart.php",true);
              xhttp.send();
            }


            function removeCart(id)
			{
              //alert(id);
              var id= id;
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange =function()
			  {
                if(this.readyState == 4 && this.status == 200)
				{

                  Loadcart();
                  var rs = JSON.parse(this.responseText);
				  //alert(rs[count]);
				  //console.log(rs.count);
                  //document.getElementById("count-cart").innerHTML = rs.count;
                  alert(rs.message);
                }
              };
              xhttp.open("GET","ajax-process/removeFromCart.php?id="+id,true);
              xhttp.send();
            }          
</script>

<?php


include("footer.php");


?>
</body>
</html>