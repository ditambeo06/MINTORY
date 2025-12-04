<?php
session_start();
include "fungsi/config/koneksi.php";

// Mendapatkan status user
$status = $_SESSION['status'];

// Query untuk menghitung jumlah data dengan status 1
if ($status == "super user") {
    // Jika yang mengakses adalah superuser, hanya hitung data untuk username yang sesuai
    $resultperbaikan = mysqli_query($db, "SELECT COUNT(*) as count FROM tb_perbaikan WHERE status = 1 AND dibuat = '{$_SESSION['username']}'");
    $resultpeminjaman = mysqli_query($db, "SELECT COUNT(*) as count FROM tb_pinjam WHERE status = 1 AND dibuat = '{$_SESSION['username']}'");
} else {
    // Jika admin atau operator, hitung semua data dengan status 1
    $resultperbaikan = mysqli_query($db, "SELECT COUNT(*) as count FROM tb_perbaikan WHERE status = 1");
    $resultpeminjaman = mysqli_query($db, "SELECT COUNT(*) as count FROM tb_pinjam WHERE status = 1");
}

$dataperbaikan = mysqli_fetch_assoc($resultperbaikan);
$pendingperbaikan = $dataperbaikan['count']; // Menyimpan jumlah data dengan status 1

$datapeminjaman = mysqli_fetch_assoc($resultpeminjaman);
$pendingpeminjaman = $datapeminjaman['count']; // Menyimpan jumlah data dengan status 1

// Mengambil data pengadaan
$data2 = mysqli_query($db, "SELECT * FROM tb_pengadaan ORDER BY id_pengadaan DESC");
while ($data3 = mysqli_fetch_array($data2)) {
    $pengadaan[] = $data3;
}

// Logout logic
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
    <title>Daftar Pengadaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/daftar_pengajuan.css">
    <link rel="stylesheet" href="css/navbarr.css">
    <link rel="stylesheet" href="css/badge.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="
            <?php if (isset($_SESSION['status'])) {
                $status = $_SESSION['status'];

                if ($status == "admin") {
                    echo "admin.php";
                } elseif ($status == "user") {
                    echo "user.php";
                } elseif ($status == "super user") {
                    echo "superuser.php";
                } else {
                    echo "operator.php";
                }
            } ?>">SISPRAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="daftar_pengadaan.php"><i class="fa-solid fa-clipboard-list"></i></a>
                    </li>

                    <!-- Hanya tampil jika yang login bukan super user -->
                    <?php if ($_SESSION['status'] != "super user"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="history.php"><i class="fa-solid fa-clock-rotate-left"></i></a>
                        </li>
                    <?php endif; ?>

                    <?php if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "operator"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="daftar_accpinjam.php"><i class="fa-solid fa-envelope"></i>
                                <?php if ($pendingpeminjaman > 0): ?>
                                    <span class="badge bg-danger float-start badge-small"><?= $pendingpeminjaman; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>


                    <!-- Menampilkan Daftar Permohonan untuk Admin dan Operator -->
                    <?php if ($_SESSION['status'] == "admin" || $_SESSION['status'] == "operator"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="daftar_permohonan.php"><i class="fa-solid fa-screwdriver-wrench"></i>
                                <?php if ($pendingperbaikan > 0): ?>
                                    <span class="badge bg-danger float-start badge-small"><?= $pendingperbaikan; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>




                    <?php if ($_SESSION['status'] == "super user"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="daftar_peminjaman.php">
                                <i class="fa-solid fa-envelope"></i>
                                <?php if ($pendingpeminjaman > 0): ?>
                                    <span class="badge bg-danger float-start badge-small"><?= $pendingpeminjaman; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($_SESSION['status'] == "super user"): ?><li class="nav-item">
                            <a class="nav-link active" href="daftar_pengajuan.php">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                <?php if ($pendingperbaikan > 0): ?>
                                    <span class="badge bg-danger float-start badge-small"><?= $pendingperbaikan; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION["username"]; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="daftar_pengadaan.php" method="post">
                                    <button type="submit" class="logout" name="logout" style="width: 100%; background: none; border: none; padding: 12px 16px; text-align: left;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Daftar Pengadaan</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Jurusan</th>
                    <th>Tahun Ajar</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pengadaan as $item) : ?>
                    <tr>
                        <td><?= $item['nama_barang']; ?></td>
                        <td><?= $item['jumlah_barang']; ?></td>
                        <td><?= $item['jurusan']; ?></td>
                        <td><?= $item['tahun_ajar']; ?></td>
                        <td><?= $item['keterangan']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>