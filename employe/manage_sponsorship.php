<?php
include("../db.php");

if (!isset($_SESSION['employe'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in as Employee.</div>";
    exit;
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'approve') {
        $status = "approved";
    } elseif ($action == 'reject') {
        $status = "rejected";
    }

    mysqli_query($con, "UPDATE sponsorships SET status='$status' WHERE id=$id");
    header("Location: manage_sponsorship.php"); 
    exit;
}

$query = "
    SELECT s.id, s.type, s.amount, s.description, s.status, s.created_at,
           u.name AS user_name, u.email
    FROM sponsorships s
    JOIN registration u ON s.user_id = u.id
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
<title>Manage Sponsorships</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background: #f0f9ff; font-family: 'Poppins', sans-serif; }
    .table-container { max-width: 1200px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .btn-sm { padding: 5px 10px; }
</style>
<script>
function confirmAction(action, id){
    let msg = action === 'approve' ? 
        "Are you sure you want to approve this sponsorship?" : 
        "Are you sure you want to reject this sponsorship?";
    if(confirm(msg)){
        window.location.href="?action="+action+"&id="+id;
    }
}
</script>
</head>
<body>

<div class="table-container">
    <h2 class="text-center text-primary mb-4">Manage Sponsorships</h2>

    <div class="mb-3 text-end">
        <a href="home.php" class="btn btn-outline-secondary btn-sm">⬅ Back to Home</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Amount / Item</th>
                <th>Description</th>
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
                <td><?= ucfirst($row['type']); ?></td>
                <td><?= $row['type']=='amount' ? '₹'.$row['amount'] : htmlspecialchars($row['type']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td>
                    <?php if($row['status']=='pending'){ ?>
                        <span class="badge bg-warning">Pending</span>
                    <?php } elseif($row['status']=='approved'){ ?>
                        <span class="badge bg-success">Approved</span>
                    <?php } else { ?>
                        <span class="badge bg-danger">Rejected</span>
                    <?php } ?>
                </td>
                <td><?= $row['created_at']; ?></td>
                <td>
                    <?php if($row['status']=='pending'){ ?>
                        <button onclick="confirmAction('approve', <?= $row['id']; ?>)" class="btn btn-success btn-sm">Approve</button>
                        <button onclick="confirmAction('reject', <?= $row['id']; ?>)" class="btn btn-danger btn-sm">Reject</button>
                    <?php } else { ?>
                        <button class="btn btn-secondary btn-sm" disabled>No Action</button>
                    <?php } ?>
                </td>
            </tr>
        <?php } } else { ?>
            <tr>
                <td colspan="9" class="text-center text-muted">No sponsorship requests found</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
