<?php
include ("../db.php");
$id=$_GET["id"];
$sql=mysqli_query($con, "update employeregister set status='Approve' where id='$id'");
header("location:");
?>
