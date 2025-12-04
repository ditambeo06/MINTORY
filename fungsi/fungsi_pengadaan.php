<?php
include "config/koneksi.php";
session_start();

if(isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $jurusan = $_POST['jurusan'];
    $tahun = $_POST['tahun'];
    $ket = $_POST['keterangan'];
    $level = $_SESSION['status'];


    $db->query("INSERT INTO tb_pengadaan(nama_barang, jumlah_barang, jurusan, tahun_ajar, keterangan) VALUES ('$nama', '$jumlah', '$jurusan', '$tahun', '$ket')");

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