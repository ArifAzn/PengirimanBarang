<?php
require 'koneksi.php';
require 'cek.php';


echo "Welcome, " . $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pelanggan Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        /* Adjust container styles to ensure good spacing and alignment */
        header {
            padding: 1rem;
            background-color: #f9f9f9; /* Ensure good background contrast */
            border-bottom: 1px solid #ccc; /* Add a border if needed */
        }
        ul.breadcrumb {
            padding: 10px 16px;
            list-style: none;
            background-color: #f8f9fa; /* Light background */
            border-radius: 5px; /* Rounded corners for better aesthetics */
        }

        ul.breadcrumb li {
            display: inline;
            font-size: 18px;
            color: #6c757d; /* Neutral color to blend with light background */
        }

        ul.breadcrumb li+li:before {
            padding: 8px;
            color: #6c757d; /* Same color as text for consistency */
            content: "/\00a0";
        }

        ul.breadcrumb li a {
            color: #0275d8;
            text-decoration: none;
        }

        ul.breadcrumb li a:hover {
            color: #01447e;
            text-decoration: underline;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .sb-sidenav-menu-heading {
            font-size: 1.1rem;
            color: #6c757d;
        }

        .sb-nav-link-icon {
            margin-right: 10px;
        }

        .breadcrumb {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .heading {
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
        }

        .card-header {
            background-color: #007bff !important;
            color: #fff;
            border-radius: 5px 5px 0 0;
        }
        
        .loading-overlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(255, 255, 255, 0.5);
          z-index: 1000;
          display: none; /* Initially hide the overlay */
        }

        .loading-spinner {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
        }

        .spinner-border {
          width: 50px;
          height: 50px;
          border: 3px solid #ccc;
          border-top: 3px solid #337ab7;
          border-radius: 50%;
          animation: spin 1s linear infinite;
        }

        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }
    </style>
</head>
<body class="sb-nav-fixed">

<div class="loading-overlay">
  <div class="loading-spinner">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</div>

<!-- Top Navbar -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="pelanggan_dashboard.php">JNE</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    <!-- User Information Dropdown-->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i> <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'Guest'; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
  <div id="layoutSidenav">
    <!-- Sidebar Navigation -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-primary" id="sidenavAccordion" style="background-color: #f8f9fa;">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!-- Core Section -->
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="pelanggan_dashboard.php" style="border-bottom: 1px solid #ddd;">
                        <div class="sb-nav-link-icon"><i class="fas fa-home-alt"></i></div>
                        Dashboard
                    </a>
                    <!-- Interface Section -->
                    <div class="sb-sidenav-menu-heading">Interface</div>

                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            </nav>
                        </div>
                        <a class="nav-link d-flex align-items-center" href="barang_pelanggan.php" style="border-bottom: 1px solid #ddd;">
                          <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                          Barang
                        </a>
                        <a class="nav-link d-flex align-items-center" href="profile.php" style="border-bottom: 1px solid #ddd;">
                          <div class="sb-nav-link-icon"><i class="fas fa-profile"></i></div>
                          Profil
                        </a>

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <header class="text-center my-4"><h1 class="heading">Pelanggan Dashboard</h1></header>
                    <div class="row">
                        <!-- Example of a card for barang -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-box fa-2x"></i>
                                    </div>
                                    <div>Barang</div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="barang_pelanggan.php" aria-label="Barang">Selengkapnya</a>
                                    <div class="small text-white" aria-hidden="true"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- Add more cards as needed -->
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
