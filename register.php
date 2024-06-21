<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
    body {
        background-image: url('/barang/assets/img/bg.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
        height: 100vh;
        margin: 0;
    }

   .container {
        margin: 0 auto; /* add this to center the container */
    }

   .card {
        background: #ffffff;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.5);
        padding: 2rem;
        max-width: 400px;
        width: 100%;
        margin: 40px auto;

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 0.5rem 0.5rem 0 0;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .form-control {
            background-color: rgba(0, 123, 255, 0.1);
            border: none;
            color: #007bff;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            background-color: rgba(0, 123, 255, 0.2);
            color: #007bff;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        .btn-primary:hover {
            background-color: #007bff;
            color: #fff;
            transform: scale(1.05);
        }

        .footer {
            margin-top: 1rem;
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
    <div class="container">
        <div class="card mx-auto">
                    <div class="card-header">
                        Register Pelanggan
                    </div>
                    <div class="card-body">
                        <form action="register_aksi.php" method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="register">Register</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="footer">
                            Sudah punya akun? <a href="login.php">Login disini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
