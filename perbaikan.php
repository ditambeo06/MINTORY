<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Perbaikan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/perbaikan.css">

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
            <h2>FORM PERBAIKAN</h2>
        </div>
        <form action="fungsi/fungsi_perbaikan.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" id="namaBarang" class="form-control" name="nmbarang" placeholder="Nama Barang..." required>
            </div>

            <div class="form-group">
                <label for="jumlahBarang">Jumlah Barang</label>
                <input type="number" id="jumlahBarang" name="jmlhbarang" placeholder="Jumlah Barang..." min="1" step="1" required>
            </div>

            <div class="form-group">
                <label for="gambar">Foto Kerusakan</label>
                <input type="file" id="imgrusak" accept="image/*" name="ftbarang" onchange="previewImage(event)">
                <br>
                <img id="preview" src="#" alt="Preview Gambar" style="display:none; max-width: 200px;">
                <script>
                    function previewImage(event) {
                        const preview = document.getElementById('preview');
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.style.display = 'block';
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                </script>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan (optional)...">
            </div> 
             
            <div class="form-group">
                <label for="Nama">Nama</label>
                <input type="text" id="Nama" class="form-control" name="Nama" placeholder="Nama Pengaju...">
            </div>

            <button type="submit" name="kirim" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>