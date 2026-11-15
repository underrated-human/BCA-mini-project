<?php
include ("../db.php");
$id=$_GET["id"];
$sql=mysqli_query($con, "update registration set status='Reject' where id='$id'");
header("location:viewusers.php");
?>
