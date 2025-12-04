<?php
include "config/koneksi.php";
session_start();

if(isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $tpinjam = $_POST['tanggal_pinjam'];
    $tkembali = $_POST['tanggal_kembali'];
    $ket = $_POST['keterangan'];
    $dibuat = $_SESSION['username'];
    $status = 1;
    $level = $_SESSION['status'];

    $db->query("INSERT INTO tb_pinjam(nama_properti, jumlah, tanggal_pinjam, tanggal_kembali, keterangan, dibuat, status) VALUES ('$nama', '$jumlah', '$tpinjam', '$tkembali', '$ket', '$dibuat', '$status')");

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

}

?>