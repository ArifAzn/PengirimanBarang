<?php
  require 'koneksi.php';

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

  $kategori = [];

  $result = mysqli_query($conn, "SELECT id_kategori, nama FROM kategori");
  while ($row = mysqli_fetch_assoc($result)) {
    $kategori[] = $row;
  }

  echo json_encode($kategori);
?>