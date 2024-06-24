<!-- index.php -->
<?php include 'header.php'; ?>
    <!-- content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="breadcrumb-container">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Kurir</li>
                    </ul>
                </div>

                    <div class="container-fluid px-4">
                    <header  class="text-center my-4"><h1 class="heading">Input Data Kurir</h1></header>

                    <div class="card mb-4">
                        <div class="card-header navbar-dark bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Data Kurir</h5>
                                <div>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-plus"></i> Tambah</button>
                                    <a href="export/export_kurir.php" class="btn btn-info"><i class="fas fa-download"></i> Export Data</a>
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
                                                    <th>ID Kurir</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Nomor Telepon</th>
                                                    <th>Alamat</th>
                                                    <th>Plat Nomor</th>
                                                    <th>Jenis Kendaraan</th>
                                                    <th>Jadwal</th>
                                                    <th>Aksi</th>
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
                                                    $plat_nomor = $data['plat_nomor'];
                                                    $jenis_kendaraan = $data['jenis_kendaraan'];
                                                    $jadwal = $data['jadwal_kerja'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $id_kurir; ?></td>
                                                        <td><?php echo $nama; ?></td>
                                                        <td><?php echo $jenis_kelamin; ?></td>
                                                        <td><?php echo $telepon; ?></td>
                                                        <td><?php echo $alamat; ?></td>
                                                        <td><?php echo $plat_nomor; ?></td>
                                                        <td><?php echo $jenis_kendaraan; ?></td>
                                                        <td><?php echo $jadwal; ?></td>

                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $id_kurir; ?>"><i class="fas fa-edit"></i> Edit</button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_kurir; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                    </td>
                                                </tr>
                                                
                                        <!-- Edit -->
                                        <div class="modal fade" id="updateModal<?php echo $id_kurir; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-warning text-white">
                                                        <h5 class="modal-title" id="updateModalLabel">Update Kurir</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- Modal Body -->
                                                    <form method="POST" action="koneksi.php">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_kurir" value="<?php echo $id_kurir; ?>">
                                                            <div class="mb-3">
                                                                <label for="namaKurirInput<?php echo $id_kurir; ?>" class="form-label">Nama</label>
                                                                <input type="text" name="nama" id="namaInput<?php echo $id_kurir; ?>" class="form-control" value="<?php echo $nama; ?>" placeholder="Nama Kurir" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jenisKelaminInput<?php echo $id_kurir; ?>" class="form-label">Jenis Kelamin</label>
                                                                <select class="form-select" id="jenisKelaminInput<?php echo $id_kurir; ?>" name="jenis_kelamin" required>
                                                                    <option value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                                                    <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="teleponInput<?php echo $id_kurir; ?>" class="form-label">Nomor Telepon</label>
                                                                <input type="text" name="telepon" id="teleponInput<?php echo $id_kurir; ?>" class="form-control" value="<?php echo $telepon; ?>" placeholder="Nomor Telepon" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="alamatInput<?php echo $id_kurir; ?>" class="form-label">Alamat</label>
                                                                <textarea class="form-control" id="alamatInput<?php echo $id_kurir; ?>" name="alamat" placeholder="Alamat" required><?php echo $alamat; ?></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jenisKendaraanInput<?php echo $id_kurir; ?>" class="form-label">Jenis Kendaraan</label>
                                                                <select class="form-select" id="jenisKendaraanInput<?php echo $id_kurir; ?>" name="jenis_kendaraan" required>
                                                                    <option value="" disabled selected>-- Pilih Jenis Kendaraan --</option>
                                                                    <option value="Motor" <?php if ($jenis_kendaraan == 'Motor') echo 'selected'; ?>>Motor</option>
                                                                    <option value="Mobil" <?php if ($jenis_kendaraan == 'Mobil') echo 'selected'; ?>>Mobil</option>
                                                                    <option value="Truk" <?php if ($jenis_kendaraan == 'Truk') echo 'selected'; ?>>Truk</option>
                                                                </select>
                                                            </div>
                                                            <!-- Tambahkan elemen input untuk plat_nomor -->
                                                            <div class="mb-3">
                                                                <label for="platNomorInput<?php echo $id_kurir; ?>" class="form-label">Plat Nomor</label>
                                                                <input type="text" name="plat_nomor" id="platNomorInput<?php echo $id_kurir; ?>" class="form-control" value="<?php echo $plat_nomor; ?>" placeholder="Plat Nomor" required>
                                                            </div>
                                                            <!-- Tambahkan elemen input untuk jadwal_kerja -->
                                                        <div class="mb-3">
                                                            <label for="jadwalKerjaInput<?php echo $id_kurir; ?>" class="form-label">Jadwal Kerja</label>
                                                            <select class="form-select" id="jadwalKerjaInput<?php echo $id_kurir; ?>" name="jadwal_kerja" required>
                                                                <option value="" disabled selected>-- Pilih Jadwal Kerja --</option>
                                                                <option value="Pagi" <?php if ($jadwal == 'Pagi') echo 'selected'; ?>>Pagi (08:00 - 12:00)</option>
                                                                <option value="Siang" <?php if ($jadwal == 'Siang') echo 'selected'; ?>>Siang (12:00 - 16:00)</option>
                                                                <option value="Sore" <?php if ($jadwal == 'Sore') echo 'selected'; ?>>Sore (16:00 - 20:00)</option>
                                                                <option value="Malam <?php if ($jadwal == 'Malam') echo 'selected'; ?>">Malam (20:00 - 00:00)</option>
                                                            </select>
                                                        </div>

                                                        </div>
                                                        <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                                                        <button type="submit" class="btn btn-warning" name="updatekr"><i class="fas fa-save"></i> Simpan</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hapus -->
                                        <div class="modal fade" id="deleteModal<?php echo $id_kurir; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Kurir</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus <strong><?php echo $nama; ?></strong>?</p>
                                                    </div>
                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <form method="POST" action="koneksi.php">
                                                            <input type="hidden" name="id_kurir" value="<?php echo $id_kurir; ?>">
                                                            <button type="submit" class="btn btn-danger" name="deletekr">Hapus</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

       <!-- Tambah -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-arrow-right-to-bracket"></i> Tambah Kurir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="koneksi.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="idKurirInput" class="form-label">ID Kurir</label>
                        <input type="number" name="id_kurir" id="idKurirInput" class="form-control" disabled>
                        <script>
                            // Fetch next ID for id_kurir
                            fetch('fetch_id.php?field=id_kurir')
                                .then(response => response.json())
                                .then(data => {
                                    if (!data.error) {
                                        document.getElementById('idKurirInput').value = data.nextId;
                                    } else {
                                        console.error('Error:', data.error);
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        </script>
                    </div>

                    <div class="mb-3">
                        <label for="namaKurirInput" class="form-label">Nama</label>
                        <input type="text" name="nama" id="namaKurirInput" class="form-control" placeholder="Nama Kurir" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenisKelaminInput" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenisKelaminInput" name="jenis_kelamin" required>
                            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nomorTeleponInput" class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" id="nomorTeleponInput" class="form-control" placeholder="Nomor Telepon" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamatInput" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamatInput" name="alamat" placeholder="Alamat" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="jenisKendaraanInput" class="form-label">Jenis Kendaraan</label>
                        <select class="form-select" id="jenisKendaraanInput" name="jenis_kendaraan" required>
                            <option value="" disabled selected>-- Pilih Jenis Kendaraan --</option>
                            <option value="Motor">Motor</option>
                            <option value="Mobil">Mobil</option>
                            <option value="Truk">Truk</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="platNomorInput" class="form-label">Nomor Plat Kendaraan</label>
                        <input type="text" name="plat_nomor" id="platNomorInput" class="form-control" placeholder="Nomor Plat Kendaraan" required>
                    </div>

                    <div class="mb-3">
                        <label for="jadwalKerjaInput" class="form-label">Jadwal Kerja</label>
                        <select class="form-select" id="jadwalKerjaInput" name="jadwal_kerja" required>
                            <option value="" disabled selected>-- Pilih Jadwal Kerja --</option>
                            <option value="Pagi">Pagi (08:00 - 12:00)</option>
                            <option value="Siang">Siang (12:00 - 16:00)</option>
                            <option value="Sore">Sore (16:00 - 20:00)</option>
                            <option value="Malam">Malam (20:00 - 00:00)</option>
                        </select>
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewkr">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
  $(".loading-overlay").fadeIn(500); // Fade in the overlay with a 500ms animation
});

// Hide the loading overlay when the page is fully loaded
$(window).on('load', function() {
  setTimeout(function() {
    $(".loading-overlay").fadeOut(500); // Fade out the overlay with a 500ms animation
  }, 100); // Add a 2-second delay to ensure all resources are loaded
});
</script>
    
    <?php include 'footer.php'; ?>
    </body>
</html>