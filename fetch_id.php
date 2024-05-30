<?php
require 'koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getNextAutoIncrementId($conn, $table) {
    $result = mysqli_query($conn, "SHOW TABLE STATUS LIKE '$table'");
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['Auto_increment'];
    return $nextId;
}

$field = $_GET['field'];

if ($field == 'id_barang') {
    $nextId = getNextAutoIncrementId($conn, 'barang');
} else if ($field == 'id_kategori') {
    $nextId = getNextAutoIncrementId($conn, 'kategori');
} else if ($field == 'id_pelanggan') {
    $nextId = getNextAutoIncrementId($conn, 'pelanggan');
} else if ($field == 'id_kurir') {
    $nextId = getNextAutoIncrementId($conn, 'kurir');
} else if ($field == 'id_pengiriman') {
    $nextId = getNextAutoIncrementId($conn, 'pengiriman');
} else {
    exit;
}

echo json_encode(array("nextId" => $nextId));
?>
