<?php
    require 'koneksi.php';
    require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>JNE</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Header */
        header {
            padding: 1rem;
            background-color: #f9f9f9;
            border-bottom: 1px solid #ccc;
        }

        /* Breadcrumb Container */
        .breadcrumb-container {
            padding: 0.25rem 1rem;
            background-color: #f8f9fa;
        }

        ul.breadcrumb {
            padding: 8px 16px;
            list-style: none;
            background-color: #f8f9fa;
            border-radius: 5px;
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        ul.breadcrumb li {
            display: inline;
            font-size: 18px;
            color: #6c757d;
        }

        ul.breadcrumb li + li:before {
            padding: 0 8px;
            color: #6c757d;
            content: ">";
        }

        ul.breadcrumb li a {
            color: #0275d8;
            text-decoration: none;
        }

        ul.breadcrumb li a:hover {
            color: #01447e;
            text-decoration: underline;
        }

        /* Navbar Brand */
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Sidebar Navigation */
        .sb-sidenav {
            background-color: #e9ecef; /* Light gray background */
            border-right: 1px solid #ddd; /* Add right border */
        }

        .sb-sidenav-menu-heading {
            font-size: 1.1rem;
            color: #6c757d;
        }

        .sb-nav-link-icon {
            margin-right: 10px;
        }

        .nav-link {
            border-bottom: 1px solid #ddd; /* Add bottom border to nav links */
        }

        /* Main Heading */
        .heading {
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
        }


        
        /* Custom CSS for card styling */
        .card-custom {
            border: none;
            transition: all 0.3s ease;
            height: 100%;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-custom .icon {
            color: rgba(255, 255, 255, 0.85);
        }

        .card-custom .text {
            flex: 1;
        }

        .card-custom .card-footer {
            background-color: rgba(0, 0, 0, 0.1);
            border-top: none;
            justify-content: space-between;
            padding: 0.75rem 1rem;
        }

        .card-custom .card-footer a.stretched-link {
            text-decoration: none;
            color: inherit;
        }

        .card-custom .card-footer i {
            opacity: 0.5;
        }

        /* Responsive styles */
        @media (max-width: 991.98px) {
            .card-custom .icon {
                font-size: 2rem;
            }
        }

        @media (max-width: 767.98px) {
            .card-custom {
                height: auto;
            }

            .card-custom .icon {
                font-size: 2.5rem;
            }
        }

        /* Custom CSS for chart styling */
        .chart-container {
            position: relative;
            height: 400px; /* Adjust height as needed */
            width: 100%;
        }

        /* Responsive styles */
        @media (max-width: 767.98px) {
            .chart-container {
                height: 300px; /* Adjust height for smaller screens */
            }
        }

        /* Additional margin for separation */
        .mt-4 {
            margin-top: 1.5rem !important;
        }
                /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            z-index: 1000;
            display: none;
        }

        /* Loading Spinner */
        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Spinner Border */
        .spinner-border {
            width: 50px;
            height: 50px;
            border: 3px solid #ccc;
            border-top: 3px solid #337ab7;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Keyframes for Spinner Animation */
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
                    <a class="nav-link" href="index.php" style="border-bottom: 1px solid #ddd;">
                        <div class="sb-nav-link-icon"><i class="fas fa-home-alt"></i></div>
                        Dashboard
                    </a>
                    <!-- Interface Section -->
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts" style="border-bottom: 1px solid #ddd;">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Master Data
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="barang.php" style="border-bottom: 1px solid #ddd;">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fas fa-box mr-2"></i>
                                    <span>Barang</span>
                                </div>
                            </a>
                            <a class="nav-link" href="pelanggan.php" style="border-bottom: 1px solid #ddd;">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>Pelanggan</span>
                                </div>
                            </a>
                            <a class="nav-link" href="kurir.php" style="border-bottom: 1px solid #ddd;">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fas fa-truck mr-2"></i>
                                    <span>Kurir</span>
                                </div>
                            </a>
                        </nav>
                    </div>

                    <a class="nav-link d-flex align-items-center" href="pengiriman.php" style="border-bottom: 1px solid #ddd;">
                        <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                        Pengiriman
                    </a>

                    <a class="nav-link d-flex align-items-center" href="user.php" style="border-bottom: 1px solid #ddd;">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        User
                    </a>

                </div>
            </div>
        </nav>
    </div>
    