<?php
include("../db.php");

// ✅ Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in to view your sponsorship history.</div>";
    exit;
}

$user_id = $_SESSION['user']['id'];

// ✅ Fetch sponsorships of the logged-in user
$query = "
    SELECT *
    FROM sponsorships
    WHERE user_id = $user_id
    ORDER BY created_at DESC
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
<title>My Sponsorship History</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { 
        background: #f0f9ff; 
        font-family: 'Poppins', sans-serif; 
    }
    .table-container { 
        max-width: 1100px; 
        margin: 50px auto; 
        padding: 30px; 
        background: #fff; 
        border-radius: 15px; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
        transition: transform 0.3s ease;
    }
    .table-container:hover {
        transform: translateY(-5px);
    }
    h2 {
        color: #1da3c5;
        font-weight: 700;
        margin-bottom: 30px;
    }
    .table thead th {
        background-color: #1da3c5;
        color: #fff;
        border: none;
    }
    .table-hover tbody tr:hover {
        background-color: #e0f7fa;
    }
    .badge {
        font-size: 0.9rem;
        padding: 5px 10px;
        border-radius: 12px;
    }
    .btn-outline-secondary {
        border-radius: 50px;
        padding: 5px 15px;
    }
</style>
</head>
<body>

<div class="table-container">
    <h2 class="text-center">My Sponsorship History</h2>

    <div class="mb-3 text-end">
        <a href="home.php" class="btn btn-outline-secondary btn-sm">⬅ Back to Home</a>
    </div>

    <table class="table table-bordered table-hover align-middle text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Amount / Item</th>
                <th>Description</th>
                <th>Status</th>
                <th>Requested On</th>
            </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($result) > 0){
            $i=1;
            while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= ucfirst($row['type']); ?></td>
                <td><?= $row['type']=='amount' ? '₹'.$row['amount'] : htmlspecialchars($row['type']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td>
                    <?php 
                    if($row['status']=='pending'){ 
                        echo '<span class="badge" style="background-color:#ffc107;color:#fff;">Pending</span>';
                    } elseif($row['status']=='approved'){ 
                        echo '<span class="badge" style="background-color:#1da3c5;color:#fff;">Approved</span>';
                    } else { 
                        echo '<span class="badge" style="background-color:#dc3545;color:#fff;">Rejected</span>';
                    } 
                    ?>
                </td>
                <td><?= date('d M, Y h:i A', strtotime($row['created_at'])); ?></td>
            </tr>
        <?php } } else { ?>
            <tr>
                <td colspan="6" class="text-center text-muted">No sponsorship requests found</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
