<?php
session_start();

include("../connections.php");

if(!isset($_SESSION['username']))
{
    if($_SESSION['type']!="admin")
    {
        header("Location: http://localhost/course/login.php");
        exit();
    }
    else
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
                                <h4 class="pull-left page-title">Course List</h4>
                            </div>
                        </div>

                        <!-- Pls Remove -->
                        <div style="height:600px;">
						
						
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Play List</th>
	  <th scope="col">Price</th>
	  <th scope="col">Delete</th>
	  <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
	  <?php
									$data = gets("select * from course");
									//print_r($data);
									$count = 1;
									foreach($data as $value)
									{ 
									 echo '<tr>';
									 echo '<th scope="row">'.$count++.'</th>';
									 
									 echo '<td><a href="addvideo.php/?id='.$value['id'].'">'.$value['cname'].'</a></td>';
									 echo '<td><img height="100" width="100" src="http://localhost/course/uploads/image/'.$value['image'].'" ></td>';
									 echo '<td><a class="btn btn-primary" href="http://localhost/course/Admin/viewPlaylist.php?id='.$value['id'].'">View</a></td>';
									 echo '<td>$'.$value['price'].'</td>';
									 echo '<td><a class="btn btn-danger" href="coursedelete.php?link='.$value['id'].'">Delete</a></td>';
									 echo '<td><a class="btn btn-success"  href="courseEdit.php?link='.$value['id'].'">Edit</a></td>';
									 echo '</tr>';
		}?>
      


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
    
        <script>
            var resizefunc = [];
        </script>

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


        <!-- CUSTOM JS -->
        <script src="../AdminAssets/js/jquery.app.js"></script>
	
	</body>
</html>