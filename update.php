<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pengiriman = $_POST['id_pengiriman'];
    $id_kurir = $_POST['kurir'];

    $updateQuery = "UPDATE pengiriman SET id_kurir = '$id_kurir' WHERE id_pengiriman = '$id_pengiriman'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "Kurir updated successfully";
        // Redirect to the page where the table is displayed
        header("Location: pengiriman.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
