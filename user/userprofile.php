<?php 
include '../db.php'; 

// Redirect if user is not logged in
if (!isset($_SESSION['user'])) {     
    header("Location: index.php");     
    exit; 
}  

$user = $_SESSION['user']; 
$userId = $user['id'];  

// Update profile
if (isset($_POST['update'])) {     
    // Sanitize user input     
    $name = mysqli_real_escape_string($con, $_POST['name']);     
    $address = mysqli_real_escape_string($con, $_POST['address']);     
    $pin = mysqli_real_escape_string($con, $_POST['pin']);     
    $email = mysqli_real_escape_string($con, $_POST['email']);     
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);     
    $password = mysqli_real_escape_string($con, $_POST['password']);      

    // SQL UPDATE query     
    $sql = "UPDATE registration SET                  
                Name='$name',                 
                Address='$address',                 
                Pin='$pin',                 
                Email='$email',                 
                Mobile='$mobile',                 
                Password='$password'             
            WHERE id='$userId'";      

    if (mysqli_query($con, $sql)) {         
        $result = mysqli_query($con, "SELECT * FROM registration WHERE id ='$userId'");         
        $_SESSION['user'] = mysqli_fetch_assoc($result);         
        $success = "Profile updated successfully.";     
    } else {         
        $error = "Failed to update profile.";     
    } 
}  

$user = $_SESSION['user']; 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head>     
    <meta charset="utf-8">     
    <title>orphanage</title>     
    <meta content="width=device-width, initial-scale=1.0" name="viewport">     
    <meta content="" name="keywords">     
    <meta content="" name="description">      

    <!-- Favicons -->     
    <link href="img/favicon.ico" rel="icon">     
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">      

    <!-- Google Fonts -->     
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Nunito:600,700,800,900" rel="stylesheet">       

    <!-- Bootstrap CSS File -->     
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">      

    <!-- Libraries CSS Files -->     
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">     
    <link href="vendor/animate/animate.min.css" rel="stylesheet">     
    <link href="vendor/ionicons/css/ionicons.min.css" rel="stylesheet">     
    <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">      

    <!-- Main Stylesheet File -->     
    <link href="css/hover-style.css" rel="stylesheet">     
    <link href="css/style.css" rel="stylesheet">      

    <style>         
        body {             
            background-color: #e6f7fb; /* light blue background */             
            font-family: 'Poppins', sans-serif;         
        }  

        .profile-container {             
            max-width: 600px;             
            background-color: white;             
            margin: 50px auto;             
            padding: 30px;             
            border-radius: 12px;             
            box-shadow: 0 0 10px rgba(29, 163, 197, 0.4);             
            border-top: 5px solid #1da3c5;         
        }  

        h2 {             
            color: #1da3c5;             
            text-align: center;             
            margin-bottom: 30px;         
        }  

        .alert {             
            font-size: 0.9rem;         
        }  

        /* Two-column label/input rows */         
        form .form-row {             
            display: flex;             
            align-items: center;             
            margin-bottom: 15px;         
        }         
        form .form-row label {             
            flex: 0 0 130px;  /* fixed width for labels */             
            color: #1da3c5;             
            font-weight: 600;             
            margin-bottom: 0;             
            padding-right: 15px;             
            text-align: right;         
        }         
        form .form-row input {             
            flex: 1;             
            padding: 8px 12px;             
            border: 1px solid #ddd;             
            border-radius: 5px;             
            font-size: 1rem;         
        }  

        .btn-danger {             
            background-color: #1da3c5;             
            border: none;             
            padding: 10px 30px;             
            font-size: 1rem;         
        }  

        .btn-danger:hover {             
            background-color: #178aa5;         
        }  

        .text-center {             
            margin-top: 25px;         
        }     
    </style> 
</head> 

<body>      
    <?php include "header.php"; ?>
   
    <div class="profile-container">         
        <h2>Welcome, <?= htmlspecialchars($user['Name']) ?>!</h2>          

        <?php if (isset($success)): ?>             
            <div class="alert alert-success"><?= $success ?></div>         
        <?php elseif (isset($error)): ?>             
            <div class="alert alert-danger"><?= $error ?></div>         
        <?php endif; ?>          

        <form action="" method="POST">             
            <div class="form-row">                 
                <label for="name">Full Name</label>                 
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['Name']) ?>" required>             
            </div>              

            <div class="form-row">                 
                <label for="address">Address</label>                 
                <input type="text" name="address" id="address" value="<?= htmlspecialchars($user['Address']) ?>" required>             
            </div>              

            <div class="form-row">                 
                <label for="pin">PIN</label>                 
                <input type="text" name="pin" id="pin" value="<?= htmlspecialchars($user['Pin']) ?>" required>             
            </div>              

            <div class="form-row">                 
                <label for="email">Email</label>                 
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['Email']) ?>" required>             
            </div>              

            <div class="form-row">                 
                <label for="mobile">Mobile</label>                 
                <input type="text" name="mobile" id="mobile" value="<?= htmlspecialchars($user['Mobile']) ?>" required>             
            </div>              

            <div class="form-row">                 
                <label for="password">Password</label>                 
                <input type="text" name="password" id="password" value="<?= htmlspecialchars($user['Password']) ?>" required>             
            </div>              

            <div class="text-center">                 
                <button type="submit" name="update" class="btn btn-danger">Update Profile</button>             
            </div>         
        </form>     
    </div>      

    <!-- Bootstrap JS -->     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body> 
</html>
