<?php
    require 'koneksi.php';
    require 'cek.php';
?>

<!-- index.php -->
<?php include 'header.php'; ?>
    <!-- content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="breadcrumb-container">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Pengiriman</li>
                    </ul>
                </div>
                <div class="container-fluid px-4">
                <header  class="text-center my-4"><h1 class="heading">Input Data Pengiriman</h1></header>

                <div class="card mb-4">
                    <div class="card-header navbar-dark bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Data Pengiriman</h5>
                            <div>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-plus"></i> Tambah</button>
                                <a href="export/export_pengiriman.php" class="btn btn-info"><i class="fas fa-download"></i> Export Data</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php
                        if(isset($_SESSION['status']))
                        { ?>
                            <div class="alert alert-<?php echo $_SESSION['alert_type']; ?> alert-dismissible fade show" role="alert">
                              <strong>✓ Berhasil <?php echo $_SESSION['status']; ?></strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                            unset($_SESSION['alert_type']);
                        } ?>
                        
                        <div class="table-responsive">
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
                                    <td>
                                        <?php if ($status == 'Delivered') { ?>
                                            <span class="badge badge-success"><?php echo $status; ?></span>
                                        <?php } elseif ($status == 'Processed') { ?>
                                            <span class="badge badge-warning"><?php echo $status; ?></span>
                                        <?php } else { ?>
                                            <span class="badge badge-secondary"><?php echo $status; ?></span>
                                        <?php } ?>
                                    </td>                                    
                                    <td>
                                        
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#selectKurirModal" data-id="<?php echo $id_pengiriman; ?>">Pilih Kurir</button>
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

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                                                        <button type="submit" class="btn btn-warning" name="updatepgrm"><i class="fas fa-save"></i> Simpan</button>
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


<!-- Modal -->
<div class="modal fade" id="selectKurirModal" tabindex="-1" role="dialog" aria-labelledby="selectKurirModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="selectKurirModalLabel">Daftar Kurir</h5>
      </div>
      <div class="modal-body">
        <form id="selectKurirForm" method="POST" action="update.php">
          <input type="hidden" name="id_pengiriman" id="id_pengiriman">
          <div class="form-group">
            <select class="form-control" id="kurirSelect" name="kurir">
              <option value="" disabled selected>Pilih Kurir</option>
              <?php
              while ($kurir = mysqli_fetch_assoc($kurirResult)) {
                  echo "<option value='" . $kurir['id_kurir'] . "'>" . $kurir['nama'] . "</option>";
              }
              ?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="selectKurirForm" class="btn btn-success">Simpan</button>
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
                                <input type="text" class="form-control" id="idPengirimanInput" name="id_pengiriman" disabled>
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
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" disabled>
                                    <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#pelangganModal"><i class="fas fa-user"></i> Pilih Pelanggan</button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_kurir" class="form-label">Kurir</label>
                                <div class="input-group">
                                    <input type="hidden" id="id_kurir" name="id_kurir" required>
                                    <input type="text" class="form-control" id="nama_kurir" name="nama_kurir" disabled>
                                    <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#kurirModal"><i class="fas fa-truck"></i> Pilih Kurir</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_barang" class="form-label">Barang</label>
                                <div class="input-group">
                                    <input type="hidden" id="id_barang" name="id_barang" required>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" disabled>
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
  $('#selectKurirModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_pengiriman = button.data('id'); // Extract info from data-* attributes
    var modal = $(this);
    modal.find('.modal-body #id_pengiriman').val(id_pengiriman);
  });

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
    
    <?php include 'footer.php'; ?>
    </body>
</html>
