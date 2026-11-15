<?php
include("../db.php");
session_start();

// Check if employee logged in
if (!isset($_SESSION['employe'])) {
    header("Location: home.php");
    exit();
}

// Store session employee data
$employe = $_SESSION['employe'];
$id = $employe['id'];

// Fetch employee details from DB
$query = mysqli_query($con, "SELECT * FROM employeregister WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

// Update logic
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $qualification = mysqli_real_escape_string($con, $_POST['qualification']);
    $experience = mysqli_real_escape_string($con, $_POST['experience']);

    $update = mysqli_query($con, "UPDATE employeregister 
        SET name='$name', email='$email', address='$address', username='$username', password='$password',
            mobile='$mobile', qualification='$qualification', experience='$experience'
        WHERE id='$id'");

    if ($update) {
        echo "<div class='alert alert-success text-center'>Profile updated successfully!</div>";
        $_SESSION['employe'] = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM employeregister WHERE id='$id'"));
        $data = $_SESSION['employe']; // refresh data variable also
    } else {
        echo "<div class='alert alert-danger text-center'>Error updating profile.</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Employee - Edit Profile</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Nunito:600,700,800,900|Poppins:400,500,600"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Custom Theme -->
  <style>
    body {
      background-color: #f4fbfd;
    }

    .pagetitle h1 {
      color: #1da3c5;
      font-weight: bold;
    }

    .hello-name {
      font-size: 18px;
      font-weight: 500;
      color: #555;
    }

    label {
      color: #1da3c5;
      font-weight: 500;
    }

    .form-control:focus {
      border-color: #1da3c5;
      box-shadow: 0 0 0 0.2rem rgba(29, 163, 197, 0.25);
    }

    .btn-primary {
      background-color: #1da3c5;
      border-color: #1da3c5;
    }

    .btn-primary:hover {
      background-color: #178aa5;
      border-color: #178aa5;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>

  <!-- ======= Header and Sidebar ======= -->
  <?php include("sidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
      <h1>Employee Edit Profile</h1>
      <span class="hello-name">Hello, <?= htmlspecialchars($data['name']) ?> 👋</span>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="card">
        <div class="card-body p-4">
          <h4 class="card-title mb-4 text-center">Edit Profile</h4>
          <form method="post">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['name']) ?>" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
              </div>
              <div class="col-md-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($data['address']) ?>" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username']) ?>" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($data['password']) ?>" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="tel" name="mobile" class="form-control" value="<?= htmlspecialchars($data['mobile']) ?>" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="<?= htmlspecialchars($data['qualification']) ?>" required>
              </div>
              <div class="col-md-12">
                <label class="form-label">Experience</label>
                <input type="text" name="experience" class="form-control" value="<?= htmlspecialchars($data['experience']) ?>" required>
              </div>
            </div>

            <div class="text-center mt-4">
              <button type="submit" name="update" class="btn btn-primary px-4">Update Profile</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
