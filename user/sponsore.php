<?php
include("../db.php");

// ✅ Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in to submit a sponsorship.</div>";
    exit;
}

$user_id = $_SESSION['user']['id'];
$success = $error = "";

// Handle form submission
if (isset($_POST['submit'])) {
    $type = mysqli_real_escape_string($con, $_POST['type']); 
    $amount = mysqli_real_escape_string($con, $_POST['amount'] ?? 0);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $card_number = $expiry_date = $cvv = null;
    
    if ($type == 'amount') {
        $card_number = mysqli_real_escape_string($con, $_POST['card_number'] ?? '');
        $expiry_date = mysqli_real_escape_string($con, $_POST['expiry_date'] ?? '');
        $cvv = mysqli_real_escape_string($con, $_POST['cvv'] ?? '');

        if (empty($amount) || empty($card_number) || empty($expiry_date) || empty($cvv)) {
            $error = "Please fill all amount and card details.";
        }
    }
    
    if (!$error) {
        $query = "INSERT INTO sponsorships 
                  (user_id, type, amount, description, card_number, expiry_date, cvv, status, created_at)
                  VALUES 
                  ($user_id, '$type', '$amount', '$description', 
                  " . ($card_number ? "'$card_number'" : "NULL") . ", 
                  " . ($expiry_date ? "'$expiry_date'" : "NULL") . ", 
                  " . ($cvv ? "'$cvv'" : "NULL") . ",
                  'pending', NOW())";

        if (mysqli_query($con, $query)) {
            $success = "Sponsorship request submitted successfully!";
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Sponsorship</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #e0f7fa 0%, #f0f9ff 100%);
    }
    .form-container {
        max-width: 650px;
        margin: 60px auto;
        padding: 40px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .form-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }
    h2 {
        color: #1da3c5;
        font-weight: 700;
    }
    .form-label {
        font-weight: 500;
        color: #333;
    }
    .btn-primary {
        background: #1da3c5;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
        border-radius: 50px;
    }
    .btn-primary:hover {
        background: #0e8ba2;
    }
    .btn-outline-secondary {
        border-radius: 50px;
    }
    .amount-fields {
        background: #e6f7fa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 15px;
        border: 1px solid #b2ebf2;
    }
    .amount-fields input {
        border-radius: 8px;
    }
    textarea.form-control {
        border-radius: 12px;
    }
    .alert-success {
        background-color: #d4f0f4;
        color: #0c5a63;
        border: none;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
        border: none;
    }
</style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center mb-4">Add Sponsorship</h2>

    <?php if($success) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Type of Sponsorship</label>
            <select name="type" class="form-select" required id="typeSelect">
                <option value="">Select Type</option>
                <option value="amount">Amount</option>
                <option value="dress">Dress / Clothes</option>
                <option value="food">Food / Groceries</option>
                <option value="other">Other</option>
            </select>
        </div>

        <!-- Amount and Card Details -->
        <div class="amount-fields" style="display:none;">
            <div class="mb-3">
                <label class="form-label">Amount (₹)</label>
                <input type="number" name="amount" class="form-control" placeholder="Enter amount" min="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Card Number</label>
                <input type="text" name="card_number" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">
            </div>
            <div class="mb-3">
                <label class="form-label">Expiry Date</label>
                <input type="month" name="expiry_date" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">CVV</label>
                <input type="password" name="cvv" class="form-control" maxlength="3" placeholder="XXX">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description / Details</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Provide details of sponsorship..." required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Submit Sponsorship</button>
    </form>

    <div class="mt-4 text-center">
        <a href="home.php" class="btn btn-outline-secondary btn-sm">⬅ Back to Home</a>
    </div>
</div>

<script>
const typeSelect = document.getElementById('typeSelect');
const amountFields = document.querySelector('.amount-fields');

typeSelect.addEventListener('change', function() {
    amountFields.style.display = (this.value === 'amount') ? 'block' : 'none';
});
</script>

</body>
</html>
