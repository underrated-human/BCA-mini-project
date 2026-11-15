<?php
include("../db.php");

// ✅ Check if employee is logged in
if (!isset($_SESSION['employe'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in as Employee.</div>";
    exit;
}

// ✅ Fetch only approved sponsorships
$query = "
    SELECT s.*, u.name AS user_name, u.email, u.mobile
    FROM sponsorships s
    JOIN registration u ON s.user_id = u.id
    WHERE s.status='approved'
    ORDER BY s.created_at DESC
";

$result = mysqli_query($con, $query);
if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee - Approved Sponsorships</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background: #f9fdfc; font-family: 'Poppins', sans-serif; }
    .table-container { max-width: 1200px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
</style>
</head>
<body>

<div class="table-container">
    <h2 class="text-center text-success mb-4">Approved Sponsorships</h2>

    <div class="mb-3 text-end">
        <a href="home.php" class="btn btn-outline-secondary btn-sm">⬅ Back to Home</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Type</th>
                <th>Amount / Item</th>
                <th>Description</th>
                <th>Approved On</th>
            </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($result) > 0){
            $i=1;
            while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['user_name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['mobile']); ?></td>
                <td><?= ucfirst($row['type']); ?></td>
                <td><?= $row['type']=='amount' ? '₹'.$row['amount'] : htmlspecialchars($row['type']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td><?= $row['created_at']; ?></td>
            </tr>
        <?php } } else { ?>
            <tr>
                <td colspan="8" class="text-center text-muted">No approved sponsorships found</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
