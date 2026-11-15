<?php

include("../db.php");

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in to submit an adoption request.</div>";
    exit;
}

$user = $_SESSION['user'];
$user_id = $user['id'];

// Get child_id from GET parameter
if (!isset($_GET['child_id'])) {
    echo "<div class='alert alert-danger text-center mt-5'>No child selected for adoption request.</div>";
    exit;
}

$child_id = intval($_GET['child_id']);

// Fetch child info
$childResult = mysqli_query($con, "SELECT * FROM children WHERE id = $child_id AND status='Active'");
if (mysqli_num_rows($childResult) == 0) {
    echo "<div class='alert alert-danger text-center mt-5'>Child not found or not available for adoption.</div>";
    exit;
}

$child = mysqli_fetch_assoc($childResult);

// Handle form submission
if (isset($_POST['submit'])) {
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $status = "Pending";

    $insertQuery = "INSERT INTO adoption_requests (child_id, user_id, message, status) 
                    VALUES ($child_id, $user_id, '$message', '$status')";
    
    if (mysqli_query($con, $insertQuery)) {
        $success = "Adoption request submitted successfully!";
    } else {
        $error = "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Adoption Request - <?= htmlspecialchars($child['child_name']); ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #f0f9ff, #a1c4fd);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }
    .request-card {
        max-width: 600px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        padding: 30px;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .request-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 45px rgba(0,0,0,0.3);
    }
    .child-photo {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 20px;
        border: 2px solid #1da3c5;
    }
    .btn-primary {
        background: #1da3c5;
        border: none;
    }
    .btn-primary:hover {
        background: #0d8aa9;
    }
    h2 {
        color: #1da3c5;
        text-align: center;
        margin-bottom: 25px;
    }
</style>
</head>
<body>

<div class="request-card">
    <h2><i class="fa-solid fa-hand-holding-heart"></i> Adoption Request</h2>

    <?php if (isset($success)) { ?>
        <div class="alert alert-success"><?= $success; ?></div>
    <?php } elseif (isset($error)) { ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php } ?>

    <img src="../uploads/photos/<?= htmlspecialchars($child['photo']); ?>" class="child-photo" alt="<?= htmlspecialchars($child['child_name']); ?>">

    <h4 class="text-center mb-3"><?= htmlspecialchars($child['child_name']); ?>, Age <?= htmlspecialchars($child['age']); ?></h4>
    <p class="text-center text-muted mb-4"><strong>Health:</strong> <?= htmlspecialchars($child['health']); ?> | <strong>DOB:</strong> <?= htmlspecialchars($child['dob']); ?></p>

    <form method="POST">
        <div class="mb-3">
            <label for="message" class="form-label"><i class="fa-solid fa-message"></i> Your Message</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Write a message to the orphanage..." required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100"><i class="fa-solid fa-paper-plane"></i> Submit Request</button>
    </form>

    <a href="view_child.php" class="btn btn-secondary w-100 mt-3"><i class="fa-solid fa-arrow-left"></i> Back to Children List</a>
</div>

</body>
</html>
