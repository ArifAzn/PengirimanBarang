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
        <title>User</title>
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
                        <h1 class="mt-4">Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Tambah</button>

                            </div>

                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-bordered">

                                    <thead>
                                        <tr>
                                            <th>ID User</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                         <?php
                                        $ambilsemuadata = mysqli_query($conn, "SELECT * FROM user");
                                        while ($data = mysqli_fetch_assoc($ambilsemuadata)) {
                                            $id_user = $data['id_user'];
                                            $email = $data['email'];
                                            $password = $data['password'];
                                        ?>
                                        <tr>
                                            <td><?php echo $id_user; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $password; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $id_user; ?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_user; ?>">Hapus</button>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?php echo $id_user; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus <strong><?php echo $email; ?></strong>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="koneksi.php">
                                                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                            <button type="submit" class="btn btn-danger" name="deleteus">Hapus</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Update Modal -->
                                        <div class="modal fade" id="updateModal<?php echo $id_user; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-white">
                                                        <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="koneksi.php">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                            <div class="mb-3">
                                                                <label for="updateEmailInput<?php echo $id_user; ?>" class="form-label">Email Address</label>
                                                                <input type="email" name="email" id="updateEmailInput<?php echo $id_user; ?>" class="form-control" value="<?php echo $email; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="updatePasswordInput<?php echo $id_user; ?>" class="form-label">Password</label>
                                                                <input type="password" name="password" id="updatePasswordInput<?php echo $id_user; ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-warning" name="updateus">Update</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <?php }?>

<!-- Tambah User Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <form method="POST" action="koneksi.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="idUserInput" class="form-label">ID User</label>
                        <input type="text" name="id_user" id="idUserInput" class="form-control" disabled>
                        <script>
                            // Fetch ID id_barang
                            fetch('fetch_id.php?field=id_user')
                                .then(response => response.json())
                                .then(data => {
                                    if (!data.error) {
                                        document.getElementById('idUserInput').value = data.nextId;
                                    } else {
                                        console.error('Error:', data.error);
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        </script>
                    </div>

                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email Address</label>
                        <input type="email" name="email" id="emailInput" class="form-control" placeholder="Alamat Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Password</label>
                        <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewus">Simpan</button>
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
