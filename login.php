<?php
include ("db.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>home HopeHome</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link href="img/favicon.ico" rel="icon">
        <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Nunito:600,700,800,900" rel="stylesheet"> 

        <!-- Bootstrap CSS File -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Libraries CSS Files -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="vendor/animate/animate.min.css" rel="stylesheet">
        <link href="vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Main Stylesheet File -->
        <link href="css/hover-style.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        
       <?php include 'header.php';
       ?>

		<main id="main">

			<!-- Login Section Start -->
			<section id="login">
				<div class="container">
					<div class="section-header">
						<h3>Login</h3>
					</div>
					<div class="row">
						<div class="col-md-6 form">
						  <form method="post"  >
								
								<div class="form-row">
									<div class="form-group col-md-6">
									<input type="email" name="ema"  class="form-control" placeholder="Your Email" />
									</div>
									<div class="form-group col-md-6">
										<input type="Password" name="password" class="form-control" placeholder="Repeat Your Password" />
									</div>
								</div>
								
								<div><button name="submit" type="submit">Sign Up</button></div>
							</form>
                            <?php
if(isset($_POST['submit']))
{
 $email =$_POST['ema'];
  $password =$_POST['password'];
  //echo "select * from registration where Email='$email'and Password='$password'and status='Approve'";
  $sql=mysqli_query($con, "select * from registration where Email='$email'and Password='$password'and status='Approve'");
  $n=mysqli_num_rows($sql);
  if($n>0){
    $row=mysqli_fetch_array($sql);
    $_SESSION['user']=$row;
   header("location:user/home.php");
  }
  else{
  echo '<script>alert("Invalid username or password...");window.location.href="index.php";</script>';
  }
}
?>
						</div>
						
						
							</form>
						</div>
					</div>
				</div>
			</section>
			<!-- Login Section end -->

			<!-- Subscriber Section Start -->
            <section id="subscriber">
                <div class="container">
                    <h3>Get Free visiting</h3>
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email Goes Here">
                        </div>
                        <button type="submit" class="btn">Submit</button>
                    </form>
                </div>
            </section>
            <!-- Subscriber Section end -->
            
            <!-- Support Section Start -->
            <section id="support" class="wow fadeInUp">
                <div class="container">
                    <h1>
                        Need help? Call me 24/7 at +1-234-567-8900
                    </h1>
                </div>
            </section>
            <!-- Support Section end -->

        </main>

       <?php
       include'footer.php';
       ?>

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        <!-- Uncomment below i you want to use a preloader -->
        <!-- <div id="preloader"></div> -->

        <!-- JavaScript Libraries -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/jquery/jquery-migrate.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/easing/easing.min.js"></script>
        <script src="vendor/stickyjs/sticky.js"></script>
        <script src="vendor/superfish/hoverIntent.js"></script>
        <script src="vendor/superfish/superfish.min.js"></script>
        <script src="vendor/owlcarousel/owl.carousel.min.js"></script>
        <script src="vendor/touchSwipe/jquery.touchSwipe.min.js"></script>

        <!-- Main Javascript File -->
        <script src="js/main.js"></script>

    </body>
</html>
