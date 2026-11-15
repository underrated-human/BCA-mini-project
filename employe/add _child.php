<?php
include("../db.php");

// Insert logic
if (isset($_POST['submit'])) {
    $child_name = mysqli_real_escape_string($con, $_POST['child_name']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $health = mysqli_real_escape_string($con, $_POST['health']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $join_date = mysqli_real_escape_string($con, $_POST['join_date']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Upload folder (relative to this file)
    $uploadDir = __DIR__ . "/uploads/children/";

    // Create folder if not exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // File upload
    $photo = $_FILES['photo']['name'];
    $target = $uploadDir . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
        // Store only filename in DB
        $query = "INSERT INTO children (child_name, age, health, dob, join_date, photo, status) 
                  VALUES ('$child_name','$age','$health','$dob','$join_date','$photo','$status')";
        if (mysqli_query($con, $query)) {
            echo "<script>alert('Child added successfully');</script>";
        } else {
            echo "<script>alert('Database error: " . mysqli_error($con) . "');</script>";
        }
    } else {
        echo "<script>alert('Photo upload failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Child - Employee Panel</title>

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
      <h1>Add Child</h1>
    </div><!-- End Page Title -->

    <div class="container mt-4">
      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body p-4">
          <h3 class="text-center text-primary mb-4">Add Child Details</h3>

          <form method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label class="form-label fw-semibold">Child Name</label>
              <input type="text" name="child_name" class="form-control" placeholder="Enter child's full name" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Age</label>
              <input type="number" name="age" class="form-control" placeholder="Enter age" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Health Condition</label>
              <input type="text" name="health" class="form-control" placeholder="e.g., Healthy, Needs Care">
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Join Date</label>
                <input type="date" name="join_date" class="form-control" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Upload Photo</label>
              <input type="file" name="photo" class="form-control" accept="image/*" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Status</label>
              <select name="status" class="form-select" required>
                <option value="" disabled selected>-- Select Status --</option>
                <option value="Active">Active</option>
                <option value="Adopted">Adopted</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100 py-2">
              <i class="bi bi-plus-circle me-1"></i> Add Child
            </button>

          </form>
        </div>
      </div>
    </div>
  </main>

</body>
</html>
