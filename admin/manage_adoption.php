<?php
include("../db.php");

// ✅ Check if admin logged in
if (!isset($_SESSION['admin'])) {
    echo "<div class='alert alert-danger text-center mt-5'>Please log in as Admin.</div>";
    exit;
}

// ✅ Approve / Reject action
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'approve') {
        $status = "Approved";
    } elseif ($action == 'reject') {
        $status = "Rejected";
    }

    mysqli_query($con, "UPDATE adoption_requests SET status='$status' WHERE id=$id");
    header("Location: manage_adoption.php"); 
    exit;
}

// ✅ Fetch all adoption requests
$query = "
    SELECT ar.id, ar.message, ar.status, ar.created_at, 
           u.name AS user_name, u.email, 
           c.child_name, c.photo
    FROM adoption_requests ar
    JOIN registration u ON ar.user_id = u.id
    JOIN children c ON ar.child_id = c.id
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
    <title>Admin - Adoption Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f9fc; font-family: 'Poppins', sans-serif; }
        .table-container { max-width: 1100px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .child-photo { width: 80px; height: 80px; border-radius: 8px; object-fit: cover; }
        .btn-sm { padding: 5px 10px; }
    </style>
    <script>
        function confirmAction(action, id) {
            let msg = (action === 'approve') ? "Are you sure you want to approve this request?" : "Are you sure you want to reject this request?";
            if (confirm(msg)) {
                window.location.href = "?action=" + action + "&id=" + id;
            }
        }
    </script>
</head>
<body>

<div class="table-container">
    <h2 class="text-center text-primary mb-4">Manage Adoption Requests</h2>

    <!-- ✅ Back to Home button -->
    <div class="mb-3 text-end">
        <a href="home.php" class="btn btn-outline-primary btn-sm">⬅ Back to Home</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Email</th>
                <th>Child</th>
                <th>Photo</th>
                <th>Message</th>
                <th>Status</th>
                <th>Requested On</th>
                <th>Action</th>
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
                    <td><?= htmlspecialchars($row['child_name']); ?></td>
                    <td><img src="../uploads/photos/<?= htmlspecialchars($row['photo']); ?>" class="child-photo"></td>
                    <td><?= htmlspecialchars($row['message']); ?></td>
                    <td>
                        <?php if($row['status']=="Pending"){ ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php } elseif($row['status']=="Approved"){ ?>
                            <span class="badge bg-success">Approved</span>
                        <?php } else { ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php } ?>
                    </td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <?php if($row['status']=="Pending"){ ?>
                            <button onclick="confirmAction('approve', <?= $row['id']; ?>)" class="btn btn-success btn-sm">Approve</button>
                            <button onclick="confirmAction('reject', <?= $row['id']; ?>)" class="btn btn-danger btn-sm">Reject</button>
                        <?php } else { ?>
                            <button class="btn btn-secondary btn-sm" disabled>No Action</button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } } else { ?>
                <tr>
                    <td colspan="9" class="text-center text-muted">No adoption requests found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
