<?php
include ("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
        <div class="card-header bg-primary text-white text-center">
            <h3>Registration Form</h3>
        </div>
        <div class="card-body">
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                </div>

                <div class="mb-3">
                    <label for="ema" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="ema" name="ema" placeholder="Your Email" required>
                </div>

                <div class="mb-3">
                    <label for="addr" class="form-label">Your Address</label>
                    <input type="text" class="form-control" id="addr" name="address" placeholder="Your Address" required>
                </div>

                <div class="mb-3">
                    <label for="pin" class="form-label">Your PIN</label>
                    <input type="number" class="form-control" id="pin" name="pin" placeholder="Your PIN" required>
                </div>

                        <div class="mb-3">
                    <label for="pin" class="form-label">mobile</label>
                    <input type="number" class="form-control" id="ph" name="mob" placeholder="Your phone" required>
                </div>

                       <div class="mb-3">
                    <label for="pin" class="form-label">password</label>
                    <input type="password" class="form-control" id="ph" name="pswd" placeholder="Your password" required>
                </div>
                <div class="text-center">
                    <button type="submit"  name="s1" class="btn btn-primary px-5">Register</button>
                </div>
            </form>
<?php
if(isset($_POST['s1']))
{
$name=$_POST['name'];
$address=$_POST['address'];
$pin=$_POST['pin'];
$email=$_POST['ema'];
$mobile=$_POST['mob'];
$password=$_POST['pswd'];
$sql= mysqli_query($con,"insert into registration(Name,Address,Pin,Email,Mobile,Password,Status) values('$name','$address','$pin','$email','$mobile','$password','Active')");
$qry= mysqli_query($con,"insert into login(Username,Password,Usertype,Status) values('$email','$password','User','Active')");
echo "<script>alert('Successfully saved your details...');</script>";
}
?>


        </div>
    </div>
</div>

<!-- Bootstrap 5 JS CDN (optional, only if using dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
