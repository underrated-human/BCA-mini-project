<?php
include ("../db.php");

// Ensure the user is logged in
if (!isset($_SESSION['user']['id'])) {
    // Redirect if user not logged in
    header("Location: login.php");
    exit();
}

$userId = intval($_SESSION['user']['id']); // numeric ID from registration table
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>orphanage</title>
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
  
<?php include "header.php"; ?>

<div class="container my-5">
  <style>
    h3 {
      color: #1da3c5;
    }
    label {
      color: #1da3c5;
      font-weight: 600;
    }
    .btn-primary {
      background-color: #1da3c5;
      border-color: #1da3c5;
    }
    .btn-primary:hover {
      background-color: #148aa5;
      border-color: #12758b;
    }
    .form-control:focus {
      border-color: #1da3c5;
      box-shadow: 0 0 0 0.2rem rgba(29, 163, 197, 0.25);
    }
    .bg-light {
      border: 1px solid #1da3c5;
    }
    /* Custom table header color */
    .table thead th {
      background-color: #1da3c5 !important;
      color: #fff !important;
      border-color: #1da3c5 !important;
    }
  </style>

  <div class="row justify-content-center">
    <!-- Feedback Form -->
    <div class="col-md-6">
      <h3 class="text-center mb-4">Submit Your Feedback</h3>
      <form method="post" class="p-4 border rounded shadow-sm bg-light">
        <div class="form-group mb-3">
          <label for="username">Your Name</label>
          <input type="text" class="form-control form-control-lg" name="Name" placeholder="Enter your name" required>
        </div>
        <div class="form-group mb-3">
          <label for="message">Your Feedback</label>
          <textarea class="form-control form-control-lg" name="message" rows="5" placeholder="Enter your feedback here..." required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg">Send Feedback</button>
      </form>

      <?php
      if (isset($_POST['submit'])) {
        $Name = mysqli_real_escape_string($con, $_POST['Name']);
        $message = mysqli_real_escape_string($con, $_POST['message']);

        // Insert feedback with userId (foreign key)
        $sql = mysqli_query($con, "INSERT INTO feedback(Name, message, reply, Userid) VALUES('$Name', '$message', 'nil', '$userId')");
        if ($sql) {
            echo "<script>alert('Successfully saved your feedback!');</script>";
        } else {
            echo "<script>alert('Error saving feedback: " . mysqli_error($con) . "');</script>";
        }
      }
      ?>
    </div>

    <!-- Feedback Table -->
    <div class="col-md-6">
      <h3 class="text-center mb-4">Feedback History</h3>
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Sl.No</th>
            <th>Name</th>
            <th>Message</th>
            <th>Reply</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $i = 1;
          $sql = mysqli_query($con, "SELECT * FROM feedback WHERE Userid='$userId' ORDER BY id DESC");
          while ($row = mysqli_fetch_assoc($sql)) { ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo htmlspecialchars($row['Name']); ?></td>
              <td><?php echo htmlspecialchars($row['message']); ?></td>
              <td><?php echo htmlspecialchars($row['reply']); ?></td>
            </tr>
          <?php $i++; } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>
