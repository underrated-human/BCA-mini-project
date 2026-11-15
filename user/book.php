<?php
include("../db.php");
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Redirect if service not specified
if (!isset($_GET['service'])) {
    header("Location: service.php");
    exit();
}

// Get and sanitize service name from URL
$service_name = mysqli_real_escape_string($con, $_GET['service']);
$result = mysqli_query($con, "SELECT * FROM serviceregister WHERE service = '$service_name'");
$service = mysqli_fetch_assoc($result);

// If service not found
if (!$service) {
    echo "<h3>Service not found.</h3>";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_number = $_POST['card_number'];
    $cvv = $_POST['cvv'];
    $expiry_date = $_POST['expiry_date'];

    // Validate input
    if (preg_match('/^\d{16}$/', $card_number) && preg_match('/^\d{3}$/', $cvv)) {
        $last4 = substr($card_number, -4);
        $service_id = $service['id'];
        $user_id = $_SESSION['user']['id'];
      

       echo $sql = "INSERT INTO bookings (service_id, card_last4, expiry_date, created_at, user,nurse) 
                VALUES ('$service_id', '$last4', '$expiry_date', NOW(), '$user_id','0')";

        if (mysqli_query($con, $sql)) {
        echo "<script>alert('Booking successful!'); window.location.href='book.php';</script>";
            exit();
        } else {
          //echo "<script>alert('Booking failed. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid card number or CVV.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Book Service - Dr. Johnson</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Nunito', sans-serif;
        }

        .booking-wrapper {
            max-width: 800px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-weight: 800;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-danger {
            font-size: 18px;
            font-weight: 600;
            padding: 12px 0;
        }

        .price-tag {
            font-size: 22px;
            font-weight: 700;
            color: #28a745;
        }

        @media (max-width: 768px) {
            .booking-wrapper {
                margin: 30px 15px;
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
<?php include "header.php"; ?>

<div class="container">
    <div class="booking-wrapper">
        <h3 class="text-center text-danger mb-3"><?php echo htmlspecialchars($service['service']); ?></h3>
        <p class="text-muted text-center"><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
        <div class="text-center mb-4">
            <span class="price-tag">Price: $<?php echo htmlspecialchars($service['price']); ?></span>
        </div>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Card Number</label>
                <input type="text" name="card_number" class="form-control" maxlength="16" pattern="\d{16}" placeholder="1234567812345678" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">CVV</label>
                    <input type="text" name="cvv" class="form-control" maxlength="3" pattern="\d{3}" placeholder="123" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-danger btn-lg">Confirm Booking</button>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
