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
                                <h4 class="pull-left page-title">Dashboard</h4>
                            </div>
                        </div>

                        <!-- Pls Remove -->
                        <div style="height:600px;">
                        <div class="container">
                    
                    
                        <a href="../logout.php">Logout</a><br><br>
                        <h1>Welcome to Admin Dashboard!</h1>
                        <br>
                        Hello , <?php echo $_SESSION['username'];?>
                    
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