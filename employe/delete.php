<?php
ob_start();
include '../db.php'; 
$id=$_GET['id'];
$sql=mysqli_query($con, "delete from registration where id='$id'");
header("location:viewusers.php");
?>