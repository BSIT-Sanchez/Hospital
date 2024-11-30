
<?php
include_once('hms/include/config.php');
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$mobileno=$_POST['mobileno'];
$dscrption=$_POST['description'];
$query=mysqli_query($con,"insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$dscrption')");
echo "<script>alert('Your information succesfully submitted');</script>";
echo "<script>window.location.href ='index.php'</script>";

} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Holy Spirit Health Care </title>
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
     <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
    <body>
     <section id="logins" class="our-blog container-fluid">
        <div class="container">
        <div class="inner-title">

                <h2><strong>Welcome to Holy Spirit Health Care.</strong></h2>
          <p><em>Please Login.</em></p>
          </div>
            <div class="col-sm-12 blog-cont">
                <div class="row no-margin">
                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">

                             <div class="blog-single-det bg-dark text-white">
                                <h6>Patient Login</h6>
                                <a href="hms/user-login.php" target="_blank">
                                    <button class="btn btn-success btn-sm bg-info">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">

                            <div class="blog-single-det bg-dark text-white">
                                <h6>Doctor's login</h6>
                                <a href="hms/doctor" target="_blank">
                                    <button class="btn btn-success btn-sm bg-info">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">

                            <div class="blog-single-det bg-dark text-white">
                                <h6>Admin's Login</h6>
                    
                                <a href="hms/admin" target="_blank">
                                    <button class="btn btn-success btn-sm bg-info">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>         
                </div>
            </div>
            
        </div>
    </section>  

    <footer class="footer">
        <div class="container">
            <div class="row">
       
                <div class="col-md-6 col-sm-12 map-img">
                    <h2>Contact Us</h2>
                    <address class="md-margin-bottom-40">

<?php
$ret=mysqli_query($con,"select * from tblpage where PageType='contactus' ");
while ($row=mysqli_fetch_array($ret)) {
?>


                        <?php  echo $row['PageDescription'];?> <br>
                        Phone: <?php  echo $row['MobileNumber'];?> <br>
                        Email: <a href="mailto:<?php  echo $row['Email'];?>" class=""><?php  echo $row['Email'];?></a><br>
                    </address>

        <?php } ?>





                </div>
            </div>
        </div>
        

    </footer>
    <div class="copy">
            <div class="container"><center>
              <strong>Holy Spirit Health Center </strong>
            </center>
      </div>

        </div>
    
    </body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-nav/js/jquery.easing.min.js"></script>
<script src="assets/plugins/scroll-nav/js/scrolling-nav.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>

<script src="assets/js/script.js"></script>



</html>