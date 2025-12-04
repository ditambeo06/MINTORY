<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/peminjaman.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
    <div class="container">
        <div class="title" style="text-align: center; margin-bottom: 20px;">
            <h2>FORM PEMINJAMAN</h2>
            <!-- </div> -->
            <form action="fungsi/fungsi_peminjaman.php" method="post">
                <div class="form-group">
                    <label for="namaBarang">Nama Barang/Ruangan</label>
                    <input type="text" id="namaBarang" class="form-control" name="nama" placeholder="Nama Barang/Ruangan..." required>
                </div>

                <div class="form-group">
                    <label for="jumlahBarang">Jumlah Barang</label>
                    <input type="number" id="jumlahBarang" class="form-control" name="jumlah" placeholder="Jumlah Barang..." min="1" step="1" required>
                </div>

                <div class="form-group">
                    <label for="tpinjam">Tanggal Peminjaman</label>
                    <input type="date" id="tpinjam" class="form-control" name="tanggal_pinjam" placeholder="Tanggal Peminjaman" onchange="setMinTanggalKembali()" required>
                </div>

                <div class="form-group">
                    <label for="tpkembali">Tanggal Pengembalian</label>
                    <input type="date" id="tpkembali" class="form-control" name="tanggal_kembali" placeholder="Tanggal kembali" required>
                </div>

                <script>
                    function setMinTanggalKembali() {
                        const tpinjam = document.getElementById('tpinjam');
                        const tpkembali = document.getElementById('tpkembali');

                        if (tpinjam.value) {
                            tpkembali.min = tpinjam.value; // Gunakan nilai langsung
                        } else {
                            tpkembali.min = ""; // Reset jika kosong
                        }
                    }
                </script>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan (optional)...">
                </div>

                <button type="submit" name="kirim" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>