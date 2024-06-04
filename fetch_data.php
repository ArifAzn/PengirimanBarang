<?php
// fetch_data.php
require 'koneksi.php';

// Fetch Pelanggan data
$pelanggan_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pelanggan");
$pelanggan_data = mysqli_fetch_assoc($pelanggan_query);

// Fetch Kurir data
$kurir_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM kurir");
$kurir_data = mysqli_fetch_assoc($kurir_query);

// Fetch Pengiriman data
$pengiriman_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengiriman");
$pengiriman_data = mysqli_fetch_assoc($pengiriman_query);

$barang_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM barang");
$barang_data = mysqli_fetch_assoc($barang_query);

$data = [
    'pelanggan' => $pelanggan_data['total'],
    'kurir' => $kurir_data['total'],
    'pengiriman' => $pengiriman_data['total'],
    'barang' => $barang_data['total'],
];

echo json_encode($data);
?>
