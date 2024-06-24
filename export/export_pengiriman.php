<?php
require '../koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Pengiriman</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
    <h2>Data Pengiriman</h2>
    <h4>(Pengiriman)</h4>
    <div class="data-tables datatable-dark">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>ID Pengiriman</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Kurir</th>
                    <th>Barang</th>
                    <th>Penerima</th>
                    <th>Alamat Tujuan</th>
                    <th>Kategori Pengiriman</th>
                    <th>Jenis Pengiriman</th>
                    <th>Berat Barang (Kg)</th>
                    <th>Total Harga</th>
                    <th>No Kendaraan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM pengiriman");
                while ($data = mysqli_fetch_assoc($ambilsemuadata)) {
                    $id_pengiriman = $data['id_pengiriman'];
                    $tanggal = $data['tanggal'];
                    $id_pelanggan = $data['id_pelanggan'];
                    $id_kurir = $data['id_kurir'];
                    $id_barang = $data['id_barang'];
                    $penerima = $data['Penerima'];
                    $alamat_tujuan = $data['AlamatTujuan'];
                    $kategori_pengiriman = $data['KategoriPengiriman'];
                    $jenis_pengiriman = $data['JenisPengiriman'];
                    $berat_barang = $data['BeratBarang'];
                    $total_harga = $data['TotalHarga'];
                    $no_kendaraan = $data['no_kendaraan'];
                    $status = $data['Status']; 
                ?>
                <tr>
                    <td><?php echo $id_pengiriman; ?></td>
                    <td><?php echo $tanggal; ?></td>
                    <td><?php echo $id_pelanggan; ?></td>
                    <td><?php echo $id_kurir; ?></td>
                    <td><?php echo $id_barang; ?></td>
                    <td><?php echo $penerima; ?></td>
                    <td><?php echo $alamat_tujuan; ?></td>
                    <td><?php echo $kategori_pengiriman; ?></td>
                    <td><?php echo $jenis_pengiriman; ?></td>
                    <td><?php echo $berat_barang; ?></td>
                    <td><?php echo number_format($total_harga, 0, ',', '.'); ?></td>
                    <td><?php echo $no_kendaraan; ?></td>
                    <td><?php echo $status; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#datatablesSimple').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    } );
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>
</html>
