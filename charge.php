<?php
require 'vendor/autoload.php';
require 'cek.php';

// Set your secret key
\Stripe\Stripe::setApiKey('your-sk_test_51PGiXNBmIRRf35Ld178hB7Cfm1RBrKlTYz1gQL4oQvtH4IfKqEWB6DN3vsxZI3vVIfHY5anVV3clj8A119GjVlHM00szDFBHYe-key');

// Retrieve the POST data
$id_barang = $_POST['id_barang'];
$token = $_POST['stripeToken'];

// Get item details from the database
$query = "SELECT * FROM barang WHERE id_barang = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id_barang);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($result);

// Charge the user
try {
    $charge = \Stripe\Charge::create([
        'amount' => $item['qty'] * 100, // Amount in cents
        'currency' => 'usd',
        'description' => $item['nama_barang'],
        'source' => $token,
    ]);

    // Update the database or handle post-payment logic
    // For example, mark the item as paid or update inventory

    // Redirect to a success page
    $_SESSION['status'] = "pembayaran berhasil";
    $_SESSION['alert_type'] = "success";
    header("Location: barang_pelanggan.php");
} catch (\Stripe\Exception\CardException $e) {
    // Handle error
    $_SESSION['status'] = "pembayaran gagal";
    $_SESSION['alert_type'] = "danger";
    echo 'Error: ' . $e->getError()->message;
}
?>
