<?php
session_start();

// ✅ Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Please log in to view the About page.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>About Our Orphanage</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { 
        font-family: 'Poppins', sans-serif; 
        background: #f0f8ff; 
        color: #333; 
    }
    .about-container { 
        max-width: 900px; 
        margin: 50px auto; 
        padding: 30px; 
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        border-radius: 15px; 
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    h2 { 
        text-align: center; 
        margin-bottom: 20px; 
        color: #6a1b9a;
    }
    p { 
        font-size: 1.1rem; 
        line-height: 1.8;
    }
    .btn-visiting {
        background: linear-gradient(45deg, #ff6f61, #ffca28);
        color: #fff;
        font-weight: bold;
    }
    .modal-header, .modal-footer { background: #f8bbd0; }
</style>
</head>
<body>

<div class="about-container">
    <h2>About Our Orphanage</h2>
    <p>
        Welcome to Sunshine Orphanage! We are dedicated to providing a safe, loving, and nurturing environment for orphaned and vulnerable children. 
        Our mission is to ensure every child receives quality education, proper healthcare, and emotional support to grow into confident and responsible adults. 
        We organize various activities, learning programs, and skill development sessions for our children.
    </p>

    <div class="text-center mt-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-visiting" data-bs-toggle="modal" data-bs-target="#visitingModal">
            Visiting Hours ⏰
        </button>
    </div>

    <div class="mt-4 text-center">
        <a href="home.php" class="btn btn-outline-secondary btn-sm">⬅ Back to Home</a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="visitingModal" tabindex="-1" aria-labelledby="visitingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visitingModalLabel">Visiting Hours</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p style="font-size:1.2rem; color:#ff5722;"><strong>Monday - Saturday:</strong> 10:00 AM to 5:00 PM</p>
        <p style="font-size:1.2rem; color:#3f51b5;"><strong>Sunday:</strong> Closed</p>
        <p style="font-size:1rem; color:#009688;">Please ensure to follow our visiting guidelines.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
