<?php
require 'koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['register'])) {
    // Collect user input
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hashing the password using md5 (not recommended for production)

    // Insert into user table
    $queryUser = "INSERT INTO user (first_name, last_name, email, password, role) 
                  VALUES (?, '', ?, ?, 'pelanggan')";
    $stmtUser = mysqli_prepare($conn, $queryUser);
    mysqli_stmt_bind_param($stmtUser, 'sss', $nama, $email, $password);

    if (mysqli_stmt_execute($stmtUser)) {
        // Retrieve the inserted user's id
        $id_user = mysqli_insert_id($conn);

        // Insert into pelanggan table
        $queryPelanggan = "INSERT INTO pelanggan (id_user, nama, telepon, alamat) 
                           VALUES (?, ?, ?, ?)";
        $stmtPelanggan = mysqli_prepare($conn, $queryPelanggan);
        mysqli_stmt_bind_param($stmtPelanggan, 'isss', $id_user, $nama, $telepon, $alamat);

        if (mysqli_stmt_execute($stmtPelanggan)) {
            // Set session variables
            $_SESSION['id_user'] = $id_user;
            $_SESSION['id_pelanggan'] = mysqli_insert_id($conn); // Assuming id_pelanggan is auto-increment
            $_SESSION['email'] = $email;
            $_SESSION['role'] = 'pelanggan';

            // Redirect to pelanggan_dashboard.php or wherever appropriate
            header('Location: pelanggan_dashboard.php');
            exit();
        } else {
            // Handle pelanggan table insertion error
            echo "Error inserting into pelanggan table: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmtPelanggan);
    } else {
        // Handle user table insertion error
        echo "Error inserting into user table: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmtUser);
} else {
    // Redirect back to register.php if form not submitted
    header('Location: register.php');
    exit();
}
?>
