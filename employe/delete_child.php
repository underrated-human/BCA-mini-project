<?php
include '../db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Invalid child ID!'); window.location.href='childlist.php';</script>";
    exit();
}

$id = (int)$_GET['id'];

// Delete related adoption requests first
$possible_columns = ['child_id', 'childid', 'children_id', 'orphan_id'];
foreach ($possible_columns as $column) {
    $check = mysqli_query($con, "SHOW COLUMNS FROM adoption_requests LIKE '$column'");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($con, "DELETE FROM adoption_requests WHERE $column = $id");
        break;
    }
}

$result = mysqli_query($con, "DELETE FROM children WHERE id = $id");

if ($result) {
    echo "<script>
        alert('Child deleted successfully!');
        window.location.href = 'children_list.php';
    </script>";
} else {
    echo "<script>
        alert('Delete failed! Please try again.');
        window.location.href = 'childlist.php';
    </script>";
}

mysqli_close($con);
exit();
?>