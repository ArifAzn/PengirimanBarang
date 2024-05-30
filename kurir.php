<?php
    require 'koneksi.php';
    require 'cek.php';
    require 'fetch_kategori.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kurir</title>
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
                                    <a class="nav-link" href="kurir.php">Kurir</a>
                                    <a class="nav-link" href="pelanggan.php">Pelanggan</a>
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
                        <h1 class="mt-4">Kurir</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Kurir</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Tambah</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">

                                    <thead>
                                        <tr>
                                            <th>ID Kurir</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor Telepon</th>
                                            <th>Alamat</th>
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
                                        ?>
                                        <tr>
                                            <td><?php echo $id_kurir; ?></td>
                                            <td><?php echo $nama; ?></td>
                                            <td><?php echo $jenis_kelamin; ?></td>
                                            <td><?php echo $telepon; ?></td>
                                            <td><?php echo $alamat; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $id_kurir; ?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_kurir; ?>">Hapus</button>
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
                                                        </div>
                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-warning" name="updatekr">Simpan</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                                                        <p>Apakah Anda yakin ingin menghapus kurir ini?</p>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kurir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="koneksi.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="idKurirInput" class="form-label">ID Kurir</label>
                            <input type="text" name="id_kurir" id="idKurirInput" class="form-control" disabled>
                            <script>
                                // Fetch next ID for id_barang
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
                            <input type="text" name="nama" id="namaInput" class="form-control" placeholder="Nama Kurir" required>
                        </div>

                        <div class="mb-3">
                            <label for="jenisKelaminInput" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenisKelaminInput" name="jenis_kelamin" required>
                               <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nomorTeleponInput" class="form-label">Nomor Telepon</label>
                            <input type="text" name="telepon" id="teleponInput" class="form-control" placeholder="Nomor Telepon" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamatInput" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>                        
                        </div>

                        <button type="submit" class="btn btn-primary" name="addnewkr">Simpan</button>
                    </div>
                </form>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
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
