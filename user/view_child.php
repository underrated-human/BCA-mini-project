<?php
include("../db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Orphanage - Meet Our Children</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicons -->
    <link href="img/favicon.ico" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Nunito:600,700,800,900|Poppins:400,500,600" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/animate/animate.min.css" rel="stylesheet">
    <link href="vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="css/hover-style.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        body {
            background-color: #e6f7fb;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            color: #1da3c5;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Child Card */
        .child-card {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .child-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }

        .child-photo-wrapper {
            height: 220px;
            overflow: hidden;
            border-bottom: 1px solid #ddd;
        }

        .child-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .child-card:hover .child-photo {
            transform: scale(1.05);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1da3c5;
        }

        .badge {
            font-size: 0.85rem;
            border-radius: 20px;
            padding: 5px 12px;
        }

        .btn-adopt {
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .child-card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<?php include "header.php"; ?>

<main class="container my-5">
    <h2 class="text-center text-primary mb-4">Meet Our Children</h2>
    <div class="row g-4">
        <?php
        // ✅ Fetch only Active children (hide Adopted & Inactive)
        $result = mysqli_query($con, "SELECT * FROM children WHERE status='Active' ORDER BY id DESC");
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){ ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card child-card h-100">
                        <div class="child-photo-wrapper">
                            <img src="../uploads/photos/<?= htmlspecialchars($row['photo']); ?>" 
                                 class="child-photo card-img-top" 
                                 alt="<?= htmlspecialchars($row['child_name']); ?>">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($row['child_name']); ?></h5>
                            <p class="card-text mb-1"><strong>Age:</strong> <?= htmlspecialchars($row['age']); ?></p>
                            <p class="card-text mb-1"><strong>Health:</strong> <?= htmlspecialchars($row['health']); ?></p>
                            <p class="card-text mb-2"><strong>DOB:</strong> <?= htmlspecialchars($row['dob']); ?></p>

                            <span class="badge bg-success mb-2 d-inline-block">Active</span>

                            <!-- Adoption Request Button -->
                            <a href="adoption_request.php?child_id=<?= $row['id']; ?>" 
                               class="btn btn-primary btn-sm btn-adopt">
                               Request Adoption
                            </a>
                        </div>
                    </div>
                </div>
        <?php } 
        } else { ?>
            <div class="col-12 text-center text-muted">
                No active children found.
            </div>
        <?php } ?>
    </div>
</main>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
