

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
    
    if (!mysqli_stmt_execute($stmt1)) {
        throw new Exception("Failed to delete related adoption requests");
    }
    mysqli_stmt_close($stmt1);

    $stmt2 = mysqli_prepare($con, "DELETE FROM registration WHERE id = ?");
    mysqli_stmt_bind_param($stmt2, 'i', $id);
    
    if (!mysqli_stmt_execute($stmt2)) {
        throw new Exception("Failed to delete user");
    }
    mysqli_stmt_close($stmt2);

    mysqli_commit($con);
    header("Location: viewusers.php?success=user_deleted");
    
} catch (Exception $e) {
    mysqli_rollback($con);
    error_log("Delete error: " . $e->getMessage());
    header("Location: viewusers.php?error=delete_failed");
}

mysqli_close($con);
exit();
?>