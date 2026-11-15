
<?php
include ("../db.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $reply = mysqli_real_escape_string($con, $_POST['reply']);

    $update = mysqli_query($con, "UPDATE feedback SET reply='$reply' WHERE id='$id'");

    if ($update) {
        echo "Reply saved successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>