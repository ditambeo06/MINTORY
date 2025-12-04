<?php
session_start();
include "fungsi/config/koneksi.php";

// Mendapatkan username dari session
$username = $_SESSION['username'];

// Query untuk mengambil data peminjaman berdasarkan username yang sedang login
$data = mysqli_query($db, "SELECT * FROM tb_pinjam WHERE dibuat = '$username' ORDER BY id_peminjaman DESC");

$peminjaman = []; // Inisialisasi array $peminjaman
while ($row = mysqli_fetch_array($data)) {
    $peminjaman[] = $row;
}

// Query untuk menghitung jumlah pengajuan perbaikan dengan status 1 yang sesuai dengan username
$resultperbaikan = mysqli_query($db, "SELECT COUNT(*) as count FROM tb_perbaikan WHERE status = 1 AND dibuat = '$username'");
$dataperbaikan = mysqli_fetch_assoc($resultperbaikan);
$pendingperbaikan = $dataperbaikan['count']; // Menyimpan jumlah pengajuan perbaikan dengan status 1

// Query untuk menghitung jumlah peminjaman dengan status 1 yang sesuai dengan username
$resultpeminjaman = mysqli_query($db, "SELECT COUNT(*) as count FROM tb_pinjam WHERE status = 1 AND dibuat = '$username'");
$datapeminjaman = mysqli_fetch_assoc($resultpeminjaman);
$pendingpeminjaman = $datapeminjaman['count']; // Menyimpan jumlah peminjaman dengan status 1

// Proses logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan Peminjaman</title>
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
            <?php
            if (isset($_SESSION['status'])) {
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

                    <?php if ($_SESSION['status'] == "super user"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="daftar_pengadaan.php"><i class="fa-solid fa-clipboard-list"></i></a>
                        </li>
                    <?php endif; ?>


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
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION["username"]; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="daftar_pengajuan.php" method="post">
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
        <h2 class="mb-4">Daftar Pengajuan Peminjaman</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peminjaman as $item) : ?>
                    <tr>
                        <td><?= $item['nama_properti']; ?></td>
                        <td><?= $item['jumlah']; ?></td>
                        <td><?= $item['tanggal_pinjam']; ?></td>
                        <td><?= $item['tanggal_kembali']; ?></td>
                        <td><?= $item['keterangan']; ?></td>
                        <td>
                            <?php
                            $status = $item['status'];
                            if ($status == 1) {
                                echo "Pending";
                            } elseif ($status == 2) {
                                echo "Accepted";
                            } else {
                                echo "Rejected";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>