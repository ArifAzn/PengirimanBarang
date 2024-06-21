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
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $plat_nomor = $_POST['plat_nomor'];
    $jadwal_kerja = $_POST['jadwal_kerja'];

    $addtokurir = mysqli_query($conn, "INSERT INTO kurir (id_kurir, nama, jenis_kelamin, telepon, alamat, jenis_kendaraan, plat_nomor, jadwal_kerja) VALUES ('$id_kurir', '$nama', '$jenis_kelamin', '$telepon', '$alamat', '$jenis_kendaraan', '$plat_nomor', '$jadwal_kerja')");

    // Cek apakah query berhasil
    if ($addtokurir) {
        $_SESSION['status'] = "Menambahkan Kurir";
        $_SESSION['alert_type'] = "success";
        header('location:kurir.php');
    } else {
        echo 'Gagal menambahkan data';
    }
}

//update kurir
if (isset($_POST['updatekr'])) {
    $id_kurir = $_POST['id_kurir'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $plat_nomor = $_POST['plat_nomor'];
    $jadwal_kerja = $_POST['jadwal_kerja'];

    // Perbarui query untuk memasukkan bidang baru
    $updatekurir = mysqli_query($conn, "UPDATE kurir SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', telepon = '$telepon', alamat = '$alamat', jenis_kendaraan = '$jenis_kendaraan', plat_nomor = '$plat_nomor', jadwal_kerja = '$jadwal_kerja' WHERE id_kurir = '$id_kurir'");

    if ($updatekurir) {
        $_SESSION['status'] = "Mengupdate Kurir";
        $_SESSION['alert_type'] = "warning";
        header('location:kurir.php');
    } else {
        echo 'Gagal mengupdate data';
    }
}

//hapus kurir
if (isset($_POST['deletekr'])) {
    $id_kurir = $_POST['id_kurir'];

    $deletekurir = mysqli_query($conn, "DELETE FROM kurir WHERE id_kurir = '$id_kurir'");

    if ($deletekurir) {
        $_SESSION['status'] = "Menghapus Kurir";
        $_SESSION['alert_type'] = "danger";
        header('location:kurir.php');
    } else {
        echo 'Gagal menghapus data';
    }
}

//tambah pelanggan
if (isset($_POST['addnewpg'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    
    // Assuming id_user is obtained from session
    $id_user = $_SESSION['id_user']; // Replace with your actual session variable
    
    // Insert into pelanggan table
    $addtopelanggan = mysqli_query($conn, "INSERT INTO pelanggan (id_pelanggan, id_user, nama, telepon, alamat) 
                                           VALUES ('$id_pelanggan', '$id_user', '$nama', '$telepon', '$alamat')");

    if ($addtopelanggan) {
        $_SESSION['status'] = "Menambahkan Pelanggan";
        $_SESSION['alert_type'] = "success";
        header('location:pelanggan.php');
    } else {
        echo 'Gagal menambahkan data';
    }
}

//update pelanggan
if (isset($_POST['updatepg'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // Update pelanggan table
    $updatepelanggan = mysqli_query($conn, "UPDATE pelanggan 
                                            SET nama='$nama', telepon='$telepon', alamat='$alamat' 
                                            WHERE id_pelanggan='$id_pelanggan'");

    if ($updatepelanggan) {
        $_SESSION['status'] = "Mengupdate Pelanggan";
        $_SESSION['alert_type'] = "warning";
        header('location:pelanggan.php');
    } else {
        echo 'Gagal mengupdate data';
    }
}

//hapus pelanggan
if (isset($_POST['deletepg'])) {
    $id_pelanggan = $_POST['id_pelanggan'];

    // Delete from pelanggan table
    $deletepelanggan = mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

    if ($deletepelanggan) {
        $_SESSION['status'] = "Menghapus Pelanggan";
        $_SESSION['alert_type'] = "danger";
        header('location:pelanggan.php');
    } else {
        echo 'Gagal menghapus data';
    }
}


//tambah user
if (isset($_POST['addnewus'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $adduser = mysqli_query($conn, "INSERT INTO user (first_name, last_name, email, password, role) VALUES ('$first_name', '$last_name', '$email', '$password', '$role')");
    if ($adduser) {
        $_SESSION['status'] = "User berhasil ditambahkan";
        $_SESSION['alert_type'] = "success";
    } else {
        $_SESSION['status'] = "Gagal menambahkan user";
        $_SESSION['alert_type'] = "danger";
    }
    header('Location: user.php');
}

//update user
if (isset($_POST['updateus'])) {
    $id_user = $_POST['id_user'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Get role from form

    $updateuser = mysqli_query($conn, "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', role = '$role' WHERE id_user = '$id_user'");
    if ($updateuser) {
        $_SESSION['status'] = "User berhasil diperbarui";
        $_SESSION['alert_type'] = "warning";
    } else {
        $_SESSION['status'] = "Gagal memperbarui user";
        $_SESSION['alert_type'] = "danger";
    }
    header('Location: user.php');
}

// Delete user
if (isset($_POST['deleteus'])) {
    $id_user = $_POST['id_user'];

    // Delete dependent records in barang first
    $deletebarang = mysqli_query($conn, "DELETE FROM barang WHERE id_user = '$id_user'");
    if ($deletebarang) {
        // Proceed to delete the user
        $deleteuser = mysqli_query($conn, "DELETE FROM user WHERE id_user = '$id_user'");
        if ($deleteuser) {
            $_SESSION['status'] = "User berhasil dihapus";
            $_SESSION['alert_type'] = "danger";
        } else {
            $_SESSION['status'] = "Gagal menghapus user";
            $_SESSION['alert_type'] = "danger";
        }
    } else {
        $_SESSION['status'] = "Gagal menghapus barang yang terkait";
        $_SESSION['alert_type'] = "danger";
    }

    header('Location: user.php');
}

if (isset($_POST['addnewbr'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];
    $id_user = $_SESSION['id_user']; 

    $addtobarang = mysqli_query($conn, "INSERT INTO barang (id_barang, nama_barang, qty, deskripsi, id_user) VALUES ('$id_barang', '$nama_barang', '$qty','$deskripsi', '$id_user')");

    if ($addtobarang) {
        $_SESSION['status'] = "Menambahkan Barang";
        $_SESSION['alert_type'] = "success";
        header('location:barang.php');
    } else {
        echo 'Gagal menambahkan data';
    }
}


// update barang
if (isset($_POST['updatebr'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $qty = $_POST['qty'];
    $deskripsi = $_POST['deskripsi'];

    // Update query with id_barang condition
    $update = mysqli_query($conn, "UPDATE barang SET nama_barang='$nama_barang', qty='$qty', deskripsi='$deskripsi' WHERE id_barang='$id_barang'");

    if ($update) {
         $_SESSION['status'] = "Mengupdate Barang";
         $_SESSION['alert_type'] = "warning";
        header('Location: barang.php');
    } else {
        echo 'Gagal mengupdate data';
    }
}

// hapus barang
if (isset($_POST['deletebr'])) {
    $id_barang = mysqli_real_escape_string($conn, $_POST['id_barang']);

    // Delete query
    $delete = mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id_barang'");

    if ($delete) {
        $_SESSION['status'] = "Menghapus Barang";
        $_SESSION['alert_type'] = "danger";
        header('Location: barang.php');
    } else {
        echo 'Gagal Menghapus data';
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

    $addtopengiriman = "INSERT INTO pengiriman (id_pengiriman, tanggal, id_pelanggan, id_kurir, id_barang, Penerima, AlamatTujuan, BeratBarang, JenisPengiriman, TotalHarga, KategoriPengiriman, status) 
                        VALUES ('$id_pengiriman', '$tanggal', '$id_pelanggan', '$id_kurir', '$id_barang', '$penerima', '$alamat_tujuan', '$berat_barang', '$jenis_pengiriman', '$total_harga', '$kategori_pengiriman', '$status')";

    if (mysqli_query($conn, $addtopengiriman)) {
         $_SESSION['status'] = "Menambahkan Pengiriman";
         $_SESSION['alert_type'] = "success";
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
         $_SESSION['status'] = "Mengupdate Pengiriman";
         $_SESSION['alert_type'] = "warning";
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
        $_SESSION['status'] = "Menghapus Pengiriman";
        $_SESSION['alert_type'] = "danger";
        header('location:pengiriman.php');
    } else {
        header('location:pengiriman.php?error=delete_failed');
    }
}

$pelangganQuery = mysqli_query($conn, "SELECT id_pelanggan, nama FROM pelanggan");
$kurirQuery = mysqli_query($conn, "SELECT id_kurir, nama FROM kurir");
$barangQuery = mysqli_query($conn, "SELECT id_barang, nama_barang FROM barang");

?>