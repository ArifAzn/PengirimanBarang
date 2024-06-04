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
        <title>Barang</title>
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
        <!-- Sidebar Navigation -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Core Section -->
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <!-- Interface Section -->
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
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
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
                        <h1 class="mt-4">Barang</h1>
                        <div class="card mb-4">
                            <div class="card-header navbar-dark bg-dark text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0">Data Barang</h5>
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-plus"></i> Tambah</button>
                                        <a href="export_barang.php" class="btn btn-info"><i class="fas fa-download"></i> Export Data</a>
                                    </div>
                                </div>
                            </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
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
                                $deskripsi = $data['deskripsi'];
                            ?>
                            <tr>
                                <td><?php echo $id_barang; ?></td>
                                <td><?php echo $nama_barang; ?></td>
                                <td><?php echo $deskripsi; ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $id_barang; ?>"><i class="fas fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_barang; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </td>
                            </tr>

                                    <!-- Edit -->
                                    <div class="modal fade" id="editModal<?php echo $id_barang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="koneksi.php">
                                                        <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>">

                                                        <div class="mb-3">
                                                            <label for="namaBarangInput<?php echo $id_barang; ?>" class="form-label">Nama Barang</label>
                                                            <input type="text" name="nama_barang" id="namaBarangInput<?php echo $id_barang; ?>" class="form-control" value="<?php echo $nama_barang; ?>" required>
                                                        </div>
                                                        
                                                        <!-- Deskripsi -->
                                                        <div class="mb-3">
                                                            <label for="deskripsi<?php echo $id_barang; ?>" class="form-label">Alamat Tujuan</label>
                                                            <textarea class="form-control" id="deskripsi<?php echo $id_barang; ?>" name="deskripsi" required><?php echo $deskripsi; ?></textarea>
                                                        </div>
         
                                                        <!-- Submit Button -->
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-warning" name="updatebr">
                                                                <i class="fas fa-save"></i> Simpan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hapus -->
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
                                                            <!-- Submit Button -->
                                                            <button type="submit" class="btn btn-danger" name="deletebr">
                                                                <i class="fas fa-trash-alt"></i> Hapus
                                                            </button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fas fa-times"></i> Batal
                                                            </button>
                                                        </div>
                                                    </form>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

    </body>
</html>