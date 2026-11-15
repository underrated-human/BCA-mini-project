<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>employee Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom Red & White Theme -->
  <style>
    body {
      background-color: #fff;
      color: #000;
    }

    .header {
      background-color: #1fadd8ff; /* Bright red header */
      color: white;
      padding: 10px 20px;
    }

    .header .logo span {
      color: white;
      font-weight: bold;
    }

    .sidebar {
      background-color: #1fadd8ff; /* Red sidebar */
      min-height: 100vh;
    }

    .sidebar-nav .nav-link {
      color: white;
      transition: background-color 0.3s;
    }

    .sidebar-nav .nav-link:hover,
    .sidebar-nav .nav-link.active,
    .sidebar-nav .nav-link.collapsed:hover {
      background-color: #1fadd8ff; /* Darker red on hover */
      color: white;
    }

    .sidebar-nav .nav-link i {
      color: white;
    }

    .toggle-sidebar-btn {
      font-size: 24px;
      color: white;
      cursor: pointer;
    }

    label {
      margin: 0;
    }
  </style>
</head>
<body>

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between w-100 px-3">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="Logo" style="height: 40px; margin-right: 10px;">
        <span class="d-none d-lg-block">Employee</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar pt-5">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link active" href="home.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Add New Child</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">

 <li>
            <a href="add _child.php">
              <i class="bi bi-circle"></i><span><label>Add Child</label></span>
            </a>
          </li>


          <li>
            <a href="children_list.php">
              <i class="bi bi-circle"></i><span><label>List Of Child</label></span>
            </a>
          </li>
        </ul>
      </li><!-- End Assigned Workers Nav -->


       <li class="nav-item">
        <a class="nav-link collapsed" href="complete_approve.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Approved Child Details</span>
        </a>
      </li>


            <li class="nav-item">
        <a class="nav-link collapsed" href="manage_sponsorship.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>SponsorList</span>
        </a>
      </li>



      <li class="nav-item">
        <a class="nav-link collapsed" href="profile.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Profile</span>
        </a>
      </li>


     

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-dash-circle"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Logout Nav -->

    </ul>

  </aside><!-- End Sidebar -->
