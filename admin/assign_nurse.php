<?php
include("../db.php");
// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: assign_nurse.php");
    exit();
}

// Ensure service_id is passed
if (!isset($_GET['service_id'])) {
    echo "Invalid request. Service ID is missing.";
    exit();
}

$service_id = intval($_GET['service_id']);

// Fetch approved nurses only
$nurses_result = mysqli_query($con, "SELECT id, name, email FROM nurseregister WHERE status = 'Approved'");

if (!$nurses_result) {
    die("Error fetching nurses: " . mysqli_error($con));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nurse_id = intval($_POST['nurse_id']);

    // Update the bookings table to assign the nurse
   $update_sql = "UPDATE bookings SET nurse = '$nurse_id' WHERE service_id = '$service_id'";

    if (mysqli_query($con, $update_sql)) {
      echo "<script>alert('Nurse assigned successfully!'); window.location.href='admin_dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to assign nurse.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Nurse</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Assign Nurse</h1>
    </div>

    <div class="container mt-4">
        <div class="card border-success shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Select a Nurse for Service ID: <?php echo htmlspecialchars($service_id); ?></h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group mb-3">
                        <label for="nurse_id" class="form-label">Available Nurses</label>
                        <select name="nurse_id" id="nurse_id" class="form-select" required>
                            <option value="" disabled selected>-- Select Nurse --</option>
                            <?php while ($nurse = mysqli_fetch_assoc($nurses_result)): ?>
                                <option value="<?php echo $nurse['id']; ?>">
                                    <?php echo htmlspecialchars($nurse['name']) . " (" . htmlspecialchars($nurse['email']) . ")"; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Assign Nurse</button>
                    <a href="" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
