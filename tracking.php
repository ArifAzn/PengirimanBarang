<?php
require 'koneksi.php';
require 'cek.php';

$id_pengiriman = isset($_GET['id_pengiriman']) ? $_GET['id_pengiriman'] : '';

$shipment = null;
$sender_name = '';
$sender_phone = '';
$courier_name = '';
$courier_phone = '';
$recipient_address = '';

if ($id_pengiriman) {
    $sql = "SELECT p.*, pel.nama AS nama_pelanggan, pel.telepon AS telepon_pelanggan, k.nama AS nama_kurir, k.telepon AS telepon_kurir
            FROM pengiriman p
            JOIN pelanggan pel ON p.id_pelanggan = pel.id_pelanggan
            JOIN kurir k ON p.id_kurir = k.id_kurir
            WHERE p.id_pengiriman = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_pengiriman);
    $stmt->execute();
    $result = $stmt->get_result();

    $shipment = $result->fetch_assoc();

    if ($shipment) {
        $sender_name = $shipment['nama_pelanggan'];
        $sender_phone = $shipment['telepon_pelanggan'];
        $courier_name = $shipment['nama_kurir'];
        $courier_phone = $shipment['telepon_kurir'];
        $recipient_address = $shipment['AlamatTujuan'];
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .header {
            background-color: #ff6700;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        .header .container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .header a.btn-light {
            position: absolute;
            left: 1rem;
        }
        .header h1 {
            margin: 0;
            font-size: 1.5rem;
            color: white;
            text-align: center;
        }
        .tracking-info {
            margin: 20px auto;
            max-width: 600px;
        }
        .tracking-info .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .tracking-info .card:hover {
            transform: translateY(-5px);
        }
        .tracking-info .card-header {
            background-color: #ff6700;
            border-radius: 10px 10px 0 0;
            color: white;
        }
        .tracking-info .card-body {
            padding: 20px;
        }
        .btn-light {
            border-radius: 50px;
        }
        .card-title {
            font-weight: bold;
        }
        .badge {
            font-size: 1rem;
        }
        @media (max-width: 768px) {
            .header .container {
                flex-direction: column;
                text-align: center;
            }
            .header a.btn-light {
                position: static;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <a href="home.php" class="btn btn-light"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h1>Tracking</h1>
    </div>
</header>

<section class="container tracking-info">
    <?php if ($shipment): ?>
        <div class="card mb-3">
            <div class="card-header">Barang</div>
            <div class="card-body">
                <h5 class="card-title">ID Barang: <?php echo htmlspecialchars($shipment['id_barang']); ?></h5>
                <p class="card-text">Kode Resi: <strong><?php echo htmlspecialchars($shipment['id_pengiriman']); ?></strong></p>
                <p class="card-text">Status: <span class="badge bg-success"><?php echo htmlspecialchars($shipment['Status']); ?></span></p>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Penerima</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($shipment['Penerima']); ?></h5>
                <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($recipient_address); ?></p>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Pengirim</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($sender_name); ?></h5>
                <p class="card-text"><i class="fas fa-phone"></i> <?php echo htmlspecialchars($sender_phone); ?></p>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Kurir</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($courier_name); ?></h5>
                <p class="card-text"><i class="fas fa-phone"></i> <?php echo htmlspecialchars($courier_phone); ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center" role="alert">
            Pengiriman tidak ditemukan dengan ID pengiriman <?php echo htmlspecialchars($id_pengiriman); ?>.
        </div>
    <?php endif; ?>
</section>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>