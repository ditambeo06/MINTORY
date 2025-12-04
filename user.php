<?php
include "fungsi/config/koneksi.php";
session_start();

$username = $_SESSION['username'];

// Query untuk menghitung data dengan status 1
$resultperbaikan = mysqli_query($db, "SELECT COUNT(*) as count FROM tb_perbaikan WHERE status = 1 and dibuat = '$username'");
$dataperbaikan = mysqli_fetch_assoc($resultperbaikan);
$pendingperbaikan = $dataperbaikan['count']; // Menyimpan jumlah data dengan status 1


// Query untuk menghitung data dengan status 1
$resultpeminjaman = mysqli_query($db, "SELECT COUNT(*) as count FROM tb_pinjam WHERE status = 1 and dibuat = '$username' ");
$datapeminjaman = mysqli_fetch_assoc($resultpeminjaman);
$pendingpeminjaman = $datapeminjaman['count']; // Menyimpan jumlah data dengan status 1


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/navbarr.css">
    <link rel="stylesheet" href="css/badge.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="user.php">SISPRAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" href="daftar_peminjaman.php">
                            <i class="fa-solid fa-envelope"></i>
                            <?php if ($pendingpeminjaman > 0): ?>
                                <span class="badge bg-danger float-start badge-small"><?= $pendingpeminjaman; ?></span> <!-- Menampilkan jumlah permohonan dengan status 1 -->
                            <?php endif; ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="daftar_pengajuan.php">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                            <?php if ($pendingperbaikan > 0): ?>
                                <span class="badge bg-danger float-start badge-small"><?= $pendingperbaikan; ?></span> <!-- Menampilkan jumlah permohonan dengan status 1 -->
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION["username"]; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="user.php" method="post">
                                    <button type="submit" class="logout" name="logout" style="width: 100%; background: none; border: none; padding: 12px 16px; text-align: left;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="bg-light d-flex align-items-center" style="padding: 100px 0;">
    <div class="container text-center">
        <h1 class="fw-bold display-5 mb-3">SELAMAT DATANG DI <span style="color:#0d6efd;">SISPRAS</span></h1>
        <p class="lead text-secondary mb-4 fw-semibold">
            Sistem Informasi Sarana dan Prasarana yang membantu pengelolaan data secara mudah dan efisien.
        </p>
        <a href="peminjaman.php" class="btn btn-primary btn-lg px-4 py-2">Coba Sekarang</a>
    </div>
</section>

    
    <div class="container">
        <div>
            <h2>Daftar Sarana dan Prasarana</h2>
        </div><br>
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <img src="css/img/perbaikan.jpg" class="card-img-top" alt="Sarana 1">
                    <div class="card-body">
                        <h5 class="card-title">Perbaikan</h5>
                        <p class="card-text">Punya Keluhan Barang Rusak? <br> Ajukan Disini Untuk Perbaikan</p>
                        <a href="perbaikan.php" class="btn btn-primary">Tinjau</a>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card">
                    <img src="css/img/peminjaman.jpeg" class="card-img-top" alt="Sarana 3">
                    <div class="card-body">
                        <h5 class="card-title">Peminjaman</h5>
                        <p class="card-text">Perlu Sesuatu? <br> Pinjam Disini</p>
                        <a href="peminjaman.php" class="btn btn-primary">Tinjau</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- footer -->
    <footer>
        <p>&copy;Copyright@2024</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>