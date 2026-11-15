<?php
include ("db.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>orphange</title>
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
       <?php include 'header.php'; ?>

        <main id="main">
            <!-- About Section Start-->
            <section id="about">
                <div class="container">
                    <div class="row justify-content-center"> <!-- center the row contents -->
                        <div class="col-lg-8 col-md-10 mx-auto"> <!-- center the column -->
                            <div class="card p-4 shadow-sm"> <!-- optional: gives a nice card effect -->
                                <h3 class="text-center mb-4">Register</h3>
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Your Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ema" class="form-label">Your Email</label>
                                            <input type="email" class="form-control" id="ema" name="ema" placeholder="Your Email" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="addr" class="form-label">Your Address</label>
                                            <input type="text" class="form-control" id="addr" name="address" placeholder="Your Address" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pin" class="form-label">Your PIN</label>
                                            <input type="number" class="form-control" id="pin" name="pin" placeholder="Your PIN" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="ph" class="form-label">Mobile</label>
                                            <input type="number" class="form-control" id="ph" name="mob" placeholder="Your phone" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pswd" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Your password" required>
                                        </div>
                                    </div>

                                    <!-- NEW: Photo Upload -->
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Upload Your Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                                    </div>

                                    <!-- NEW: Document Upload -->
                                    <div class="mb-3">
                                        <label for="doc" class="form-label">Upload Document (PDF/JPG/PNG)</label>
                                        <input type="file" class="form-control" id="doc" name="doc" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="s1" class="btn btn-primary px-5">Register</button>
                                    </div>
                                </form>

                            <?php
if(isset($_POST['s1'])){
    $name=$_POST['name'];
    $address=$_POST['address'];
    $pin=$_POST['pin'];
    $email=$_POST['ema'];
    $mobile=$_POST['mob'];
    $password=$_POST['pswd'];

    // --- PHOTO UPLOAD ---
    $photoName = $_FILES['photo']['name'];
    $photoTmp  = $_FILES['photo']['tmp_name'];
    $photoExt  = pathinfo($photoName, PATHINFO_EXTENSION);
    $photoNew  = "uploads/photos/".time()."_photo.".$photoExt;

    // --- DOCUMENT UPLOAD ---
    $docName = $_FILES['doc']['name'];
    $docTmp  = $_FILES['doc']['tmp_name'];
    $docExt  = pathinfo($docName, PATHINFO_EXTENSION);
    $docNew  = "uploads/docs/".time()."_doc.".$docExt;

    // create folders if not exist
    if(!is_dir("uploads/photos")) mkdir("uploads/photos",0777,true);
    if(!is_dir("uploads/docs")) mkdir("uploads/docs",0777,true);

    // Move files safely
    if(move_uploaded_file($photoTmp, $photoNew) && move_uploaded_file($docTmp, $docNew)) {
        $sql= mysqli_query($con,"INSERT INTO registration(Name,Address,Pin,Email,Mobile,Password,Photo,Document,status) 
                VALUES('$name','$address','$pin','$email','$mobile','$password','$photoNew','$docNew','pending')");

        if($sql){
            echo "<script>alert('Successfully saved your details...');</script>";
        } else {
            echo "<script>alert('Database insert failed');</script>";
        }
    } else {
        echo "<script>alert('File upload failed');</script>";
    }
}
?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About Section End-->
        </main>
          
        <?php include 'footer.php'; ?>

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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
