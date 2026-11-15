
<?php
ob_start();
include '../db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: viewusers.php?error=invalid_id");
    exit();
}

$id = (int)$_GET['id'];

mysqli_begin_transaction($con);

try {
    $stmt1 = mysqli_prepare($con, "DELETE FROM adoption_requests WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt1, 'i', $id);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);

    $stmt2 = mysqli_prepare($con, "DELETE FROM feedback WHERE Userid = ?");
    mysqli_stmt_bind_param($stmt2, 'i', $id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    $stmt3 = mysqli_prepare($con, "DELETE FROM sponsorships WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt3, 'i', $id);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_close($stmt3);

    $stmt4 = mysqli_prepare($con, "DELETE FROM registration WHERE id = ?");
    mysqli_stmt_bind_param($stmt4, 'i', $id);
    mysqli_stmt_execute($stmt4);
    mysqli_stmt_close($stmt4);

    mysqli_commit($con);
    header("Location: viewusers.php?success=user_deleted");
    
} catch (Exception $e) {
    mysqli_rollback($con);
    header("Location: viewusers.php?error=delete_failed");
}

mysqli_close($con);
exit();
?>