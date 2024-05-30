<?php
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//konek database
$conn = mysqli_connect("localhost","root","","db_kirimbarang");

//tambah kurir
if (isset($_POST['addnewkr'])) {
    $id_kurir = $_POST['id_kurir'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $addtokurir = mysqli_query($conn, "INSERT INTO kurir (id_kurir, nama, jenis_kelamin, telepon, alamat) VALUES ('$id_kurir', '$nama', '$jenis_kelamin', '$telepon', '$alamat')");

    if ($addtokurir) {
        header('location:kurir.php');
    } else {
        // If insertion fails, handle the error (e.g., display a message or log it)
        header('location:index.php?error=insert_failed');
    }
}

//update kurir
if (isset($_POST['updatekr'])) {
    $id_kurir = $_POST['id_kurir'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $updatekurir = mysqli_query($conn, "UPDATE kurir SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', telepon = '$telepon', alamat = '$alamat' WHERE id_kurir = '$id_kurir'");

    if ($updatekurir) {
        header('location:kurir.php');
    } else {
        // If update fails, handle the error (e.g., display a message or log it)
        header('location:index.php?error=update_failed');
    }
}

//hapus kurir
if (isset($_POST['deletekr'])) {
    $id_kurir = $_POST['id_kurir'];

    $deletekurir = mysqli_query($conn, "DELETE FROM kurir WHERE id_kurir = '$id_kurir'");

    if ($deletekurir) {
        header('location:kurir.php');
    } else {
        // If deletion fails, handle the error (e.g., display a message or log it)
        header('location:index.php?error=delete_failed');
    }
}

//tambah pelanggan
if (isset($_POST['addnewpg'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $addtopelanggan = mysqli_query($conn, "INSERT INTO pelanggan (id_pelanggan, nama, telepon, alamat) VALUES ('$id_pelanggan', '$nama', '$telepon', '$alamat')");

    if ($addtopelanggan) {
        header('location:pelanggan.php');
    } else {
        header('location:index.php', 'Gagal menambahkan data');
    }
}   

//update pelanggan
if (isset($_POST['updatepg'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $updatepelanggan = mysqli_query($conn, "UPDATE pelanggan SET nama='$nama', telepon='$telepon', alamat='$alamat' WHERE id_pelanggan='$id_pelanggan'");

    if ($updatepelanggan) {
        header('location:pelanggan.php');
    } else {
        header('location:index.php?error=update_failed');
    }
}

//hapus pelanggan
if (isset($_POST['deletepg'])) {
    $id_pelanggan = $_POST['id_pelanggan'];

    $deletepelanggan = mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

    if ($deletepelanggan) {
        header('location:pelanggan.php');
    } else {
        header('location:index.php?error=delete_failed');
    }
}

// Fetch data
$kurirResult = mysqli_query($conn, "SELECT id_kurir, nama FROM kurir");
if (!$kurirResult) {
    die("Gagal: " . mysqli_error($conn));
}

$pelangganResult = mysqli_query($conn, "SELECT id_pelanggan, nama FROM pelanggan");
if (!$pelangganResult) {
    die("Gagal: " . mysqli_error($conn));
}

$barangResult = mysqli_query($conn, "SELECT id_barang, nama FROM barang");
if (!$barangResult) {
    die("Gagal: " . mysqli_error($conn));
}

// Memproses form pengiriman
if (isset($_POST['addnewpgrm'])) {
    $id_pengiriman = $_POST['id_pengiriman'];
    $tanggal = $_POST['tanggal'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_kurir = $_POST['id_kurir'];
    $penerima = $_POST['penerima'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $berat_barang = $_POST['berat'];
    $jenis_pengiriman = $_POST['jenisPengiriman'];  // Corrected to match HTML name attribute
    $kategori_pengiriman = $_POST['kategoriPengiriman'];  // Corrected to match HTML name attribute
    $barang = $_POST['barang'];
    $no_kendaraan = $_POST['no_kendaraan'];
    $status = 'terkirim';
     
    // hitung total harga
    $harga_per_kg = 0;
    switch($jenis_pengiriman) {
        case 'Regular':
            $harga_per_kg = 10000;
            break;
        case 'YES':
            $harga_per_kg = 15000;
            break;
        case 'OKE':
            $harga_per_kg = 8000;
            break;
        case 'SPS':
            $harga_per_kg = 20000;
            break;
        case 'COD':
            $harga_per_kg = 12000;
            break;
        case 'International':
            $harga_per_kg = 50000;
            break;
    }
    $total_harga = $berat_barang * $harga_per_kg;

    $addtopengiriman = "INSERT INTO pengiriman (id_pengiriman, tanggal, id_pelanggan, id_kurir, Penerima, AlamatTujuan, BeratBarang, JenisPengiriman, TotalHarga, KategoriPengiriman, Barang, no_kendaraan, status)
                        VALUES ('$id_pengiriman', '$tanggal', '$id_pelanggan', '$id_kurir', '$penerima', '$alamat_tujuan', '$berat_barang', '$jenis_pengiriman', '$total_harga', '$kategori_pengiriman', '$barang', '$no_kendaraan', '$status')";

    if (mysqli_query($conn, $addtopengiriman)) {
        header('Location: pengiriman.php');
        exit;
    } else {
        echo "Error: " . $addtopengiriman . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['updatepgrm'])) {  // Update the button name for update operation
    $id_pengiriman = $_POST['id_pengiriman'];
    $tanggal = $_POST['tanggal'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_kurir = $_POST['id_kurir'];
    $penerima = $_POST['penerima'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $berat_barang = $_POST['berat'];
    $jenis_pengiriman = $_POST['jenisPengiriman'];
    $kategori_pengiriman = $_POST['kategoriPengiriman'];
    $barang = $_POST['barang'];
    $no_kendaraan = $_POST['no_kendaraan'];
    $status = 'terkirim';

    // hitung total harga
    $harga_per_kg = 0;
    switch ($jenis_pengiriman) {
        case 'Regular':
            $harga_per_kg = 10000;
            break;
        case 'YES':
            $harga_per_kg = 15000;
            break;
        case 'OKE':
            $harga_per_kg = 8000;
            break;
        case 'SPS':
            $harga_per_kg = 20000;
            break;
        case 'COD':
            $harga_per_kg = 12000;
            break;
        case 'International':
            $harga_per_kg = 50000;
            break;
    }
    $total_harga = $berat_barang * $harga_per_kg;

    $updatepengiriman = "UPDATE pengiriman SET
                            tanggal = '$tanggal',
                            id_pelanggan = '$id_pelanggan',
                            id_kurir = '$id_kurir',
                            Penerima = '$penerima',
                            AlamatTujuan = '$alamat_tujuan',
                            BeratBarang = '$berat_barang',
                            JenisPengiriman = '$jenis_pengiriman',
                            TotalHarga = '$total_harga',
                            KategoriPengiriman = '$kategori_pengiriman',
                            Barang = '$barang',
                            no_kendaraan = '$no_kendaraan',
                            status = '$status'
                        WHERE id_pengiriman = '$id_pengiriman'";

    if (mysqli_query($conn, $updatepengiriman)) {
        header('Location: pengiriman.php');
        exit;
    } else {
        echo "Error: " . $updatepengiriman . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['deletepgrm'])) {
    $id_pengiriman = $_POST['id_pengiriman'];

    // Delete query
    $deletepengiriman = mysqli_query($conn, "DELETE FROM pengiriman WHERE id_pengiriman = '$id_pengiriman'");

    if ($deletepengiriman) {
        header('location:pengiriman.php');
    } else {
        header('location:pengiriman.php?error=delete_failed');
    }
}

$pelangganQuery = mysqli_query($conn, "SELECT id_pelanggan, nama FROM pelanggan");
// Fetch kurir data
$kurirQuery = mysqli_query($conn, "SELECT id_kurir, nama FROM kurir");

?>