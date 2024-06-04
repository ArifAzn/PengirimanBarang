<?php
    require 'koneksi.php';
    require 'cek.php';
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pengiriman</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">JNE</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Halaman
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="barang.php">Barang</a>
                                    <a class="nav-link" href="pelanggan.php">Pelanggan</a>
                                    <a class="nav-link" href="kurir.php">Kurir</a>
                                    <a class="nav-link" href="user.php">User</a>
                                </nav>
                            </div>
                                <a class="nav-link" href="pengiriman.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                    Pengiriman
                                </a>
                            <a class="nav-link" href="logout.php">Logout</a>  
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pengiriman</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"> Data Proses Pengiriman</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Tambah</button>
                                <a href="export_pengiriman.php" class="btn btn-info">Export Data</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-bordered">
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
                                            <th>Total Harga </th>
                                            <th>No Kendaraan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
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
                                    <td>
                                        <?php if ($status == 'terkirim') { ?>
                                            <span class="badge bg-success"><?php echo $status; ?></span>
                                        <?php } else { ?>
                                            <?php echo $status; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $id_pengiriman; ?>">Edit</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_pengiriman; ?>">Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $id_pengiriman; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $id_pengiriman; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteModalLabel<?php echo $id_pengiriman; ?>">Hapus Pengiriman</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus pengiriman ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="koneksi.php">
                                                    <input type="hidden" name="id_pengiriman" value="<?php echo $id_pengiriman; ?>">
                                                    <button type="submit" class="btn btn-danger" name="deletepgrm">Hapus</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Update Modal -->
                                <div class="modal fade" id="updateModal<?php echo $id_pengiriman; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title" id="updateModalLabel<?php echo $id_pengiriman; ?>">Update Pengiriman</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="koneksi.php">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_pengiriman" value="<?php echo $id_pengiriman; ?>">
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="tanggal<?php echo $id_pengiriman; ?>" class="form-label">Tanggal</label>
                                                            <input type="date" class="form-control" id="tanggal<?php echo $id_pengiriman; ?>" name="tanggal" value="<?php echo $tanggal; ?>" required>
                                                        </div>
                                                        <input type="hidden" id="id_kurir<?php echo $id_pengiriman; ?>" name="id_kurir" value="<?php echo $id_kurir; ?>">
                                                        <input type="hidden" id="id_pelanggan<?php echo $id_pengiriman; ?>" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>">
                                                        <input type="hidden" id="id_barang<?php echo $id_pengiriman; ?>" name="id_barang" value="<?php echo $id_barang; ?>">
                                                    <div class="mb-3">
                                                        <label for="penerima<?php echo $id_pengiriman; ?>" class="form-label">Penerima</label>
                                                        <input type="text" class="form-control" id="penerima<?php echo $id_pengiriman; ?>" name="penerima" value="<?php echo $penerima; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="alamat_tujuan<?php echo $id_pengiriman; ?>" class="form-label">Alamat Tujuan</label>
                                                        <textarea class="form-control" id="alamat_tujuan<?php echo $id_pengiriman; ?>" name="alamat_tujuan" rows="3" required><?php echo $alamat_tujuan; ?></textarea>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="jenisPengiriman_update<?php echo $id_pengiriman; ?>" class="form-label">Jenis Pengiriman</label>
                                                            <select class="form-select" id="jenisPengiriman_update<?php echo $id_pengiriman; ?>" name="jenisPengiriman" onchange="calculateTotal_update()" required>
                                                                <option value="" disabled selected>-- Pilih Jenis Pengiriman --</option>
                                                                <option value="Regular" <?php if ($jenis_pengiriman == 'Regular') echo 'selected'; ?>>Regular</option>
                                                                <option value="YES" <?php if ($jenis_pengiriman == 'YES') echo 'selected'; ?>>Yakin Esok Sampai (YES)</option>
                                                                <option value="OKE" <?php if ($jenis_pengiriman == 'OKE') echo 'selected'; ?>>Ongkos Kirim Ekonomis (OKE)</option>
                                                                <option value="SPS" <?php if ($jenis_pengiriman == 'SPS') echo 'selected'; ?>>Super Speed (SPS)</option>
                                                                <option value="COD" <?php if ($jenis_pengiriman == 'COD') echo 'selected'; ?>>Cash on Delivery (COD)</option>
                                                                <option value="International" <?php if ($jenis_pengiriman == 'International') echo 'selected'; ?>>International</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="kategoriPengiriman<?php echo $id_pengiriman; ?>" class="form-label">Kategori Pengiriman</label>
                                                            <select class="form-select" id="kategoriPengiriman<?php echo $id_pengiriman; ?>" name="kategoriPengiriman" required>
                                                                <option value="" disabled selected>-- Pilih Kategori Pengiriman --</option>
                                                                <option value="Box" <?php if ($kategori_pengiriman == 'Box') echo 'selected'; ?>>Box</option>
                                                                <option value="Pallet" <?php if ($kategori_pengiriman == 'Pallet') echo 'selected'; ?>>Pallet</option>
                                                                <option value="Bag" <?php if ($kategori_pengiriman == 'Bag') echo 'selected'; ?>>Bag</option>
                                                                <option value="Parcel" <?php if ($kategori_pengiriman == 'Parcel') echo 'selected'; ?>>Parcel</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="berat_update<?php echo $id_pengiriman; ?>" class="form-label">Berat Barang (kg)</label>
                                                            <input type="number" class="form-control" id="berat_update<?php echo $id_pengiriman; ?>" name="berat" value="<?php echo $berat_barang; ?>" required oninput="calculateTotal_update(<?php echo $id_pengiriman; ?>)">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="totalHarga_update<?php echo $id_pengiriman; ?>" class="form-label">Total Harga (Rp)</label>
                                                            <input type="text" class="form-control" id="totalHarga_update<?php echo $id_pengiriman; ?>" value="<?php echo $total_harga; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="no_kendaraan<?php echo $id_pengiriman; ?>" class="form-label">No Kendaraan</label>
                                                        <input type="text" class="form-control" id="no_kendaraan<?php echo $id_pengiriman; ?>" name="no_kendaraan" value="<?php echo $no_kendaraan; ?>" required>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-warning" name="updatepgrm">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Pelanggan -->
<div class="modal fade" id="pelangganModal" tabindex="-1" aria-labelledby="pelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="pelangganModalLabel">Data Pengiriman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>ID Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($pelangganQuery)) { ?>
                            <tr>
                                <td><?php echo $row['id_pelanggan']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary" onclick="selectPelanggan('<?php echo $row['id_pelanggan']; ?>', '<?php echo $row['nama']; ?>')">Pilih</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kurir -->
<div class="modal fade" id="kurirModal" tabindex="-1" aria-labelledby="kurirModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="kurirModalLabel">Pilih Kurir</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>ID Kurir</th>
                            <th>Nama Kurir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($kurirQuery)) { ?>
                            <tr>
                                <td><?php echo $row['id_kurir']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary" onclick="selectKurir('<?php echo $row['id_kurir']; ?>', '<?php echo $row['nama']; ?>')">Pilih</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Barang -->
<div class="modal fade" id="barangModal" tabindex="-1" aria-labelledby="barangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="barangModalLabel">Pilih Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($barangQuery)) { ?>
                            <tr>
                                <td><?php echo $row['id_barang']; ?></td>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary" onclick="selectBarang('<?php echo $row['id_barang']; ?>', '<?php echo $row['nama_barang']; ?>')">Pilih</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Pengiriman Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-shipping-fast"></i> Tambah Pengiriman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="koneksi.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="idPengirimanInput" class="form-label">ID Pengiriman</label>
                            <input type="text" class="form-control" id="idPengirimanInput" name="id_pengiriman" readonly>
                            <script>
                                fetch('fetch_id.php?field=id_pengiriman')
                                    .then(response => response.json())
                                    .then(data => {
                                        if (!data.error) {
                                            document.getElementById('idPengirimanInput').value = data.nextId;
                                        } else {
                                            console.error('Error fetching next ID:', data.error);
                                        }
                                    })
                                    .catch(error => console.error('Error fetching next ID:', error));
                            </script>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_pelanggan" class="form-label">Pelanggan</label>
                            <div class="input-group">
                                <input type="hidden" id="id_pelanggan" name="id_pelanggan" required>
                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" readonly>
                                <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#pelangganModal"><i class="fas fa-user"></i> Pilih Pelanggan</button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_kurir" class="form-label">Kurir</label>
                            <div class="input-group">
                                <input type="hidden" id="id_kurir" name="id_kurir" required>
                                <input type="text" class="form-control" id="nama_kurir" name="nama_kurir" readonly>
                                <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#kurirModal"><i class="fas fa-truck"></i> Pilih Kurir</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_barang" class="form-label">Barang</label>
                            <div class="input-group">
                                <input type="hidden" id="id_barang" name="id_barang" required>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                                <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#barangModal"><i class="fas fa-box"></i> Pilih Barang</button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text" class="form-control" id="penerima" name="penerima" placeholder="Nama Penerima" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
                        <textarea class="form-control" id="alamat_tujuan" name="alamat_tujuan" rows="3" placeholder="Alamat Tujuan" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jenisPengiriman" class="form-label">Jenis Pengiriman</label>
                            <select class="form-select" id="jenisPengiriman" name="jenisPengiriman" onchange="calculateTotal()" required>
                                <option value="" disabled selected>-- Pilih Jenis Pengiriman --</option>
                                <option value="Regular">Regular</option>
                                <option value="YES">Yakin Esok Sampai (YES)</option>
                                <option value="OKE">Ongkos Kirim Ekonomis (OKE)</option>
                                <option value="SPS">Super Speed (SPS)</option>
                                <option value="COD">Cash on Delivery (COD)</option>
                                <option value="International">International</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kategoriPengiriman" class="form-label">Kategori Pengiriman</label>
                            <select class="form-select" id="kategoriPengiriman" name="kategoriPengiriman" required>
                                <option value="" disabled selected>-- Pilih Kategori Pengiriman --</option>
                                <option value="Box">Box</option>
                                <option value="Pallet">Pallet</option>
                                <option value="Bag">Bag</option>
                                <option value="Parcel">Parcel</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="berat" class="form-label">Berat Barang (kg)</label>
                            <input type="number" class="form-control" id="berat" name="berat" placeholder="Masukkan berat barang dalam kg" required oninput="calculateTotal()">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="totalHarga" class="form-label">Total Harga (Rp)</label>
                            <input type="text" class="form-control" id="totalHarga" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_kendaraan" class="form-label">No Kendaraan</label>
                        <input type="text" class="form-control" id="no_kendaraan" name="no_kendaraan" placeholder="No Kendaraan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewpgrm"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    //function memanggil id, nama dari tabel pelanggan
    function selectPelanggan(id, nama) {
        document.getElementById('id_pelanggan').value = id;
        document.getElementById('nama_pelanggan').value = nama;
        var pelangganModal = bootstrap.Modal.getInstance(document.getElementById('pelangganModal'));
        pelangganModal.hide();
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    }

    //function memanggil id, nama dari tabel kurir
    function selectKurir(id, nama) {
        document.getElementById('id_kurir').value = id;
        document.getElementById('nama_kurir').value = nama;
        var kurirModal = bootstrap.Modal.getInstance(document.getElementById('kurirModal'));
        kurirModal.hide();
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    }

    function selectBarang(id, nama_barang) {
        document.getElementById('id_barang').value = id;
        document.getElementById('nama_barang').value = nama_barang;
        var barangModal = bootstrap.Modal.getInstance(document.getElementById('barangModal'));
        barangModal.hide();
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    }

    //function harga
     function calculateTotal() {
            const berat = parseFloat(document.getElementById('berat').value) || 0;
            const jenisPengiriman = document.getElementById('jenisPengiriman').value;
            let hargaPerKg = 0;

            switch (jenisPengiriman) {
                case 'Regular':
                    hargaPerKg = 10000;
                    break;
                case 'YES':
                    hargaPerKg = 15000;
                    break;
                case 'OKE':
                    hargaPerKg = 8000;
                    break;
                case 'SPS':
                    hargaPerKg = 20000;
                    break;
                case 'COD':
                    hargaPerKg = 12000;
                    break;
                case 'International':
                    hargaPerKg = 50000;
                    break;
                default:
                    hargaPerKg = 0;
            }

            const totalHarga = berat * hargaPerKg;
            document.getElementById('totalHarga').value = totalHarga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        }

        //function harga_update
        function calculateTotal_update(id_pengiriman) {
            const berat = parseFloat(document.getElementById(`berat_update${id_pengiriman}`).value) || 0;
            const jenisPengiriman = document.getElementById(`jenisPengiriman_update${id_pengiriman}`).value;
            let hargaPerKg = 0;
            switch (jenisPengiriman) {
                case 'Regular':
                    hargaPerKg = 10000;
                    break;
                case 'YES':
                    hargaPerKg = 15000;
                    break;
                case 'OKE':
                    hargaPerKg = 8000;
                    break;
                case 'SPS':
                    hargaPerKg = 20000;
                    break;
                case 'COD':
                    hargaPerKg = 12000;
                    break;
                case 'International':
                    hargaPerKg = 50000;
                    break;
                default:
                    hargaPerKg = 0;
            }

            const totalHarga = berat * hargaPerKg;
            document.getElementById(`totalHarga_update${id_pengiriman}`).value = totalHarga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        }

</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
</html>
