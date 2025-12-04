<?php
include "config/koneksi.php";
session_start();

$id = $_GET['id_perbaikan'];

$sql =  "UPDATE tb_perbaikan SET status = '3' WHERE id_perbaikan = $id";

if (mysqli_query($db, $sql)) {
    $_SESSION['message2'] = "Permintaan Ditolak.";
} else {
    $_SESSION['message2'] = "Terjadi Kesalahan: " . mysqli_error($db);
}
header('location: ../daftar_accpinjam.php');
?>