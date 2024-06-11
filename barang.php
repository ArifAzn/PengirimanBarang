<?php

    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    require 'koneksi.php';
    require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang</title>
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

        <div id="layoutSidenav_content">
            <main>

                    <ul class="breadcrumb">
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Barang</li>
                    </ul>

                    <div class="container-fluid px-4">
                    <header  class="text-center my-4"><h1 class="heading">Input Data Barang</h1></header>

                    <div class="card mb-4">
                        <div class="card-header navbar-dark bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Data Barang</h5>
                                <div>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-plus"></i> Tambah</button>
                                    <a href="export_barang.php" class="btn btn-info"><i class="fas fa-download"></i> Export Data</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php
                            if(isset($_SESSION['status']))
                            { ?>
                                <div class="alert alert-<?php echo $_SESSION['alert_type']; ?> alert-dismissible fade show" role="alert">
                                  <strong>✓ Berhasil <?php echo $_SESSION['status']; ?></strong>
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php
                                unset($_SESSION['status']);
                                unset($_SESSION['alert_type']);
                            } ?>
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Quantity</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambilsemuadata = mysqli_query($conn, "SELECT * FROM barang");
                                    while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                        $id_barang = $data['id_barang'];
                                        $nama_barang = $data['nama_barang'];
                                        $qty = $data['qty'];
                                        $deskripsi = $data['deskripsi'];
                                    ?>
                                    <tr>
                                        <td><?php echo $id_barang; ?></td>
                                        <td><?php echo $nama_barang; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $deskripsi; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $id_barang; ?>"><i class="fas fa-edit"></i> Edit</button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_barang; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                                        </td>
                                    </tr>

                                    <!-- Edit -->
                                    <div class="modal fade" id="editModal<?php echo $id_barang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="koneksi.php">
                                                        <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>">

                                                        <div class="mb-3">
                                                            <label for="namaBarangInput<?php echo $id_barang; ?>" class="form-label">Nama Barang</label>
                                                            <input type="text" name="nama_barang" id="namaBarangInput<?php echo $id_barang; ?>" class="form-control" value="<?php echo $nama_barang; ?>" required>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label for="quantityInput<?php echo $id_barang; ?>" class="form-label">Quantity </label>
                                                            <input type="number" name="qty" id="quantityInput<?php echo $id_barang; ?>" class="form-control" value="<?php echo $qty; ?>" required>
                                                        </div>

                                                        <!-- Deskripsi -->
                                                        <div class="mb-3">
                                                            <label for="deskripsi<?php echo $id_barang; ?>" class="form-label">Alamat Tujuan</label>
                                                            <textarea class="form-control" id="deskripsi<?php echo $id_barang; ?>" name="deskripsi" required><?php echo $deskripsi; ?></textarea>
                                                        </div>
         
                                                        <!-- Submit Button -->
                                                        <div class="text-end">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fas fa-times"></i> Tutup
                                                            </button>
                                                            <button type="submit" class="btn btn-warning" name="updatebr">
                                                                <i class="fas fa-save"></i> Simpan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hapus -->
                                    <div class="modal fade" id="deleteModal<?php echo $id_barang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST">
                                                        <div class="text-center">
                                                            <p>Apakah anda yakin ingin menghapus <strong><?php echo $nama_barang; ?></strong>?</p>
                                                            <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>">
                                                            <!-- Submit Button -->
                                                            <button type="submit" class="btn btn-danger" name="deletebr">
                                                                <i class="fas fa-trash-alt"></i> Hapus
                                                            </button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fas fa-times"></i> Batal
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Tambah Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <form method="POST" action="koneksi.php">
                    <div class="modal-body">
                        <!-- ID Barang (Hidden) -->
                        <div class="mb-3">
                            <label for="idBarangInput" class="form-label">ID Barang</label>
                            <input type="text" name="id_barang" id="idBarangInput" class="form-control" disabled>
                            <script>
                                // Fetch next ID for id_barang
                                fetch('fetch_id.php?field=id_barang')
                                    .then(response => response.json())
                                    .then(data => {
                                        if (!data.error) {
                                            document.getElementById('idBarangInput').value = data.nextId;
                                        } else {
                                            console.error('Error fetching next ID:', data.error);
                                        }
                                    })
                                    .catch(error => console.error('Error fetching next ID:', error));
                            </script>
                        </div>

                        <!-- Nama Barang -->
                        <div class="mb-3">
                            <label for="namaBarangInput" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" id="namaBarangInput" class="form-control" placeholder="Nama Barang" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantityInput" class="form-label">Quantity</label>
                            <input type="number" name="qty" id="quantityInput" class="form-control" placeholder="Quantity" required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsiInput" class="form-label">Deskripsi</label>
                            <textarea type="text" name="deskripsi" id="deskripsiInput" class="form-control" placeholder="Deskripsi" required></textarea>
                        </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="addnewbr">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Tutup
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Add this to your JavaScript code -->
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