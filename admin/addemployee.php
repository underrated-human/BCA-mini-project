<?php
include("../db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Add employees - Admin Panel</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    .form-section,
    .table-section {
      padding: 20px;
    }

    .card {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-title {
      font-weight: 600;
      font-size: 20px;
      color: red;
    }

    label.col-form-label {
      color: red;
    }

    .btn-primary {
      background-color: red;
      border-color: red;
    }

    .btn-primary:hover {
      background-color: darkred;
      border-color: darkred;
    }

    .table-dark th {
      background-color: red !important;
    }

    .btn-danger {
      background-color: red;
      border-color: red;
    }

    .btn-danger:hover {
      background-color: darkred;
      border-color: darkred;
    }
  </style>
</head>

<body>

  <?php include("sidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1 style="color:red;">Add New employees</h1>
    </div>

    <!-- ======= Employee Registration Form ======= -->
    <section class="form-section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">employee Registration Form</h5>
          <form method="post">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <input type="text" name="address" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" name="username" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <input type="tel" name="phone" class="form-control" required pattern="[0-9]{10}">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Qualification</label>
              <div class="col-sm-10">
                <input type="text" name="qualification" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Experience</label>
              <div class="col-sm-10">
                <input type="text" name="experience" class="form-control" required>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" name="s1" class="btn btn-primary">Register</button>
            </div>
          </form>

          <?php
          if (isset($_POST['s1'])) {
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $address = mysqli_real_escape_string($con, $_POST['address']);
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = $_POST['password'];
            $mobile = mysqli_real_escape_string($con, $_POST['phone']);
            $qualification = mysqli_real_escape_string($con, $_POST['qualification']);
            $experience = mysqli_real_escape_string($con, $_POST['experience']);

            $check = mysqli_query($con, "SELECT * FROM employeregister WHERE email='$email' OR username='$username'");
            if (mysqli_num_rows($check) > 0) {
              echo "<div class='alert alert-danger mt-3'>Email or Username already exists!</div>";
            } else {
              $insert = mysqli_query($con, "INSERT INTO employeregister (name, email, address, username, password, mobile, qualification, experience,status) 
              VALUES ('$name', '$email', '$address', '$username', '$password', '$mobile', '$qualification', '$experience','Approve')");
              if ($insert) {
                echo "<div class='alert alert-success mt-3'>Employee registered successfully!</div>";
              } else {
                echo "<div class='alert alert-danger mt-3'>Error occurred while registering employee.</div>";
              }
            }
          }
          ?>
        </div>
      </div>
    </section>

    <!-- ======= Employee Table ======= -->
    <section class="table-section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Registered Nurse</h5>

          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Username</th>
                  <th>Password </th>
                  <th>Phone</th>
                  <th>Qualification</th>
                  <th>Experience</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $result = mysqli_query($con, "SELECT * FROM employeregister ORDER BY id DESC");
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['password']) ?></td>
                    <td><?= htmlspecialchars($row['mobile']) ?></td>
                    <td><?= htmlspecialchars($row['qualification']) ?></td>
                    <td><?= htmlspecialchars($row['experience']) ?></td>
                    <td>
                      <a href="nursedelete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this record?');">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End Main -->

  <?php include("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>
