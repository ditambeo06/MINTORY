<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengadaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/pengadaan.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
    </nav>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">

    <div class="container" style="max-width: 500px;">
        <div class="title text-center mb-4">
            <h2>FORM PENGADAAN</h2>
        </div>

        <form action="fungsi/fungsi_pengadaan.php" method="post">
            <div class="form-group mb-3">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" id="namaBarang" class="form-control" name="nama" placeholder="Nama Barang..." required>
            </div>

            <div class="form-group mb-3">
                <label for="jumlahBarang">Jumlah Barang</label>
                <input type="number" id="jumlahBarang" class="form-control" name="jumlah" placeholder="Jumlah Barang..." required>
            </div>

            <div class="form-group mb-3">
                <label for="jurusan">Jurusan</label>
                <input type="text" id="jurusan" class="form-control" name="jurusan" placeholder="Jurusan..." required>
            </div>

            <div class="form-group mb-3">
                <label for="periode">Tahun Pelajaran</label>
                <input type="text" id="periode" class="form-control" name="tahun" placeholder="Tahun Pelajaran..." required>
            </div>

            <div class="form-group mb-3">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan (optional)...">
            </div>

            <button type="submit" name="kirim" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>