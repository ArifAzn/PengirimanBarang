<?php
require 'koneksi.php';
require 'cek.php';

$id_user = $_SESSION['id_user'];
$query = "SELECT * FROM pelanggan WHERE id_user = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $nama = $data['nama'];
    $telepon = $data['telepon'];
    $alamat = $data['alamat'];
    $date_added = $data['date_added']; // Assuming this field exists in your pelanggan table
} else {
    echo "Data pelanggan tidak ditemukan.";
    exit();
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pelanggan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                .card {
            border: 1px solid #007bff; /* Blue border for the card */
            border-radius: 10px; /* Rounded corners */
        }
        .card-header {
            background-color: #007bff; /* Blue background for card header */
            color: #fff; /* White text */
            padding: 0.5rem 1rem; /* Padding for header */
            font-size: 1.25rem; /* Font size */
            border-top-left-radius: 10px; /* Rounded top-left corner */
            border-top-right-radius: 10px; /* Rounded top-right corner */
        }
        .card-body {
            padding: 1.5rem; /* Padding for card body */
        }
        .form-label {
            font-weight: bold; /* Bold labels */
        }
        .form-control {
            border-color: #007bff; /* Blue border color for inputs */
        }
        .btn-primary {
            background-color: #007bff; /* Blue background for primary button */
            border-color: #007bff; /* Blue border for primary button */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Darker blue border on hover */
        }
    </style>

</head>

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
    <a class="navbar-brand ps-3" href="index.php">JNE</a>
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
            <ul class="breadcrumb">
                <li><a href="index.php">Dashboard</a></li>
                <li>Profil</li>
            </ul>
        <main class="container py-4">
            <header class="text-center mb-4">
                <h1 class="display-5 fw-bold">Profil Pelanggan</h1>
            </header>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Data Pelanggan</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8 mx-auto">
                            <div class="mb-3">
                                <label for="idPelangganInput" class="form-label">ID Pelanggan</label>
                                <input type="text" id="idPelangganInput" class="form-control" value="<?php echo $id_user; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="namaInput" class="form-label">Nama Pelanggan</label>
                                <input type="text" id="namaInput" class="form-control" value="<?php echo $nama; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="teleponInput" class="form-label">Nomor Telepon</label>
                                <input type="text" id="teleponInput" class="form-control" value="<?php echo $telepon; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="alamatInput" class="form-label">Alamat</label>
                                <textarea id="alamatInput" class="form-control" readonly><?php echo $alamat; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<script>
$(document).ready(function() {
  $(".loading-overlay").fadeIn(500); // Fade in the overlay with a 500ms animation
});

// Hide the loading overlay when the page is fully loaded
$(window).on('load', function() {
  setTimeout(function() {
    $(".loading-overlay").fadeOut(500); // Fade out the overlay with a 500ms animation
  }, 100); // Add a 2-second delay to ensure all resources are loaded
});
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

    </body>
</html>
