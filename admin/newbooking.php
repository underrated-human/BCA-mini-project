<?php
include("../db.php");

$sql = "SELECT b.service_id AS service_id, b.created_at, b.card_last4, b.expiry_date, 
               s.service AS service, s.price, 
               r.Name, r.Email,
               b.service_id AS service_id
        FROM bookings b
        JOIN serviceregister s ON b.service_id = s.id
        JOIN registration r ON b.user = r.id
        ORDER BY b.created_at DESC";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}
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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<?php include("sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Bookings</h1>
  </div>

  <div class="container mt-4">
    <div class="card shadow border-danger">
      <div class="card-header bg-danger text-white">
        <h4 class="mb-0">All Bookings</h4>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover align-middle table-bordered table-danger">
          <thead class="table-dark text-center">
            <tr>
              <th>Booking ID</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Service</th>
              <th>Price</th>
              <th>Booking Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td class="text-center"><?php echo htmlspecialchars($row['service_id']); ?></td>
                  <td><?php echo htmlspecialchars($row['Name']); ?></td>
                  <td><?php echo htmlspecialchars($row['Email']); ?></td>
                  <td><?php echo htmlspecialchars($row['service']); ?></td>
                  <td>$<?php echo htmlspecialchars($row['price']); ?></td>
                  <td class="text-center"><?php echo htmlspecialchars($row['created_at']); ?></td>
                  <td class="text-center">
                    <a href="assign_nurse.php?service_id=<?php echo $row['service_id']; ?>" class="btn btn-success btn-sm mb-1">Assign Nurse</a>
                  
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center text-muted">No bookings found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</main>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
