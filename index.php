<!-- index.php -->
<?php
include 'header.php';

// Check if the user is logged in and is an admin
if ($_SESSION['log'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!-- Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <header class="text-center my-4">
                <h1 class="heading">Dashboard</h1>
            </header>

<!-- Cards -->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
    <?php
    $cards = [
        ["title" => "Kurir", "color" => "primary", "url" => "kurir.php", "icon" => "fas fa-truck"],
        ["title" => "Pelanggan", "color" => "warning", "url" => "pelanggan.php", "icon" => "fas fa-user"],
        ["title" => "Barang", "color" => "danger", "url" => "barang.php", "icon" => "fas fa-box"],
        ["title" => "Admin", "color" => "success", "url" => "user.php", "icon" => "fas fa-user-shield"],
    ];

    foreach ($cards as $card) {
        echo generateCard($card);
    }

    function generateCard($card) {
        return '
        <div class="col">
            <div class="card card-custom bg-' . $card['color'] . ' text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon me-3">
                        <i class="' . $card['icon'] . ' fa-3x"></i>
                    </div>
                    <div class="text">
                        <h5 class="card-title mb-0">' . $card['title'] . '</h5>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <a class="stretched-link text-white fw-bold" href="' . $card['url'] . '">' . $card['title'] . '</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>';
    }
    ?>
</div>

<!-- Chart with margin top -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card card-custom mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-chart-bar me-1"></i>
                Chart
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="summaryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const overlay = document.querySelector('.loading-overlay');
        overlay.style.display = 'block';

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
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                min: 0,
                                max: Math.max(data.pelanggan, data.kurir, data.pengiriman, data.barang) + 10
                            }
                        }
                    }
                });

                overlay.style.display = 'none';
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                overlay.style.display = 'none';
            });
    });
</script>


<?php include 'footer.php'; ?>

</body>
</html>
