<?php
include "config/koneksi.php";
session_start();

$id = $_GET['id_peminjaman'];

$sql =  "UPDATE tb_pinjam SET status = '2' WHERE id_peminjaman = $id";

if (mysqli_query($db, $sql)) {
    $_SESSION['message'] = "Permintaan Diterima.";
} else {
    $_SESSION['message'] = "Terjadi Kesalahan: " . mysqli_error($db);
}
header('location: ../daftar_accpinjam.php');
?>