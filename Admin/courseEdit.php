<?php
session_start();

include("../connections.php");

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    
    $cname =$_POST['cname'];
    $id =$_POST['id'];
    $price =$_POST['price'];


    if(!empty($cname) && !empty($price))
    {
        if(!empty($_FILES["image"]["name"]))
        {
            $targetDir = "../uploads/image/";
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($fileType, $allowTypes))
            {
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
            }
            else
            {
                $fileName = '';
                echo "InValid file type";
            }
            $query= "update course set cname='$cname',image='$fileName',price=$price where id=$id";
        }
        else{
            $query= "update course set cname='$cname',price=$price where id=$id";
        }
       
    
       $row = update($query);
       if($row == 1)
       {
          //header("refresh: 2; url = Home.php");
          //exit();
          echo "<h1 style='color:green;text-align:center;'>Course details updated!</h1>";
          header("Location: http://localhost/Course/Admin/viewCourse.php");
          exit();
       }
       else
       {
          echo "Failed to update course details!";
       }
       
    }
    else
    {
        echo "<h2>Field cann't empty</h2>";
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
                                <h4 class="pull-left page-title">Edit Course</h4>
                            </div>
                        </div>

                        <!-- Pls Remove -->
                        <div>
							<?php
								if(isset($_GET['link']))
								{
									$value = $_GET['link'];
									$data = get("select * from course where id=$value");
									//print_r($data);
								}
								if(isset($data))
								{ ?>
								<form class="addCourse" action="" method="post" enctype="multipart/form-data">
										
										<input type="hidden" value="<?php echo $data['id'];?>" name="id">
										<label for="title">Course Name</label><br><br>
										<input class="text" id="title" placeholder="course name" type="text" name="cname" value="<?php echo $data['cname'];?>"><br><br>
										<label>Course Image</label><br><br>
										<img height="300" weight="300" src="http://localhost/course/uploads/image/<?php echo $data['image'];?>"><br>
										<input class="text" type="file" name="image"><br><br>
										<label for="price">Price</label><br><br>
										<input class="text" id="price" placeholder="price" type="number" name="price" value="<?php echo $data['price'];?>"><br>
										<br>
										<input id="button" type="submit" value="save"><br><br>
									
								</form>
							<?php }?>
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