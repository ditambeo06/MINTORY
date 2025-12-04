<?php
include "config/koneksi.php";
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.');window.location.replace('/SISPRAS/login.php');</script>";
    exit;
}

if (isset($_POST['kirim'])) {
    $nama = $_POST['nmbarang'];
    $jumlah = $_POST['jmlhbarang'];
    $foto = $_FILES['ftbarang']['name'];
    $tmp = $_FILES['ftbarang']['tmp_name'];
    $ket = $_POST['keterangan'];
    $status = 1;
    $username = $_SESSION['username'];
    $nama = $_POST['Nama'];
    $level = $_SESSION['status'];

    // Validasi jika username kosong
    if (empty($username)) {
        echo "<script>alert('Session username tidak ditemukan!');window.location.replace('/SISPRAS/login.php');</script>";
        exit;
    }

    $target_dir = "file/";
    $timestamp = time();
    $newfoto = $timestamp . basename($foto);
    $target_file = $target_dir . $newfoto;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa ekstensi file
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "<script>alert('Hanya file JPG, JPEG, PNG, & GIF yang diperbolehkan.');window.history.back();</script>";
        exit;
    }
    // Periksa ukuran file
    if ($_FILES['ftbarang']['size'] > 52428800) { 
        echo "<script>alert('Ukuran file terlalu besar.');window.history.back();</script>";
        exit;
    }

    $query = "INSERT INTO tb_perbaikan(nama_barang, jumlah_barang, foto_barang, keterangan, dibuat, status, Nama) 
              VALUES ('$nama', '$jumlah', '$newfoto', '$ket', '$username', '$status', '$nama')";
    if ($db->query($query)) {
        if (move_uploaded_file($tmp, $target_file)) {
            if ($level == "admin") {
                $location = "/SISPRAS/admin.php";
            } elseif ($level == "operator") {
                $location = "/SISPRAS/operator.php";
            } elseif ($level == "super user") {
                $location = "/SISPRAS/superuser.php";
            } else {
                $location = "/SISPRAS/user.php";
            }

            echo "<script>alert('Form Berhasil Dikirim');window.location.replace('$location');</script>";
        } else {
            echo "<script>alert('Gagal memindahkan file.');window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengirim data.');window.history.back();</script>";
    }
}
?>
