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

//tambah user
if (isset($_POST['addnewus'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $addtouser = mysqli_query($conn, "INSERT INTO user (email, password) VALUES ('$email', '$password')");

    if ($addtouser) {
        header('location:user.php');
    } else {
        // If insertion fails, handle the error (e.g., display a message or log it)
        header('location:index.php?error=insert_failed');
    }
}

//update user
if (isset($_POST['updateus'])) {
    $id_user = $_POST['id_user'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $updateuser = mysqli_query($conn, "UPDATE user SET email = '$email', password = '$password' WHERE id_user = '$id_user'");

    if ($updateuser) {
        header('location:user.php');
    } else {
        // If update fails, handle the error (e.g., display a message or log it)
        header('location:index.php?error=update_failed');
    }
}

//delete user
if (isset($_POST['deleteus'])) {
    $id_user = $_POST['id_user'];

    $deleteuser = mysqli_query($conn, "DELETE FROM user WHERE id_user = '$id_user'");

    if ($deleteuser) {
        header('location:user.php');
    } else {
        // If deletion fails, handle the error (e.g., display a message or log it)
        header('location:index.php?error=delete_failed');
    }
}

if (isset($_POST['addnewbr'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];

    $addtobarang = mysqli_query($conn, "INSERT INTO barang (id_barang, nama_barang, deskripsi) VALUES ('$id_barang', '$nama_barang', '$deskripsi')");

    if ($addtobarang) {
        header('location:barang.php');
    } else {
        echo 'Gagal menambahkan data';
    }
}


// update barang
if (isset($_POST['updatebr'])) {
    // Sanitize input
    $id_barang = mysqli_real_escape_string($conn, $_POST['id_barang']);
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);


    // Update query with id_barang condition
    $update = mysqli_query($conn, "UPDATE barang SET nama_barang='$nama_barang', deskripsi='$deskripsi' WHERE id_barang='$id_barang'");

    if ($update) {
        header('Location: barang.php');
    } else {
        echo 'Gagal mengupdate data: ' . mysqli_error($conn);
    }
}

// hapus barang
if (isset($_POST['deletebr'])) {
    $id_barang = mysqli_real_escape_string($conn, $_POST['id_barang']);

    // Delete query
    $delete = mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id_barang'");

    if ($delete) {
        header('Location: barang.php');
    } else {
        echo 'Gagal menghapus data: ' . mysqli_error($conn);
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

$barangResult = mysqli_query($conn, "SELECT id_barang, nama_barang FROM barang");
if (!$barangResult) {
    die("Gagal: " . mysqli_error($conn));
}

// Memproses form pengiriman
if (isset($_POST['addnewpgrm'])) {
    $id_pengiriman = $_POST['id_pengiriman'];
    $tanggal = $_POST['tanggal'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_kurir = $_POST['id_kurir'];
    $id_barang = $_POST['id_barang'];
    $penerima = $_POST['penerima'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $berat_barang = $_POST['berat'];
    $jenis_pengiriman = $_POST['jenisPengiriman'];
    $kategori_pengiriman = $_POST['kategoriPengiriman'];
    $no_kendaraan = $_POST['no_kendaraan'];
    $status = 'terkirim';

    // Calculate total price
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

    $addtopengiriman = "INSERT INTO pengiriman (id_pengiriman, tanggal, id_pelanggan, id_kurir, id_barang, Penerima, AlamatTujuan, BeratBarang, JenisPengiriman, TotalHarga, KategoriPengiriman, no_kendaraan, status) 
                        VALUES ('$id_pengiriman', '$tanggal', '$id_pelanggan', '$id_kurir', '$id_barang', '$penerima', '$alamat_tujuan', '$berat_barang', '$jenis_pengiriman', '$total_harga', '$kategori_pengiriman', '$no_kendaraan', '$status')";

    if (mysqli_query($conn, $addtopengiriman)) {
        header('Location: pengiriman.php');
        exit;
    } else {
        echo 'Gagal menambahkan data: ' . mysqli_error($conn);
    }
}


if (isset($_POST['updatepgrm'])) {
    $id_pengiriman = $_POST['id_pengiriman'];
    $tanggal = $_POST['tanggal'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_kurir = $_POST['id_kurir'];
    $id_barang = $_POST['id_barang'];
    $penerima = $_POST['penerima'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $berat_barang = $_POST['berat'];
    $jenis_pengiriman = $_POST['jenisPengiriman'];
    $kategori_pengiriman = $_POST['kategoriPengiriman'];
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
                            id_barang = '$id_barang',
                            Penerima = '$penerima',
                            AlamatTujuan = '$alamat_tujuan',
                            BeratBarang = '$berat_barang',
                            JenisPengiriman = '$jenis_pengiriman',
                            TotalHarga = '$total_harga',
                            KategoriPengiriman = '$kategori_pengiriman',
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

// hapus 
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
$kurirQuery = mysqli_query($conn, "SELECT id_kurir, nama FROM kurir");
$barangQuery = mysqli_query($conn, "SELECT id_barang, nama_barang FROM barang");

?>