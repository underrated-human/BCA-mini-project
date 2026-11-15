<?php
include("../db.php");

// ✅ Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in to view your adoption requests.</div>";
    exit;
}

$user = $_SESSION['user'];
$user_id = intval($user['id']);

// ✅ Fetch adoption requests only for this logged-in user
$query = "SELECT ar.id AS request_id, ar.message, ar.status, ar.created_at,
                 c.child_name, c.photo AS child_photo, c.age, c.health, c.dob
          FROM adoption_requests ar
          JOIN children c ON ar.child_id = c.id
          WHERE ar.user_id = $user_id
          ORDER BY ar.id DESC";

$result = mysqli_query($con, $query);

if (!$result) {
    die("<div class='alert alert-danger text-center mt-5'>Database query failed: " . mysqli_error($con) . "</div>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Adoption Requests</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #1da3c5, #76c7f0);
        font-family: 'Poppins', sans-serif;
        padding: 40px 0;
    }

    h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 40px;
        font-weight: 700;
        font-size: 2.2rem;
        letter-spacing: 1px;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.4);
    }

    .request-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.25);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .request-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.35);
    }

    .child-photo {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #1da3c5;
        margin: 0 auto 15px;
        display: block;
        box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    }

    h4 {
        font-weight: 600;
        color: #fff;
        text-align: center;
        margin-bottom: 10px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }

    p {
        margin-bottom: 10px;
        font-size: 0.95rem;
        color: #f1f1f1;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 18px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        box-shadow: 0 3px 10px rgba(0,0,0,0.25);
        margin-top: 10px;
        animation: pulse 2s infinite;
    }

    .status-Pending {
        background: #ff9800;
        color: #fff;
    }

    .status-Approved {
        background: #1da3c5;
        color: #fff;
    }

    .status-Rejected {
        background: #f44336;
        color: #fff;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .btn-primary {
        background-color: #1da3c5;
        border: none;
        border-radius: 30px;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #17a2b8;
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }

    .submitted-date {
        font-size: 0.85rem;
        color: #ddd;
        margin-top: 12px;
    }
</style>
</head>
<body>

<div class="container">
    <h2><i class="fa-solid fa-clipboard-list"></i> My Adoption Requests</h2>

    <div class="text-center mb-4">
        <a href="view_child.php" class="btn btn-primary">
            <i class="fa-solid fa-arrow-left"></i> Back to Children
        </a>
    </div>

    <?php if(mysqli_num_rows($result) > 0){ ?>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="request-card text-center">
                <img src="../uploads/photos/<?= htmlspecialchars($row['child_photo']); ?>" 
                     alt="<?= htmlspecialchars($row['child_name']); ?>" class="child-photo">

                <h4><?= htmlspecialchars($row['child_name']); ?> (Age: <?= htmlspecialchars($row['age']); ?>)</h4>
                <p><strong>Health:</strong> <?= htmlspecialchars($row['health']); ?> <br>
                   <strong>DOB:</strong> <?= htmlspecialchars($row['dob']); ?></p>

                <p><strong>Your Message:</strong><br><?= nl2br(htmlspecialchars($row['message'])); ?></p>

                <!-- ✅ Status with icons -->
                <?php if ($row['status'] == "Pending") { ?>
                    <span class="badge status-badge status-Pending">
                        <i class="fa-solid fa-hourglass-half"></i> <?= $row['status']; ?>
                    </span>
                <?php } elseif ($row['status'] == "Approved") { ?>
                    <span class="badge status-badge status-Approved">
                        <i class="fa-solid fa-circle-check"></i> <?= $row['status']; ?>
                    </span>
                <?php } else { ?>
                    <span class="badge status-badge status-Rejected">
                        <i class="fa-solid fa-circle-xmark"></i> <?= $row['status']; ?>
                    </span>
                <?php } ?>

                <p class="submitted-date">
                    <i class="fa-regular fa-clock"></i> Submitted on: 
                    <?= !empty($row['created_at']) ? date('d M Y, H:i', strtotime($row['created_at'])) : 'N/A'; ?>
                </p>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-info text-center">You have not submitted any adoption requests yet.</div>
    <?php } ?>
</div>

</body>
</html>
