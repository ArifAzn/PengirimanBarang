<?php
require '../koneksi.php';
?>
<html>
<head>
  <title>Data Kurir</title>
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
			<h2>Data Kurir</h2>
			<h4>(Kurir)</h4>
				<div class="data-tables datatable-dark">
					               <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID Kurir</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor Telepon</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                         <?php
                                        $ambilsemuadata = mysqli_query($conn, "SELECT * FROM kurir");
                                        while ($data = mysqli_fetch_assoc($ambilsemuadata)) {
                                            $id_kurir = $data['id_kurir'];
                                            $nama = $data['nama'];
                                            $jenis_kelamin = $data['jenis_kelamin'];
                                            $telepon = $data['telepon'];
                                            $alamat = $data['alamat'];
                                        ?>
                                        <tr>
                                            <td><?php echo $id_kurir; ?></td>
                                            <td><?php echo $nama; ?></td>
                                            <td><?php echo $jenis_kelamin; ?></td>
                                            <td><?php echo $telepon; ?></td>
                                            <td><?php echo $alamat; ?></td>
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
} );

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