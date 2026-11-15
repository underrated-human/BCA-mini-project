<?php
include("../db.php");

// Redirect if not logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

// Fetch completed bookings
$sql = "SELECT 
            b.id AS booking_id, 
            b.service_id, 
            b.created_at, 
            b.status,
            p.name AS patient_name, 
            s.service AS service_name,
            n.name AS nurse_name
        FROM bookings b
        LEFT JOIN registration p ON b.user = p.id
        LEFT JOIN serviceregister s ON b.service_id = s.id
        LEFT JOIN nurseregister n ON b.nurse = n.id
        WHERE b.status = 'Completed'
        ORDER BY b.created_at DESC";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error fetching completed bookings: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Completed Bookings - Admin Panel</title>

  <!-- Favicon & Fonts -->
  <link rel="icon" href="assets/img/favicon.png" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

  <!-- Bootstrap & Icons -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link href="assets/css/style.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f9;
    }
    .card {
      border-radius: 10px;
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .badge {
      font-size: 0.9rem;
      padding: 5px 10px;
      border-radius: 6px;
    }
    .table thead th {
      background-color: #c41616ff !important;
      color: white;
    }
    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
    }
    .heading-icon {
      font-size: 22px;
      margin-right: 8px;
    }
  </style>
</head>

<body>

<div class="container-fluid px-4">
  <div class="row mt-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header bg-success text-white d-flex align-items-center justify-content-between">
          <h4 class="mb-0"><i class="bi bi-check-circle-fill heading-icon"></i>Completed Bookings by Nurses</h4>
          <a href="home.php" class="btn btn-light btn-sm"><i class="bi bi-house-door-fill me-1"></i>Dashboard</a>
        </div>

        <div class="card-body">
          <?php if (mysqli_num_rows($result) == 0): ?>
            <div class="alert alert-warning text-center">No completed bookings found.</div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="text-center">
                  <tr>
                    <th>Booking ID</th>
                    <th>Service ID</th>
                    <th>Service Name</th>
                    <th>Patient Name</th>
                    <th>Nurse Name</th>
                    <th>Created Time</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="text-center">
                      <td><?= htmlspecialchars($row['booking_id']) ?></td>
                      <td><?= htmlspecialchars($row['service_id']) ?></td>
                      <td><?= htmlspecialchars($row['service_name']) ?></td>
                      <td><?= htmlspecialchars($row['patient_name']) ?></td>
                      <td><?= htmlspecialchars($row['nurse_name']) ?></td>
                      <td><?= date("d M Y, h:i A", strtotime($row['created_at'])) ?></td>
                      <td>
                        <span class="badge bg-success">
                          <i class="bi bi-check-circle-fill me-1"></i><?= htmlspecialchars($row['status']) ?>
                        </span>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Scripts -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
