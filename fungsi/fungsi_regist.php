<?php
include "config/koneksi.php";
session_start();

if (isset($_POST['daftar'])) {
    $email = $_POST['e-mail'];
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $level = $_POST['level'];
    $encript = hash("md5", $passwd);

    // Validasi apakah email sudah digunakan
    $cekemail = "SELECT * FROM tb_login WHERE email = '$email'";
    $cekemail = $db->query($cekemail);

    if ($cekemail->num_rows > 0) {
        $_SESSION['reg_message'] = "Email sudah digunakan, silakan gunakan email lain.";
    } else {
        $sql = "INSERT INTO tb_login (email, username, passwd, level) VALUES ('$email', '$username', '$encript', '$level')";
        try {
            if ($db->query($sql)) {
                $_SESSION['reg_message'] = "Akun berhasil dibuat. Silakan login.";
                header("location: /SISPRAS/login.php");
                exit();
            } else {
                $_SESSION['reg_message'] = "Data gagal disimpan, silakan coba kembali.";
            }
        } catch (mysqli_sql_exception $e) {
            $_SESSION['reg_message'] = "Error: " . $e->getMessage();
        }
    }

    $db->close();
}
?>
