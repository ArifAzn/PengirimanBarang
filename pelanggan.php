<!-- index.php -->
<?php include 'header.php'; ?>
    <!-- content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="breadcrumb-container">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Pelanggans</li>
                    </ul>
                </div>

                <div class="container-fluid px-4">
                <header  class="text-center my-4"><h1 class="heading">Input Data Pelanggan</h1></header>
                <div class="card mb-4">
                    <div class="card-header navbar-dark bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Data Pelanggan</h5>
                            <div>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-plus"></i> Tambah</button>
                                <a href="export_pelanggan.php" class="btn btn-info"><i class="fas fa-download"></i> Export Data</a>
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
                            <th>ID Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $ambilsemuadata = mysqli_query($conn, "SELECT * FROM pelanggan");
                        while ($data = mysqli_fetch_assoc($ambilsemuadata)) {
                            $id_pelanggan = $data['id_pelanggan'];
                            $nama = $data['nama'];
                            $telepon = $data['telepon'];
                            $alamat = $data['alamat'];
                        ?>
                        <tr>
                            <td><?php echo $id_pelanggan; ?></td>
                            <td><?php echo $nama; ?></td>
                            <td><?php echo $telepon; ?></td>
                            <td><?php echo $alamat; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $id_pelanggan; ?>"><i class="fas fa-edit"></i> Edit</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_pelanggan; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </td>
                        </tr>

                        <!-- Update -->
                        <div class="modal fade" id="updateModal<?php echo $id_pelanggan; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title" id="updateModalLabel">Update Pelanggan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="koneksi.php">
                                        <div class="modal-body">
                                            <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>">
                                            <div class="mb-3">
                                                <label for="namaPelangganInput<?php echo $id_pelanggan; ?>" class="form-label">Nama</label>
                                                <input type="text" name="nama" id="namaPelangganInput<?php echo $id_pelanggan; ?>" class="form-control" value="<?php echo $nama; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="teleponInput<?php echo $id_pelanggan; ?>" class="form-label">Telepon</label>
                                                <input type="text" name="telepon" id="teleponInput<?php echo $id_pelanggan; ?>" class="form-control" value="<?php echo $telepon; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamatInput<?php echo $id_pelanggan; ?>" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamatInput<?php echo $id_pelanggan; ?>" name="alamat" required><?php echo $alamat; ?></textarea>
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                                        <button type="submit" class="btn btn-warning" name="updatepg"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Hapus -->
                        <div class="modal fade" id="deleteModal<?php echo $id_pelanggan; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Pelanggan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus <strong><?php echo $nama; ?></strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="koneksi.php">
                                            <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>">
                                            <button type="submit" class="btn btn-danger" name="deletepg">Hapus</button>
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
            </main>
        </div>

        <!-- Tambah Pelanggan Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-arrow-right-to-bracket"></i> Tambah Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <form method="POST" action="koneksi.php">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="idPelangganInput" class="form-label">ID Pelanggan</label>
                                <input type="text" name="id_pelanggan" id="idPelangganInput" class="form-control" disabled>
                                <script>
                                    // Fetch next ID for id_pelanggan
                                    fetch('fetch_id.php?field=id_pelanggan')
                                        .then(response => response.json())
                                        .then(data => {
                                            if (!data.error) {
                                                document.getElementById('idPelangganInput').value = data.nextId;
                                            } else {
                                                console.error('Error:', data.error);
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                </script>
                            </div>

                            <div class="mb-3">
                                <label for="namaInput" class="form-label">Nama Pelanggan</label>
                                <input type="text" name="nama" id="namaInput" class="form-control" placeholder="Nama Pelanggan" required>
                            </div>

                            <div class="mb-3">
                                <label for="teleponInput" class="form-label">Nomor Telepon</label>
                                <input type="text" name="telepon" id="teleponInput" class="form-control" placeholder="Telepon" required>
                            </div>

                            <div class="mb-3">
                                <label for="alamatInput" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="addnewpg">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
