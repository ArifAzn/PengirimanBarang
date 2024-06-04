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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">JNE</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Halaman
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="barang.php">Barang</a>
                                    <a class="nav-link" href="pelanggan.php">Pelanggan</a>
                                    <a class="nav-link" href="kurir.php">Kurir</a>
                                    <a class="nav-link" href="user.php">User</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="pengiriman.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Pengiriman
                        </a>
                        <a class="nav-link" href="logout.php">Logout</a>  
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <?php
                        $cards = [
                            ["title" => "Kurir", "color" => "primary", "url" => "kurir.php", "icon" => "fas fa-truck"],
                            ["title" => "Pelanggan", "color" => "warning", "url" => "pelanggan.php", "icon" => "fas fa-user"],
                            ["title" => "Admin", "color" => "success", "url" => "user.php", "icon" => "fas fa-user-shield"],
                            ["title" => "Pengiriman", "color" => "danger", "url" => "pengiriman.php", "icon" => "fas fa-shipping-fast"],
                        ];

                        foreach ($cards as $card) {
                            ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card bg-<?php echo $card['color']; ?> text-white h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="<?php echo $card['icon']; ?> fa-2x"></i>
                                        </div>
                                        <div><?php echo $card['title']; ?></div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php echo $card['url']; ?>" aria-label="<?php echo $card['title']; ?>">Selangkapnya</a>
                                        <div class="small text-white" aria-hidden="true"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- Chart Container -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Chart
                                </div>
                                <div class="card-body">
                                    <canvas id="summaryChart" style="width: 100%; height: 500px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('fetch_data.php')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('summaryChart').getContext('2d');
                const summaryChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Pelanggan', 'Kurir', 'Pengiriman', 'Barang'],
                        datasets: [{
                            label: 'Count',
                            data: [data.pelanggan, data.kurir, data.pengiriman, data.barang],
                            backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
                            borderWidth: 2

                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                 beginAtZero: true,
                                min: 20, // Set the minimum value of the y-axis
                                max: 20, // Set the maximum value of the y-axis
                            }
                        }
                    }
                });
            });
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
