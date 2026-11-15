<?php
include("../db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Our Services - Dr. Johnson</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicons -->
    <link href="img/favicon.ico" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Nunito:600,700,800,900" rel="stylesheet"> 

    <!-- Bootstrap & Vendor CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/animate/animate.min.css" rel="stylesheet">
    <link href="vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .services-section {
            padding: 60px 0;
        }

        .card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #d00000;
            font-size: 20px;
            font-weight: 700;
        }

        .card-subtitle {
            font-weight: 500;
        }

        .service-icon {
            font-size: 40px;
            color: #d00000;
            margin-bottom: 15px;
        }

        h2.section-title {
            color: #333;
            font-weight: 800;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
<?php include "header.php"; ?>

<section class="services-section">
  <div class="container">
    <h2 class="text-center section-title">Our Medical Services</h2>
    <div class="row">
      <?php
      $result = mysqli_query($con, "SELECT * FROM serviceregister");
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card p-4 h-100 shadow-sm">
            <div class="text-center">
              <i class="fa fa-stethoscope service-icon"></i>
              <h5 class="card-title"><?php echo htmlspecialchars($row['service']); ?></h5>
              <h6 class="card-subtitle mb-2 text-muted">Price: $<?php echo htmlspecialchars($row['price']); ?></h6>
              <p class="card-text mt-3"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                <a href="book.php?service=<?php echo urlencode($row['service']); ?>" class="btn btn-danger mt-3">
        Book Now</a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<?php include "footer.php"; ?>

<!-- JS Libraries -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
