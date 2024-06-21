<?php
require 'koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['log'] = true;
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header('Location: index.php');
        } elseif ($user['role'] == 'pelanggan') {
            $pelangganQuery = "SELECT id_pelanggan FROM pelanggan WHERE id_user = ?";
            $pelangganStmt = mysqli_prepare($conn, $pelangganQuery);
            mysqli_stmt_bind_param($pelangganStmt, 'i', $user['id_user']);
            mysqli_stmt_execute($pelangganStmt);
            $pelangganResult = mysqli_stmt_get_result($pelangganStmt);

            if ($pelangganResult && mysqli_num_rows($pelangganResult) > 0) {
                $pelanggan = mysqli_fetch_assoc($pelangganResult);
                $_SESSION['id_pelanggan'] = $pelanggan['id_pelanggan'];
            }

            header('Location: pelanggan_dashboard.php');
        }

        exit();
    } else {
        $loginFailed = true;
    }

    mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<style>
        body {
            background-image: url('/barang/assets/img/bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        .modal-dialog {
            max-width: 500px;
            animation: modalFadeIn 0.5s ease-in-out;
            font-family: Arial, sans-serif; /* Change font family here */
        }

        .modal-content {
            background-color: #007bff;
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.5);
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: center; /* Center the title */
            align-items: center; /* Center vertically */
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center; /* Center the title */
            flex: 1; /* Take up remaining space */
        }

        .modal-header .bi {
            margin-right: 0.5rem;
        }

        .modal-body {
            padding: 1rem;
            text-align: center;
            color: #fff;
        }

        .modal-body img {
            margin-top: 1rem;
            max-width: 100%;
            height: auto;
        }

        .modal-footer {
            border-top: none;
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: center;
            background-color: #007bff;
        }

        .modal-footer .btn {
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-footer .btn-primary {
            background-color: #fff;
            color: #007bff;
            border: none;
        }

        .modal-footer .btn-primary:hover {
            background-color: #f0f0f0;
        }

        .modal-footer .btn-danger {
            background-color: #fff;
            color: #dc3545;
            border: none;
        }

        .modal-footer .btn-danger:hover {
            background-color: #f0f0f0;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .gradient-custom {
            background: linear-gradient(45deg, #00f);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #ffffff;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.5);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        .form-control {
            background-color: rgba(0, 123, 255, 0.1);
            border: none;
            color: #007bff;
            border-radius: 0.5rem;
        }

        .form-control:focus {
            background-color: rgba(0, 123, 255, 0.2);
            color: #007bff;
            box-shadow: none;
        }

        .btn-outline-primary {
            border-color: #007bff;
            border-radius: 0.5rem;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
            transform: scale(1.05);
        }

        .form-label {
            margin-left: 15px;
            color: #007bff;
        }

        .alert {
            position: relative;
            width: 100%;
            margin-top: 10px;
        }

        .form-outline {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-outline input {
            padding: 15px 10px 10px 20px;
        }

        .form-outline label {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 20px;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-outline input:focus ~ label,
        .form-outline input:not(:placeholder-shown) ~ label {
            top: 10px;
            left: 20px;
            font-size: 0.85rem;
            color: #007bff;
        }

        .header {
            font-size: 2rem;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 1rem;
        }

        .sub-header {
            font-size: 1rem;
            color: #007bff;
            margin-bottom: 1rem;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #007bff;
            text-align: center;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

</style>
    

</head>

<body>
<body>
    <section class="gradient-custom">
        <div class="card">
            <div class="card-body text-center">
                <div class="header">Welcome Back!</div>
                <div class="sub-header">Masukkan Email dan Password</div>
                <form method="POST">
                    <div class="form-outline form-white mb-4">
                        <input type="email" id="inputEmail" class="form-control form-control-lg" name="email" placeholder=" " required />
                        <label class="form-label" for="inputEmail">Email Address</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input type="password" id="inputPassword" class="form-control form-control-lg" name="password" placeholder=" " required />
                        <label class="form-label" for="inputPassword">Password</label>
                    </div>
                    <button class="btn btn-outline-primary btn-lg px-5" type="submit" name="login">Login</button>
                </form>
            </div>
            <div class="card-footer">
                <div class="footer">
                    Belum punya akun? <a href="register.php">Register disini</a>
                </div>
            </div>
        </div>
    </section>

    <!-- sukses Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel"><i class="bi bi-check-circle-fill"></i>Sukses!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Login Berhasil!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Gagal Modal -->
    <div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="failureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="failureModalLabel"><i class="bi bi-x-circle-fill"></i>Gagal Login!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Email dan Password Salah.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        <?php if ($loginSuccess) : ?>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                myModal.show();
                setTimeout(function() {
                    <?php if ($_SESSION['role'] == 'admin') : ?>
                        window.location.href = 'index.php';
                    <?php else : ?>
                        window.location.href = 'pelanggan_dashboard.php';
                    <?php endif; ?>
                }, 3000); // delay
            });
        <?php elseif ($loginFailed) : ?>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('failureModal'));
                myModal.show();
            });
        <?php endif; ?>
    </script>
    
</body>
</html>
