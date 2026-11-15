<?php
include ("../db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header / Sidebar ======= -->
  <?php include("sidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Userlist</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <!-- Compact Table -->
              <div class="container mt-4">
                <div class="table-responsive">
                  <table class="table table-sm table-bordered table-striped table-hover w-auto"
                    style="font-size:14px; max-width:98%; margin:auto;">
                    <thead class="table-dark">
                      <tr>
                        <th>Sl.No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Pin</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Password</th>
                       <th>Photo</th>
                        <th>Document</th>
                    
                        <th>Status</th>
                        <th colspan="2">Actions</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i = 1;
                      $sql = mysqli_query($con, "SELECT * FROM registration ORDER BY id DESC");
                      while($row = mysqli_fetch_array($sql)) { ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                        <td><?php echo $row['Pin']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Mobile']; ?></td>
                        <td><?php echo $row['Password']; ?></td>

                        <!-- Show Photo -->
                        <td>
                          <?php if(!empty($row['Photo'])) { ?>
                            <a href="../<?php echo $row['Photo']; ?>" target="_blank">
                              <img src="../<?php echo $row['Photo']; ?>" width="50" height="50" style="object-fit:cover;" />
                            </a>
                          <?php } else { echo "No Photo"; } ?>
                        </td>

                        <!-- Show Document -->
                        <td>
                          <?php if(!empty($row['Document'])) { ?>
                            <a href="../<?php echo $row['Document']; ?>" target="_blank" class="btn btn-sm btn-info">View</a>
                          <?php } else { echo "No Doc"; } ?>
                        </td>

                        <td><?php echo $row['status']; ?></td>
                        <td><a href="approve.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-sm btn-primary">Approve</a></td>
                        <td><a href="reject.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-sm btn-warning">Reject</a></td>
                        <td><a href="delete.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure to delete this record?');">Delete</a></td>
                      </tr>
                      <?php $i++; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- End Compact Table -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?php include("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>
