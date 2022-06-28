<?php
session_start();

include("../connections.php");

if(isset($_SESSION['username']))
{
    if($_SESSION['type']=="user")
    {
        header("Location: http://localhost/course/profile.php");
        exit();
    }
    
}
else {
    header("Location: http://localhost/course/login.php");
    exit();
}
if(!isset($_GET['id']))
{
    header("Location: http://localhost/course/Admin/viewCourse.php");
    exit();
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
                                <h4 class="pull-left page-title">Add Course</h4>
                            </div>
                        </div>

                        <!-- Pls Remove -->
                        <div>
							<div class="our-courselist">
							<?php
								   if(isset($_GET['id']))
								   {
									   $value = $_GET['id'];
									   $data = get("select * from course where id=$value");
									   echo '<img weight="300" height="300" src="http://localhost/course/uploads/image/'.$data['image'].'" >';
									   echo '<h1>'.$data['cname'].'</h1></br>';
									   echo '<p>$'.$data['price'].'</p>';
									   echo '<br><h1>Playlist</h1> <hr width="130px"><br>';

									   $data = gets("select * from playlist where cid=$value");
									   $row = rows("select * from playlist where cid=$value");
									   if($row == 0)
									   {
										   echo "No Playlist availabile!";
									   }
									   echo '<ul class="our-courselist">';
									   foreach($data as $dt)
									   {
										echo '<li>';
										   echo '<a href="managePlaylist.php?id='.$dt['id'].'">'.$dt['title'].'</a><br><br>';
										   echo  '<video width="400" controls><source src="http://localhost/course/uploads/video/'.$dt['video'].'" type="video/mp4"><source src="http://localhost/course/uploads/video/'.$dt['video'].'" type="video/mkv"></video><br><br>';
										   echo '</li>';
									   }
									   echo '</ul>';
									  
								   }
							?>   
							</div>
                        
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