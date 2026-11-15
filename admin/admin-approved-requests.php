<?php

include("../db.php");


if (!isset($_SESSION['admin'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in as an admin to view approved adoption requests.</div>";
    exit;
}


$query = "SELECT ar.id AS request_id, ar.message, ar.status,
                 c.child_name, c.photo AS child_photo, c.age, c.health,
                 r.Name AS user_name, r.Email AS email, r.Mobile AS phone,
                 ar.created_at
          FROM adoption_requests ar
          JOIN children c ON ar.child_id = c.id
          JOIN registration r ON ar.user_id = r.id
          WHERE ar.status = 'Approved'
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
<title>Approved Adoption Requests - Admin Panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
    body { background: linear-gradient(135deg, #fce4ec, #ffffff); font-family: 'Poppins', sans-serif; padding: 40px 0; }
    h2 { color: #ad1457; text-align: center; margin-bottom: 30px; font-weight: 600; }
    .request-card { background: #fff; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px; }
    .child-photo { width: 80px; height: 80px; object-fit: cover; border-radius: 10px; border: 2px solid #ad1457; }
    .status-badge { padding: 5px 12px; border-radius: 20px; font-weight: 500; font-size: 0.85rem; text-transform: uppercase; }
    .status-Approved { background-color: #43a047; color: #fff; }
    .request-header { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
    .request-header h5 { margin: 0; font-weight: 600; color: #ad1457; }
    .request-body p { margin: 0; }
    .back-btn { display: block; margin: 0 auto 30px auto; }
    @media (max-width: 576px) { .request-header { flex-direction: column; align-items: flex-start; } }
</style>
</head>
<body>

<div class="container">
    <h2><i class="fa-solid fa-circle-check"></i> Approved Adoption Requests</h2>


    <div class="text-center">
        <a href="home.php" class="btn btn-primary back-btn">
            <i class="fa-solid fa-arrow-left"></i> Back to Home
        </a>
    </div>

    <?php if(mysqli_num_rows($result) > 0){ ?>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="request-card">
                <div class="request-header">
                    <img src="../uploads/photos/<?= htmlspecialchars($row['child_photo']); ?>" class="child-photo" alt="<?= htmlspecialchars($row['child_name']); ?>">
                    <div>
                        <h5><?= htmlspecialchars($row['child_name']); ?>, Age <?= htmlspecialchars($row['age']); ?></h5>
                        <span class="badge status-badge status-<?= htmlspecialchars($row['status']); ?>"><?= htmlspecialchars($row['status']); ?></span>
                    </div>
                    <small class="ms-auto text-muted">
                        Approved On: <?= !empty($row['created_at']) ? date('d M Y, H:i', strtotime($row['created_at'])) : 'N/A'; ?>
                    </small>
                </div>
                <hr>
                <div class="request-body">
                    <p><strong>Adoptive Parent:</strong> <?= htmlspecialchars($row['user_name']); ?> | <small><?= htmlspecialchars($row['email']); ?></small> | <small><?= htmlspecialchars($row['phone']); ?></small></p>
                    <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($row['message'])); ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-info text-center">No approved adoption requests found.</div>
    <?php } ?>
</div>

</body>
</html>
