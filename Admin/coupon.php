<?php
session_start();

//include("conections.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}
else{
    if($_SESSION['type']=="user")
    {
        header("Location: http://localhost/course/profile.php");
        exit();
    }
}
?>


            <?php include '../header/AdminHeader.php'; ?>                  
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Coupon</h4>
                            </div>
                        </div>

                        <!-- Pls Remove -->
                        <div>
							
							
							
							
							
							
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="checkBTN()" data-whatever="@mdo">Add new</button>

							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">New message</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  <div class="modal-body">
									<form>
									  <div class="form-group">
										<label for="couponCode">Enter a coupon</label>
										<input type="text" class="form-control" id="couponCode" aria-describedby="emailHelp" placeholder="Coupon">
									  </div>
									  <div class="form-group">
										<label for="couponP">Percentenge</label>
										<input type="number" class="form-control" id="couponP" placeholder="Enter an percentenge">
									  </div>
									</form>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" id="btnSave" class="btn btn-primary" onclick="addCoupon()">Save</button>
									<button type="button" id="btnUpdate" value="" class="btn btn-primary" onclick="updateCoupon()">Update</button>
								  </div>
								</div>
							  </div>
							</div>
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							<br><br>
							<table class="table table-striped">
							  <thead>
								<tr>
								  <th scope="col">#id</th>
								  <th scope="col">Coupon Code</th>
								  <th scope="col">Percentange(%)</th>
								  <th scope="col" colspan="2">Action</th>
								</tr>
							  </thead>
							  <tbody id="allCoupons">
								
								
								
							  </tbody>
							</table>
                        </div>


                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <footer class="footer text-right">
                    2015 © Moltran.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->





        </div>
        <!-- END wrapper -->
    


        <!-- jQuery  -->
        <script src="../AdminAssets/js/jquery.min.js"></script>
        <script src="../AdminAssets/js/bootstrap.min.js"></script>
        <script src="../AdminAssets/js/waves.js"></script>
        <script src="../AdminAssets/js/wow.min.js"></script>
        <script src="../AdminAssets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="../AdminAssets/js/jquery.scrollTo.min.js"></script>
        <script src="../AdminAssets/assets/jquery-detectmobile/detect.js"></script>
        <script src="../AdminAssets/assets/fastclick/fastclick.js"></script>
        <script src="../AdminAssets/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="../AdminAssets/assets/jquery-blockui/jquery.blockUI.js"></script>


        <script src="../AdminAssets/js/jquery.app.js"></script>
	    <script>
            var resizefunc = [];
			function updateCoupon()
			{

				var coupon = document.getElementById("couponCode").value;
				var couponP = document.getElementById("couponP").value;
				var cid = document.getElementById("btnUpdate").value;
				//console.log(coupon.length);
				if(coupon.length > 0 && couponP.length > 0)
				{
					if (couponP > 0 && couponP < 101) 
					{
					  var xhttp = new XMLHttpRequest();
		              xhttp.onreadystatechange =function()
					  {
		                if(this.readyState == 4 && this.status == 200)
						{
		                  var rs = JSON.parse(this.responseText);
						  if(rs.success == true)
						  {
	                        jQuery("#exampleModal").modal("hide");
						  	makeEmpty();
						  	showCopun();

						  }
						  alert(rs.ms);
		                }
		              };
		              xhttp.open("GET","../ajax-process/updateCoupon.php?val="+coupon+"&vl="+couponP+"&id="+cid,true);
		              xhttp.send();
					}
					else{ alert("enter percentenge value between 0 to 100 !"); }

				}
				else{ alert("Field couldn't empty!"); }
			}





			function checkBTN()
			{
				makeEmpty();
				jQuery("#btnSave").show();
		        jQuery("#btnUpdate").hide();
		        document.getElementById("exampleModalLabel").innerHTML = "Add new";
			}
			function editCoupon(id)
			{
				var cid = id;
				var xhttp = new XMLHttpRequest();
		        xhttp.onreadystatechange =function()
					{
		                if(this.readyState == 4 && this.status == 200)
						{
		                  var rs = JSON.parse(this.responseText);
		                  //console.log(rs);
		                  jQuery("#exampleModal").modal("show");
		                  jQuery("#btnSave").hide();
		                  jQuery("#btnUpdate").show();
		                  document.getElementById("couponCode").value = rs.code;
		                  document.getElementById("couponP").value = rs.percent;
		                  document.getElementById("btnUpdate").value = rs.id;
		                  document.getElementById("exampleModalLabel").innerHTML = "Edit";
		                }
		            };
		        xhttp.open("GET","../ajax-process/CouponValue.php?id="+cid,true);
		        xhttp.send();
			}


			function deleteCoupon( id)
			{
				var cid = id;
				var xhttp = new XMLHttpRequest();
		        xhttp.onreadystatechange =function()
					{
		                if(this.readyState == 4 && this.status == 200)
						{
		                  var rs = JSON.parse(this.responseText);
		                  if(rs.success==true)
		                  {
		                  	alert(rs.ms);
		                  	showCopun();
		                  }
		                  else
		                  {
		                  	alert('Couldn\'t deleted!');
		                  }
		                }
		            };
		        xhttp.open("GET","../ajax-process/deleteCoupon.php?id="+cid,true);
		        xhttp.send();
			}
			function makeEmpty()
			{
				document.getElementById("couponCode").value = '';
				document.getElementById("couponP").value = '';
			}
			function showCopun()
			{
                var xhttp = new XMLHttpRequest();
		        xhttp.onreadystatechange =function()
					{
		                if(this.readyState == 4 && this.status == 200)
						{
		                  var rs = JSON.parse(this.responseText);
		                  document.getElementById("allCoupons").innerHTML = rs.output;
		                }
		            };
		        xhttp.open("GET","../ajax-process/showCoupon.php",true);
		        xhttp.send();
			}
			showCopun();
            function addCoupon()
			{
				var coupon = document.getElementById("couponCode").value;
				var couponP = document.getElementById("couponP").value;
				//console.log(coupon.length);
				if(coupon.length > 0 && couponP.length > 0)
				{
					if (couponP > 0 && couponP < 101) 
					{
					  var xhttp = new XMLHttpRequest();
		              xhttp.onreadystatechange =function()
					  {
		                if(this.readyState == 4 && this.status == 200)
						{
		                  var rs = JSON.parse(this.responseText);
		                  //var rs = this.responseText;
						  if(rs.success == true)
						  {
						  	//let element = document.getElementById("exampleModal");
						  	
						  	//element.classList.remove("in");
	                        jQuery("#exampleModal").modal("hide");
						  	makeEmpty();
						  	showCopun();
						  	//element.style.display = "none";
						  	//jQuery("body.fixed-left").removeClass('modal-open');
						  	//jQuery(".modal-backdrop").remove();
						  	//rem.style.display = "none";
						  	//rem.classList.remove("in");
						  	//element.close;
						  	//document.getElementsByClassName('modal-backdrop fade').style.display = "none";

						  }
						  alert(rs.ms);
		                }
		              };
		              xhttp.open("GET","../ajax-process/couponAdd.php?val="+coupon+"&vl="+couponP,true);
		              xhttp.send();
					}
					else{ alert("enter percentenge value between 0 to 100 !"); }

				}
				else{ alert("Field couldn't empty!"); }

			}
        </script>
	</body>
</html>