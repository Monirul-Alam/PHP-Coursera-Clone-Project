<?php
session_start();

include("../connections.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}
if(!isset($_GET['id']))
{
    header("Location: http://localhost/course/Admin/viewCourse.php");
    exit();
}








if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    
    $playlisttitle =$_POST['playlisttitle'];
    $id =$_POST['id'];
    //$video =$_POST['video'];


    if(!empty($playlisttitle))
    {
        if(!empty($_FILES["video"]["name"]))
        {
            $targetDir = "../uploads/video/";
            $fileName = basename($_FILES["video"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('mkv','mp4');
            if(in_array($fileType, $allowTypes))
            {
                move_uploaded_file($_FILES["video"]["tmp_name"], $targetFilePath);
            }
            else
            {
                $fileName = '';
                echo "InValid file type";
            }
            $query= "update playlist set title='$playlisttitle', video='$fileName'  where id=$id";
        }
        else
		{
            $query= "update playlist set title='$playlisttitle' where id=$id";
        }
       
    
       $row = update($query);
       if($row == 1)
       {
          //header("refresh: 2; url = Home.php");
          //exit();
          $_SESSION['message'] = "<h2 style='color:green;text-align:center;'>Course Details updated!</h2>";
          //header("Location: http://localhost/Course/Admin/viewCourse.php");
          //exit();
       }
       else
       {
          $_SESSION['message'] = "<h2 style='color:red;text-align:center;'>Updated Failed!</h2>";
       }
       
    }
    else
    {
        $_SESSION['message'] = "<h2 style='color:red;text-align:center;'>Updated Failed!</h2>";
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
                                <h4 class="pull-left page-title">Manage Playlist</h4>
                            </div>
                        </div>

                        <!-- Pls Remove -->
                        <div>
						    <div class="midd">
								<?php
								if(isset($_GET['id']))
								{
									$value = $_GET['id'];
									$data = get("select * from playlist where id=$value");
									//print_r($data);
								}
								if(isset($data))
								{ ?>
								<h1>Edit Playlist</h1>
								<a class="btn btn-danger" href="coursedelete.php?id=<?php echo $data['id'];?>">Delete</a><br><br>
								<?php 
									if(isset($_SESSION['message'])){echo $_SESSION['message'];unset($_SESSION['message']);}
								?>
								<form  action="" method="post" enctype="multipart/form-data">
									<input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
									<label for="title">Title</label><br><br>
									<input class="text" id="title" placeholder="video title" type="text" value="<?php echo $data['title'];?>" name="playlisttitle"><br><br>
									<video width="400" controls>
										<source src="http://localhost/course/uploads/video/<?php echo $data['video'];?>" type="video/mp4">
										<source src="http://localhost/course/uploads/video/<?php echo $data['video'];?>" type="video/mkv">
									</video><br><br>
									<label>Upload a Video</label><br><br>
									<input class="text" type="file" name="video"><br><br>
									<br>
									<input id="button" type="submit" value="save"><br><br>
								
								</form>
								<?php }?>
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