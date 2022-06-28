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
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    
    $cvname =$_POST['cvname'];
    $id =$_POST['id'];
    //$video =$_POST['video'];


    if(!empty($cvname) && !empty($_FILES["video"]["name"]))
    {
        
        $targetDir = "../uploads/video/";
        $fileName = basename($_FILES["video"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $allowTypes = array('mp4','mkv');
        if(in_array($fileType, $allowTypes))
        {
            move_uploaded_file($_FILES["video"]["tmp_name"], $targetFilePath);
        }
        else
        {
            $fileName = '';
            echo "InValid file type";
        }
        $query= "insert into playlist (cid,title,video) values ($id,'$cvname','$fileName')";
        
        
       
    
       $row = insert($query);
       if($row == 1)
       {
          //header("refresh: 2; url = Home.php");
          //exit();
          $_SESSION['message'] = "<h1 style='color:green;text-align:center;'>Video uploaded to the playlist!</h1>";
       }
       else
       {
        $_SESSION['message'] = "<h2 style='color:red;text-align:center;'>Failed to uploaded to the playlist!</h2>";
       }
       
    }
    else
    {
        $_SESSION['message'] = "<h2 style='color:red;text-align:center;'>Field cann't empty!</h2>";
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
                        <div>
						  <div class="midd">
						
						
											
							<?php
								   if(isset($_GET['id']))
								   {
									   $value = $_GET['id'];
									   $data = get("select * from course where id=$value");
									   echo '<img weight="300" height="300" src="http://localhost/course/uploads/image/'.$data['image'].'" >';
									   echo '<h1>'.$data['cname'].'</h1></br>';
									   echo '<p>$'.$data['price'].'</p>';
									   echo '<br><a class="btn btn-success" href="http://localhost/course/Admin/viewPlaylist.php?id='.$data['id'].'">View Play List</a>';
								   }
							?>
								<br><h1>Add Play List</h1>
								<hr width="170px"><br>
								<?php 
									if(isset($_SESSION['message'])){echo $_SESSION['message'];unset($_SESSION['message']);}
								?>
								<form id="addPlist" action="" method="post" enctype="multipart/form-data">
									<input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
									<label for="title">Title</label><br><br>
									<input class="text form-control" id="title" placeholder="video title" type="text" name="cvname">
                                    <small style="color: red;" id="tsmall"></small>
                                    <br><br>
									<label>Upload a Video</label><br><br>
									<input class="text form-control" id="video" type="file" name="video">

                                    <small style="color: red;" id="vsmall"></small><br><br>
									<br>
									<input id="button" type="submit" value="save"><br><br>
								
								</form>
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
        <script>

            const form = document.querySelector('#addPlist');
            const video = document.getElementById('video');
            const title = document.querySelector('#title');

            title.addEventListener('keyup', function() 
            {
                var titles = document.getElementById("title").value;
                if(titles.length == 0)
                {
                    document.getElementById("tsmall").innerHTML = 'Please enter a video title!';
                    document.getElementById("title").style.borderColor = 'red';
                }
                else if(titles.length > 0)
                {
                    document.getElementById("tsmall").innerHTML = '';
                    document.getElementById("title").style.borderColor = 'green';
                }
            });
            
            video.addEventListener('change', function() 
            {
                var file = video.value;
                console.log(file);
                if(file.length == 0)
                {
                    document.getElementById("vsmall").innerHTML = 'Please select a video!';
                    video.style.borderColor = 'red';
                }
                else if(file.length > 0)
                {
                    document.getElementById("vsmall").innerHTML = '';
                    video.style.borderColor = 'green';
                }
            });


            form.addEventListener('submit', (e) => 
            {

            var videos = document.getElementById("video").value;
            var titles = document.getElementById("title").value;
                if(titles.length == 0 || videos.length == 0)
                {
                    //console.log(title.length);
                    //console.log(video.length);
                    e.preventDefault();
                    if(titles.length == 0)
                    {
                        document.getElementById("tsmall").innerHTML = 'Please enter a video title!';
                        document.getElementById("title").style.borderColor = 'red';
                    }
                    if(videos.length == 0)
                    {
                        document.getElementById("vsmall").innerHTML = 'Please select a video!';
                        document.getElementById("video").style.borderColor = 'red';
                    }

                }
            });

        </script>
	</body>
</html>