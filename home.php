<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JNE</title>
    <style>
        /* Reset and base styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    line-height: 1.6;
}

.container {
    width: 80%;
    margin: 0 auto;
    max-width: 1200px;
}

.header {
    background-color: #f8f8f8;
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    z-index: 1000;
}

.header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .logo {
    font-size: 24px;
    font-weight: bold;
    color: #ff6600;
}

.header .nav {
    flex: 1;
    text-align: center;
}

.header .nav a {
    margin: 0 15px;
    text-decoration: none;
    color: #333;
    transition: color 0.3s;
}

.header .nav a:hover {
    color: #ff6600;
}

.dropdown {
    position: relative;
    display: inline-block;
    margin-right: 20px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    z-index: 1000;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 0;
    border-top: 2px solid #ff6600;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.hero {
    background-image: url('/barang/assets/img/truck.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
    position: relative;
    z-index: 1;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: -1;
}

.hero h1 {
    font-size: 48px;
    margin-bottom: 20px;
}

.hero p {
    font-size: 18px;
    margin-bottom: 40px;
}

.track-form {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
}

.track-form input[type="text"] {
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px 0 0 5px;
    outline: none;
    width: 300px;
}

.track-form button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #ff6600;
    border: none;
    border-radius: 0 5px 5px 0;
    color: white;
    cursor: pointer;
    outline: none;
    transition: background-color 0.3s;
}

.track-form button:hover {
    background-color: #e55a00;
}

.footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    position: absolute;
    bottom: 0;
    width: 100%;
}

.footer p {
    margin: 0;
}

@media (max-width: 768px) {
    .container {
        width: 90%;
    }

    .header .logo {
        font-size: 20px;
    }

    .header .nav {
        text-align: center;
    }

    .header .nav a {
        display: block;
        margin: 10px 0;
    }

    .hero h1 {
        font-size: 36px;
    }

    .hero p {
        font-size: 16px;
    }

    .track-form input[type="text"] {
        width: 100%;
    }
}


    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="logo">JNE</div>
            <nav class="nav">
                <a href="#">Home</a>
                <a href="#">About Us</a>
                <a href="#">Contact</a>
            </nav>
            <div class="dropdown">
                <span class="nav-link">More &#9776;</span>
                <div class="dropdown-content">
                    <a href="register.php">Sign-up</a>
                    <a href="login.php">Sign-in</a>
                </div>
            </div>
        </div>
    </header>

<section class="hero">
    <div class="container">
        <h1>Teruskan Kebahagiaan dari Generasi ke Generasi</h1>
        <p>Lacak Kiriman Anda.</p>
        <div class="track-form">
            <form action="tracking.php" method="get">
                <input type="text" name="id_pengiriman" placeholder="Masukkan ID pengiriman Anda" required>
                <button type="submit"> Lacak Sekarang </button>
            </form>
        </div>
    </div>
</section>


</body>
</html>
