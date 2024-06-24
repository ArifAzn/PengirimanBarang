<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JNE</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            line-height: 1.6;
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            max-width: 1200px;
        }

        /* Header styles */
        .header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 10px 0;
            position: sticky;
            top: 0;
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
            text-transform: uppercase;
        }

        .header .nav {
            flex: 1;
            text-align: center;
        }

        .header .nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            transition: color 0.3s;
            text-transform: uppercase;
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
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 1000;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 0;
            border-top: 2px solid #ff6600;
            text-align: center;
                     min-width: 100px;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 14px;
            text-transform: uppercase;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Hero section */
        .hero {
            background-image: url('/barang/assets/img/truck.jpg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
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
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .track-form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .track-form input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
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


                /* About section */
        .about {
            background-color: #ffffff;
            padding: 80px 0;
            text-align: center;
        }

        .about .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .about h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #ff6600;
        }

        .about p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #666666;
        }

        .about figure {
            margin-bottom: 30px;
        }

        .about figure img {
            max-width: 100%;
            height: auto;
        }

        /* Vision & Mission section */
        .vision-mission {
            background-color: #f9f9f9;
            padding: 80px 0;
            text-align: center;
        }

        .vision-mission .wrapper-small {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .vision-mission h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #ff6600;
        }

        .vision-mission .row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 30px;
        }

        .vision-mission .column {
            flex: 1 1 300px;
            max-width: 400px;
            text-align: left;
        }

        .vision-mission h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ff6600;
        }

        .vision-mission p {
            font-size: 18px;
            line-height: 1.6;
            color: #666666;
        }

        /* Milestone section */
        .milestone {
            padding: 80px 0;
            text-align: center;
        }

        .milestone .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .milestone h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #ff6600;
        }

        .milestone .row {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-top: 30px;
        }

        .milestone .column {
            flex: 1;
            max-width: 45%;
            text-align: left;
        }

        .milestone .history h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ff6600;
        }

        .milestone .year-list {
            list-style-type: none;
            padding: 0;
        }

        .milestone .year-item {
            margin-bottom: 30px;
        }

        .milestone .year-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #ff6600;
        }

        .milestone .year-item p {
            font-size: 16px;
            line-height: 1.6;
            color: #666666;
        }

        .load-more {
            margin-top: 30px;
        }

        .load-more .button-outline {
            padding: 12px 30px;
            font-size: 16px;
            color: #ff6600;
            border: 2px solid #ff6600;
            background-color: transparent;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .load-more .button-outline:hover {
            background-color: #ff6600;
            color: #ffffff;
        }

        /* Value section */
        .value {
            padding: 80px 0;
            text-align: center;
        }

        .value .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .value h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #ff6600;
        }

        .value .row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 40px;
            margin-top: 30px;
        }

        .value .column {
            flex: 1 1 300px;
            max-width: 300px;
            text-align: left;
        }

        .value .card {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s;
        }

        .value .card:hover {
            transform: translateY(-10px);
        }

        .value .card img {
            max-width: 100px;
            height: auto;
            margin-bottom: 20px;
        }

        .value .card h5 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #ff6600;
        }

        .value .card p {
            font-size: 16px;
            line-height: 1.6;
            color: #666666;
        }

        /* Director section */
        .director {
            position: relative;
            overflow: hidden;
            padding: 80px 0;
            text-align: center;
        }

        .director .bg-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .director .bg-line .bg-plan {
            width: 5px;
            height: 100%;
            background-color: #ff6600;
        }

        .director .bg-line-start, .director .bg-line-end {
            width: 50%;
            height: 5px;
            background-color: #ff6600;
        }

        .director .bg-line-mid {
            width: 100%;
            height: 5px;
            background-color: #ff6600;
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        .director .line-point {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: #ff6600;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .director .circle-point {
            width: 10px;
            height: 10px;
            background-color: #ffffff;
            border-radius: 50%;
        }

        .director .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .director h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #ff6600;
        }

        .director .director-list {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
        }

        .director .director-item {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: left;
            max-width: 300px;
        }

        .director .director-photo {
            margin-bottom: 20px;
        }

        .director .director-photo img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .director .director-name h5 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #ff6600;
        }

        .director .director-name p {
            font-size: 16px;
            color: #666666;
            margin-bottom: 10px;
        }

        .director .director-bio {
            font-size: 16px;
            line-height: 1.6;
            color: #666666;
        }

        /* Contact section */
        .contact {
            background-color: #f9f9f9;
            padding: 80px 0;
            text-align: center;
        }

        .contact .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact .column {
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: left;
        }

        .contact h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #ff6600; /* Changed to orange */
        }

        .contact p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #666666;
        }

        .head-office h5, .box-cs h5 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ff6600;
        }

        .head-office p, .box-cs p {
            margin-bottom: 10px;
            font-size: 16px;
            color: #666666;
        }

        .icon-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .icon-list li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .icon-list a {
            text-decoration: none;
            color: #333333;
            font-size: 16px;
            transition: color 0.3s;
        }

        .icon-list a:hover {
            color: #ff6600;
        }

        .icon-list img {
            margin-right: 10px;
        }

        .box-cs {
            margin-bottom: 20px;
        }

        .box-cs a {
            color: #333333;
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .box-cs a:hover {
            color: #ff6600;
        }

        .box-socmed {
            margin-top: 20px;
        }

        .box-socmed h5 {
            margin-bottom: 10px;
        }

        .box-socmed a {
            display: inline-block;
            margin: 0 10px;
        }

        .box-socmed img {
            width: 30px;
            height: 30px;
        }

        /* Footer */
        .footer {
            background-color: #333333;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
            position: relative;
            clear: both;
            margin-top: 50px; /* Added margin top to separate footer from content */
        }

        .footer p {
            margin: 0;
            font-size: 14px;
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

            .track-form {
                flex-direction: column;
                align-items: center;
            }

            .track-form input[type="text"] {
                width: 100%;
                margin-bottom: 10px;
            }

            .track-form button {
                border-radius: 5px;
                width: 100%;
            }

            .contact .column {
                text-align: center;
            }

            .box-cs {
                text-align: center;
            }

            .box-socmed {
                text-align: center;
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
            <a href="#about">About Us</a>
            <a href="#contact">Contact</a>
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
        <p>Lacak Kiriman Anda dengan Mudah dan Cepat!</p>
        <div class="track-form">
            <form action="tracking.php" method="get">
                <input type="text" name="id_pengiriman" placeholder="Masukkan ID pengiriman Anda" required>
                <button type="submit">Lacak Sekarang</button>
            </form>
        </div>
    </div>
</section>

<section id="about" class="about">
    <div class="wrapper">
        <h2>Profil Perusahaan</h2>
        <p class="lead">PT. Tiki Jalur Nugraha Ekakurir atau biasa dikenal sebagai JNE merupakan salah satu perusahaan ekspedisi barang terbesar di Indonesia, berkat jaringan dan jangkauan area distribusinya yang mencakup lebih dari 83.000 kota, termasuk kabupaten, desa, dan pulau terluar, dengan gerai penjualan berjumlah lebih dari 8.000 titik dan mempekerjakan lebih dari 50.000 karyawan di seluruh Indonesia.</p>
    </div>
</section>

<section class="vision-mission">
    <div class="wrapper-small">
        <h2>Visi & Misi</h2>
        <div class="row row-center">
            <div class="column">
                <h3>Visi</h3>
            </div>
            <div class="column">
                <p class="lead">Menjadi Perusahaan Logistik Terdepan di Negeri Sendiri yang Berdaya Saing Global</p>
            </div>
        </div>
        <div class="row row-center">
            <div class="column">
                <h3>Misi</h3>
            </div>
            <div class="column">
                <p class="lead">Untuk Memberi Pengalaman Terbaik Kepada Pelanggan Secara Konsisten</p>
            </div>
        </div>
    </div>
</section>

<section class="milestone">
    <div class="wrapper">
        <div class="row">
            <div class="column column-50">
                <div class="history">
                    <h2>Sejarah & Milestone</h2>
                    <p>Berdiri pada tanggal 26 November tahun 1990, PT Tiki Jalur Nugraha Ekakurir atau JNE memulai kegiatan usahanya yang terpusat pada penanganan kegiatan kepabeanan/impor kiriman barang/dokumen serta pengantarannya dari luar negeri ke Indonesia.</p>
                </div>
            </div>
            <div class="column column-50">
                <div class="year-list">
                    <div class="year-item">
                        <h3>2013</h3>
                        <p>JNE fokus memperbesar kapasitas dan kapabilitas infrastruktur fisik dan teknologinya untuk mengantisipasi pesatnya pertumbuhan transaksi belanja daring melalui marketplace dan dan tren gaya hidup digital di Indonesia.</p>
                    </div>
                    <div class="year-item">
                        <h3>1995</h3>
                        <p>Memperkenalkan sistem drop point atau agen pengiriman yang disebut “Takuhaibin”. JNE banyak memanfaatkan keberadaan warung telekomunikasi (Wartel) yang menjamur pada waktu itu untuk membuka Takuhaibin, dan ini yang menjadi cikal bakal Agen JNE yang jumlahnya mencapai lebih dari 8,000 titik di seluruh Indonesia pada 2022.</p>
                    </div>
                    <div class="year-item">
                        <h3>1990</h3>
                        <p>PT. Tiki Jalur Nugraha Ekakurir resmi didirikan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="value">
    <div class="wrapper">
        <h2>Nilai Perusahaan</h2>
        <div class="row">
            <div class="column column-25">
                <div class="card card-style-3">
                    <div class="card-body">
                        <figure>
                            <img src="https://www.jne.co.id/cfind/source/thumb/images/cover_w100_h100_icon-jne-jujur-copy.png" alt="">
                        </figure>
                        <h5>Jujur</h5>
                        <p>Kita perkuat fondasi diri. Kejujuran adalah kunci dari nama baik dan reputasi.</p>
                    </div>
                </div>
            </div>
            <div class="column column-25">
                <div class="card card-style-3">
                    <div class="card-body">
                        <figure>
                            <img src="https://www.jne.co.id/cfind/source/thumb/images/cover_w100_h100_icon-jne-disiplin-copy.png" alt="">
                        </figure>
                        <h5>Disiplin</h5>
                        <p>Kita jaga marwah organisasi dengan bersikap tepat-waktu, berkomitmen, dan saling mengingatkan</p>
                    </div>
                </div>
            </div>
            <div class="column column-25">
                <div class="card card-style-3">
                    <div class="card-body">
                        <figure>
                            <img src="https://www.jne.co.id/cfind/source/thumb/images/cover_w100_h100_icon-jne-tanggungjawab-copy.png" alt="">
                        </figure>
                        <h5>Tanggung Jawab</h5>
                        <p>Kita kerjakan yang telah direncanakan dan menjadi kewajiban. Tanpa kecuali. Setuntas-tuntasnya, sebaik-baiknya.</p>
                    </div>
                </div>
            </div>
            <div class="column column-25">
                <div class="card card-style-3">
                    <div class="card-body">
                        <figure>
                            <img src="https://www.jne.co.id/cfind/source/thumb/images/cover_w100_h100_icon-jne-visioner-copy.png" alt="">
                        </figure>
                        <h5>Visioner</h5>
                        <p>Kita lebihi harapan pelanggan. Selangkah di depan dalam pelayanan, kecepatan dan kepastian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="director">
    <div class="bg-line">
        <div class="bg-line-start"></div>
        <div class="bg-line-mid"></div>
        <div class="bg-line-end"></div>
        <div class="line-point">
            <div class="circle-point"></div>
        </div>
    </div>
    <div class="wrapper">
        <h2>Jajaran Direktur</h2>
        <div class="director-list">
            <div class="director-item">
                <div class="director-photo">
                    <img src="https://www.jne.co.id/cfind/source/thumb/images/director/director-jne-001.png" alt="">
                </div>
                <div class="director-name">
                    <h5>Marsudi Wahyu Kisworo</h5>
                    <p>Direktur Utama</p>
                </div>
                <div class="director-bio">
                    <p>Telah berkarir lebih dari 30 tahun di dunia logistik, Marsudi Wahyu Kisworo memimpin JNE sebagai Direktur Utama sejak 2019.</p>
                </div>
            </div>
            <div class="director-item">
                <div class="director-photo">
                    <img src="https://www.jne.co.id/cfind/source/thumb/images/director/director-jne-002.png" alt="">
                </div>
                <div class="director-name">
                    <h5>Triana Alisa Sutrisno</h5>
                    <p>Direktur Keuangan</p>
                </div>
                <div class="director-bio">
                    <p>Triana Alisa Sutrisno memegang peran penting dalam mengelola keuangan perusahaan, serta strategi keuangan JNE sejak 2016.</p>
                </div>
            </div>
            <div class="director-item">
                <div class="director-photo">
                    <img src="https://www.jne.co.id/cfind/source/thumb/images/director/director-jne-003.png" alt="">
                </div>
                <div class="director-name">
                    <h5>Gunardi Sutanto</h5>
                    <p>Direktur Operasional</p>
                </div>
                <div class="director-bio">
                    <p>Gunardi Sutanto telah berdedikasi di JNE selama lebih dari 15 tahun, mengawasi operasional dan layanan pelanggan sejak 2018.</p>
                </div>
            </div>
            <div class="director-item">
                <div class="director-photo">
                    <img src="https://www.jne.co.id/cfind/source/thumb/images/director/director-jne-004.png" alt="">
                </div>
                <div class="director-name">
                    <h5>Yusuf Budi Rahardjo</h5>
                    <p>Direktur SDM & Teknologi Informasi</p>
                </div>
                <div class="director-bio">
                    <p>Yusuf Budi Rahardjo bergabung dengan JNE sebagai Direktur SDM dan Teknologi Informasi pada tahun 2020, membawa pengalaman luas di bidang teknologi informasi dan manajemen SDM.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="contact" class="contact">
    <div class="container">
        <div class="column">
            <h2>Hubungi Kami</h2>
            <p>Jangan ragu untuk menghubungi kami dan temukan solusi terbaik untuk kebutuhan pengiriman Anda.</p>
            
            <div class="head-office">
                <h5>Kantor Pusat &amp; Logistik</h5>
                <p>Jl. Tomang Raya No.11 Jakarta Barat 11440 Indonesia</p>
                <ul class="icon-list">
                    <li><img src="https://www.jne.co.id/images/material/ico-cs-call.svg" alt=""><a href="tel:02129278888">021 - 2927 - 8888</a></li>
                    <li><img src="https://www.jne.co.id/images/material/ico-cs-call.svg" alt=""><a href="tel:62215665262">6221 - 566 - 5262</a></li>
                    <li><img src="https://www.jne.co.id/images/material/ico-cs-email.svg" alt=""><a href="mailto:customercare@jne.co.id">customercare@jne.co.id</a></li>
                </ul>
                
                <h5>Freight</h5>
                <ul class="icon-list">
                    <li><img src="https://www.jne.co.id/images/material/ico-cs-call.svg" alt=""><a href="tel:622129278888">6221 - 2927 - 8888</a></li>
                </ul>
            </div>
        </div>
        
        <div class="column">
            <div class="box-cs">
                <h5>CUSTOMER SERVICE</h5>
                <p>
                    <a href="tel:(021)29278888">
                        <img src="https://www.jne.co.id/images/material/ico-cs-call.svg" alt=""> (021) 2927 8888
                    </a>
                </p>
                <p>
                    <a href="mailto:customercare@jne.co.id">
                        <img src="https://www.jne.co.id/images/material/ico-cs-email.svg" alt=""> customercare@jne.co.id
                    </a>
                </p>
            </div>
            
                <div class="box-socmed">
                    <a href="https://www.instagram.com/jne_id/" target="_blank nofollow"><img src="https://www.jne.co.id/cfind/source/images/ico-socmed-instagram.svg" alt=""></a>
                    <a href="https://www.tiktok.com/@jne_id" target="_blank nofollow"><img src="https://www.jne.co.id/cfind/source/images/ico-socmed-tiktok.svg" alt=""></a>
                    <a href="https://twitter.com/JNE_ID" target="_blank nofollow"><img src="https://www.jne.co.id/cfind/source/images/x.svg" alt=""></a>
                    <a href="https://www.linkedin.com/company/pt--tiki-jalur-nugraha-ekakurir-jne-/mycompany/?viewAsMember=true" target="_blank nofollow"><img src="https://www.jne.co.id/cfind/source/images/untitled.svg" alt=""></a>
                    <a href="https://www.facebook.com/JNEPusat" target="_blank nofollow"><img src="https://www.jne.co.id/cfind/source/images/untitled-_1__1.svg" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
