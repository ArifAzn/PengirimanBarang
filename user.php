<!-- index.php -->
<?php include 'header.php'; ?>
    <!-- content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="breadcrumb-container">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Dashboard</a></li>
                        <li>User</li>
                    </ul>
                </div>

                <div class="container-fluid px-4">
                <header  class="text-center my-4"><h1 class="heading">Admin</h1></header>

                <div class="card mb-4">
                    <div class="card-header navbar-dark bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Data User</h5>
                            <div>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-plus"></i> Tambah</button>
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
                        
                        <table id="datatablesSimple" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM user");
                                while ($data = mysqli_fetch_assoc($ambilsemuadata)) {
                                    $id_user = $data['id_user'];
                                    $first_name = $data['first_name'];
                                    $last_name = $data['last_name'];
                                    $email = $data['email'];
                                    $password = $data['password'];
                                    $role = $data['role'];
                                ?>
                                <tr>
                                    <td><?php echo $first_name; ?></td>
                                    <td><?php echo $last_name; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $password; ?></td>
                                    <td><?php echo $role; ?></td>
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
                                                        <label for="frnameInput<?php echo $id_user; ?>" class="form-label">First Name</label>
                                                        <input type="text" name="first_name" id="frnameInput<?php echo $id_user; ?>" class="form-control" value="<?php echo $first_name; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lsnameInput<?php echo $id_user; ?>" class="form-label">Last Name</label>
                                                        <input type="text" name="last_name" id="lsnameInput<?php echo $id_user; ?>" class="form-control" value="<?php echo $last_name; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="updateEmailInput<?php echo $id_user; ?>" class="form-label">Email Address</label>
                                                        <input type="email" name="email" id="updateEmailInput<?php echo $id_user; ?>" class="form-control" value="<?php echo $email; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="updatePasswordInput<?php echo $id_user; ?>" class="form-label">Password</label>
                                                        <input type="password" name="password" id="updatePasswordInput<?php echo $id_user; ?>" class="form-control" value="<?php echo $password; ?>" required>
                                                    </div>
                                                    <input type="hidden" name="id_user<?php echo $id_user; ?>">
                                                    <div class="mb-3">
                                                        <label for="roleInput" class="form-label">Role</label>
                                                        <select name="role" id="roleInput<?php echo $id_user; ?>" class="form-control" required>
                                                            <option value="">Pilih Role</option>
                                                            <option value="admin" <?php if ($id_user == 'admin') echo 'selected'; ?>>Admin</option>
                                                            <option value="pelanggan" <?php if ($id_user == 'pelanggan') echo 'selected'; ?>>Pelanggan</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                                                        <button type="submit" class="btn btn-warning" name="updateus"><i class="fas fa-save"></i> Simpan</button>
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
                            <label for="frnameInput" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="frnameInput" class="form-control" placeholder="First Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="lsnameInput" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="lsnameInput" class="form-control" placeholder="Last Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Email Address</label>
                            <input type="email" name="email" id="emailInput" class="form-control" placeholder="Alamat Email" required>
                        </div>

                        <div class="mb-3">
                            <label for="passwordInput" class="form-label">Password</label>
                            <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="mb-3">
                            <label for="roleInput" class="form-label">Role</label>
                            <select name="role" id="roleInput" class="form-control" required>
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="pelanggan">Pelanggan</option>
                            </select>
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

    <?php include 'footer.php'; ?>
    </body>
</html>
