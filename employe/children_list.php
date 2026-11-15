<?php
include("../db.php");

// --- UPDATE LOGIC (from modal form) ---
if (isset($_POST['update'])) {
    $id         = intval($_POST['id']);
    $child_name = mysqli_real_escape_string($con, $_POST['child_name']);
    $age        = mysqli_real_escape_string($con, $_POST['age']);
    $health     = mysqli_real_escape_string($con, $_POST['health']);
    $dob        = mysqli_real_escape_string($con, $_POST['dob']);
    $join_date  = mysqli_real_escape_string($con, $_POST['join_date']);
    $status     = mysqli_real_escape_string($con, $_POST['status']);

    // Get existing child
    $res = mysqli_query($con, "SELECT photo FROM children WHERE id=$id");
    $old = mysqli_fetch_assoc($res);

    // Handle photo
    $photo = $old['photo'];
    if (!empty($_FILES['photo']['name'])) {
        $filename = time() . "_" . basename($_FILES["photo"]["name"]);
        $target = "uploads/children/" . $filename;
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target)) {
            $photo = $filename;
        }
    }

    // Update query
    $update = "UPDATE children SET 
                child_name='$child_name',
                age='$age',
                health='$health',
                dob='$dob',
                join_date='$join_date',
                status='$status',
                photo='$photo'
               WHERE id=$id";

    if (mysqli_query($con, $update)) {
        echo "<script>alert('Child updated successfully!'); window.location='children_list.php';</script>";
    } else {
        echo "<script>alert('Update failed! Try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Children List - Employee Panel</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include("sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle d-flex justify-content-between align-items-center">
    <h1>Children List</h1>
  </div>

  <div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-3">
      <div class="card-body p-4">

        <h3 class="text-center text-primary mb-4">All Children</h3>

        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Age</th>
                <th>Health</th>
                <th>DOB</th>
                <th>Join Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $result = mysqli_query($con, "SELECT * FROM children ORDER BY id DESC");
              if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><img src="uploads/children/<?= htmlspecialchars($row['photo']); ?>" width="50" height="50" class="rounded-circle"></td>
                    <td><?= htmlspecialchars($row['child_name']); ?></td>
                    <td><?= htmlspecialchars($row['age']); ?></td>
                    <td><?= htmlspecialchars($row['health']); ?></td>
                    <td><?= htmlspecialchars($row['dob']); ?></td>
                    <td><?= htmlspecialchars($row['join_date']); ?></td>
                    <td>
                      <?php if ($row['status'] == "Active") { ?>
                        <span class="badge bg-success">Active</span>
                      <?php } elseif ($row['status'] == "Adopted") { ?>
                        <span class="badge bg-info">Adopted</span>
                      <?php } else { ?>
                        <span class="badge bg-secondary">Inactive</span>
                      <?php } ?>
                    </td>
                    <td>
                      <!-- Edit Button (opens modal) -->
                      <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id']; ?>">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <!-- Delete -->
                      <a href="delete_child.php?id=<?= $row['id']; ?>" 
                         onclick="return confirm('Are you sure to delete this record?');" 
                         class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>

                  <!-- Modal for Edit -->
                  <!-- Modal for Edit -->
<div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <form method="post" enctype="multipart/form-data">
        <!-- Modal Header with Gradient -->
        <div class="modal-header text-white" style="background: linear-gradient(90deg, #4e73df, #1cc88a); border-bottom: none;">
          <h5 class="modal-title fw-bold">Edit Child - <?= htmlspecialchars($row['child_name']); ?></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <input type="hidden" name="id" value="<?= $row['id']; ?>">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Child Name</label>
              <input type="text" name="child_name" class="form-control form-control-lg" value="<?= htmlspecialchars($row['child_name']); ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Age</label>
              <input type="number" name="age" class="form-control form-control-lg" value="<?= htmlspecialchars($row['age']); ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Health</label>
              <input type="text" name="health" class="form-control form-control-lg" value="<?= htmlspecialchars($row['health']); ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Date of Birth</label>
              <input type="date" name="dob" class="form-control form-control-lg" value="<?= htmlspecialchars($row['dob']); ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Join Date</label>
              <input type="date" name="join_date" class="form-control form-control-lg" value="<?= htmlspecialchars($row['join_date']); ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Status</label>
              <select name="status" class="form-select form-select-lg">
                <option value="Active" <?= $row['status']=="Active"?"selected":""; ?>>Active</option>
                <option value="Adopted" <?= $row['status']=="Adopted"?"selected":""; ?>>Adopted</option>
                <option value="Inactive" <?= $row['status']=="Inactive"?"selected":""; ?>>Inactive</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label fw-semibold">Photo</label><br>
              <img src="uploads/children/<?= htmlspecialchars($row['photo']); ?>" width="100" class="mb-2 rounded-circle border border-2 border-light shadow-sm">
              <input type="file" name="photo" class="form-control form-control-lg">
            </div>
          </div>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="submit" name="update" class="btn btn-success btn-lg shadow-sm">
            <i class="bi bi-check-circle me-2"></i> Update
          </button>
          <button type="button" class="btn btn-outline-secondary btn-lg shadow-sm" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-2"></i> Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

                <?php }
              } else { ?>
                <tr>
                  <td colspan="9" class="text-center text-muted">No children found</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</main>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
