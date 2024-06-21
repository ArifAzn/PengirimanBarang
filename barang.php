<!-- index.php -->
<?php include 'header.php'; ?>
    <!-- content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="breadcrumb-container">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Dashboard</a></li>
                        <li>Barang</li>
                    </ul>
                </div>

                <div class="container-fluid px-4">
                <header  class="text-center my-4"><h1 class="heading">Input Data Barang</h1></header>

                <div class="card mb-4">
                    <div class="card-header navbar-dark bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Data Barang</h5>
                            <div>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-plus"></i> Tambah</button>
                                <a href="export_barang.php" class="btn btn-info"><i class="fas fa-download"></i> Export Data</a>
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
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Quantity</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambilsemuadata = mysqli_query($conn, "SELECT * FROM barang");
                                    while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                        $id_barang = $data['id_barang'];
                                        $nama_barang = $data['nama_barang'];
                                        $qty = $data['qty'];
                                        $deskripsi = $data['deskripsi'];
                                    ?>
                                    <tr>
                                        <td><?php echo $id_barang; ?></td>
                                        <td><?php echo $nama_barang; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $deskripsi; ?></td>
                                        <td>
                                
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $id_barang; ?>"><i class="fas fa-edit"></i> Edit</button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_barang; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                                        </td>
                                    </tr>

                                                
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal<?php echo $id_barang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="koneksi.php">
                                                        <input type="hidden" name="action" value="update_barang">
                                                        <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>">

                                                        <div class="mb-3">
                                                            <label for="namaBarangInput<?php echo $id_barang; ?>" class="form-label">Nama Barang</label>
                                                            <input type="text" name="nama_barang" id="namaBarangInput<?php echo $id_barang; ?>" class="form-control" value="<?php echo $nama_barang; ?>" required>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label for="quantityInput<?php echo $id_barang; ?>" class="form-label">Quantity</label>
                                                            <input type="number" name="qty" id="quantityInput<?php echo $id_barang; ?>" class="form-control" value="<?php echo $qty; ?>" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="deskripsi<?php echo $id_barang; ?>" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" id="deskripsi<?php echo $id_barang; ?>" name="deskripsi" required><?php echo $deskripsi; ?></textarea>
                                                        </div>

                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-primary" name="updatebr">
                                                                <i class="fas fa-save"></i> Simpan
                                                            </button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fas fa-times"></i> Tutup
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $id_barang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST">
                                                        <div class="text-center">
                                                            <p>Apakah anda yakin ingin menghapus <strong><?php echo $nama_barang; ?></strong>?</p>
                                                            <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>">
                                                            <div class="text-end">
                                                                <button type="submit" class="btn btn-danger" name="deletebr">
                                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                                </button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="fas fa-times"></i> Batal
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
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

    <!-- Tambah Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <form method="POST" action="koneksi.php">
                    <div class="modal-body">
                        <!-- ID Barang (Hidden) -->
                        <div class="mb-3">
                            <label for="idBarangInput" class="form-label">ID Barang</label>
                            <input type="text" name="id_barang" id="idBarangInput" class="form-control" disabled>
                            <script>
                                // Fetch next ID for id_barang
                                fetch('fetch_id.php?field=id_barang')
                                    .then(response => response.json())
                                    .then(data => {
                                        if (!data.error) {
                                            document.getElementById('idBarangInput').value = data.nextId;
                                        } else {
                                            console.error('Error fetching next ID:', data.error);
                                        }
                                    })
                                    .catch(error => console.error('Error fetching next ID:', error));
                            </script>
                        </div>

                        <!-- Nama Barang -->
                        <div class="mb-3">
                            <label for="namaBarangInput" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" id="namaBarangInput" class="form-control" placeholder="Nama Barang" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantityInput" class="form-label">Quantity</label>
                            <input type="number" name="qty" id="quantityInput" class="form-control" placeholder="Quantity" required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsiInput" class="form-label">Deskripsi</label>
                            <textarea type="text" name="deskripsi" id="deskripsiInput" class="form-control" placeholder="Deskripsi" required></textarea>
                        </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="addnewbr">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Tutup
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    </body>
</html>