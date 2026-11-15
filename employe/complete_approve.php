<?php
include("../db.php");

// ✅ Check if employee logged in
if (!isset($_SESSION['employe'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in as Employee.</div>";
    exit;
}

// ✅ Fetch only Approved adoption requests
$query = "
    SELECT ar.id, ar.message, ar.status, ar.created_at, 
           u.name AS user_name, u.email, u.mobile,
           c.child_name, c.photo, c.age
    FROM adoption_requests ar
    JOIN registration u ON ar.user_id = u.id
    JOIN children c ON ar.child_id = c.id
    WHERE ar.status = 'Approved'
    ORDER BY ar.created_at DESC
";

$result = mysqli_query($con, $query);

// ❌ Query fail aayal error show cheyyan
if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee - Approved Adoptions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f9fdfc; font-family: 'Poppins', sans-serif; }
        .table-container { max-width: 1100px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .child-photo { width: 80px; height: 80px; border-radius: 8px; object-fit: cover; }
    </style>
</head>
<body>

<div class="table-container">
    <h2 class="text-center text-success mb-4">Approved Adoption Requests</h2>

    <!-- ✅ Back to Home button -->
    <div class="mb-3 text-end">
        <a href="home.php" class="btn btn-outline-success btn-sm">⬅ Back to Home</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Parent Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Child</th>
                <th>Photo</th>
                <th>Age</th>
                <th>Message</th>
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
                    <td><?= htmlspecialchars($row['child_name']); ?></td>
                    <td><img src="../uploads/photos/<?= htmlspecialchars($row['photo']); ?>" class="child-photo"></td>
                    <td><?= htmlspecialchars($row['age']); ?></td>
                    <td><?= htmlspecialchars($row['message']); ?></td>
                    <td><?= $row['created_at']; ?></td>
                </tr>
            <?php } } else { ?>
                <tr>
                    <td colspan="9" class="text-center text-muted">No approved adoption requests yet</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
