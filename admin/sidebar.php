<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin Panel</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom Red-Orange-Yellow Theme -->
  <style>
    /* Header Styling */
    .header {
      background-color: #22cdebff; /* Red */
      color: white;
      padding: 10px 20px;
    }

    .header .logo span {
      color: white;
      font-weight: bold;
    }

    .toggle-sidebar-btn {
      color: white;
      font-size: 20px;
      cursor: pointer;
    }

    /* Sidebar Styling */
    .sidebar {
      background-color: #22cdebff; /* Orange */
      min-height: 100vh;
      padding-top: 20px;
      color: #fff;
    }

    .sidebar-nav .nav-link {
      color: #ffeb3b; /* Yellow */
      transition: background-color 0.3s, color 0.3s;
    }

    .sidebar-nav .nav-link i {
      color: #ffeb3b; /* Yellow icons */
    }

    .sidebar-nav .nav-link:hover,
    .sidebar-nav .nav-link.collapsed:hover {
      background-color: #22cdebff; /* Darker orange on hover */
      color: white;
    }

    .sidebar-nav .nav-link:hover i {
      color: white;
    }

    .nav-content a {
      color: #fff !important;
    }

    .nav-content a:hover {
      color: #000 !important;
    }
  </style>
</head>
<body>

<!-- Header -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between w-100">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="" height="30">
      <span class="d-none d-lg-block ms-2">Admin</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
</header>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar position-fixed top-10 start-0 pt-5">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#user-nav">
        <i class="bi bi-journal-text"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="user-nav" class="nav-content collapse">
        <li><a href="viewusers.php"><i class="bi bi-circle"></i><span>View Users</span></a></li>
      
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="addemployee.php">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Add employee</span>
      </a>
    </li>

     <li class="nav-item">
      <a class="nav-link collapsed" href="manage_adoption.php">
        <i class="bi bi-chat-left-text"></i>
        <span>adoption request</span>
      </a>
    </li>


 <li class="nav-item">
      <a class="nav-link collapsed" href="admin-approved-requests.php">
        <i class="bi bi-chat-left-text"></i>
        <span>completed adoption request</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="sponsor_history_admin.php">
        <i class="bi bi-chat-left-text"></i>
        <span>sponser history</span>
      </a>
    </li>
   

    <li class="nav-item">
      <a class="nav-link collapsed" href="viewfeedback.php">
        <i class="bi bi-chat-left-text"></i>
        <span>Feedback</span>
      </a>
    </li>

     

    

    <li class="nav-item">
      <a class="nav-link collapsed" href="logout.php">
        <i class="bi bi-dash-circle"></i>
        <span>Logout</span>
      </a>
    </li>
  </ul>
</aside>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
