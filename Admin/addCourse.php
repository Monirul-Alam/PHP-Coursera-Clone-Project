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
    $price =$_POST['price'];


    if(!empty($cname) && !empty($price))
    {
        $targetDir = "../uploads/image/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        if(!empty($_FILES["image"]["name"]))
        {
            $allowTypes = array('jpg','png','jpeg');
            if(in_array($fileType, $allowTypes))
            {
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
            }
            else{
                $fileName = '';
                echo "InValid file type";
            }
        }
       $query= "insert into course (cname,image,price) values ('$cname','$fileName','$price')";
    
       $row = insert($query);
       if($row == 1)
       {
          //header("refresh: 2; url = Home.php");
          //exit();
          $_SESSION['message'] = "<h2 style='color:green;text-align:center;'>New course created!</h2>";
       }
       else
       {
          $_SESSION['message'] = "<h2 style='color:red;text-align:center;'>Failed to uploaded to the playlist!</h2>";
       }
       
    }
    else
    {
        echo "<h2>Please Provide course information</h2>";
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
                                <h4 class="pull-left page-title">Add Course</h4>
                            </div>
                        </div>

                        <!-- Pls Remove -->
                        <div style="height:600px;">
                                <?php 
									if(isset($_SESSION['message'])){echo $_SESSION['message'];unset($_SESSION['message']);}
								?>
                            <form class="addCourse" action="" method="post" enctype="multipart/form-data">
                                    <label for="title">Course Name</label><br><br>
                                    <input class="text" id="title" placeholder="course name" type="text" name="cname"><br><br>
                                    <label>Course Image</label><br><br>
                                    <input class="text" type="file" name="image"><br><br>
                                    <label for="price">Price</label><br><br>
                                    <input class="text" id="price" placeholder="price" type="number" name="price"><br>
                                    <br>
                                    <input id="button" type="submit" value="save"><br><br>
                                
                            </form>
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