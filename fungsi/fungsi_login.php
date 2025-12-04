<?php
include "config/koneksi.php";
session_start();

$login_message = "";

// Jika ada pesan login, tampilkan dan hapus pesan tersebut
if (isset($_SESSION['login_message'])) {
    $login_message = $_SESSION['login_message'];
    unset($_SESSION['login_message']);
}

// Jika sudah login, arahkan berdasarkan levelnya
if (isset($_SESSION["is_login"])) {
    $level = $_SESSION['status'];

    if ($level == 'admin') {
        header("Location: admin.php");
        exit();
    } elseif ($level == 'operator') {
        header("Location: operator.php");
        exit();
    } elseif ($level == 'user') {
        header("Location: user.php");
        exit();
    } elseif ($level == 'super user') {
        header("Location: superuser.php");
        exit();
    }
}

// Proses login jika form dikirim
if (isset($_POST['masuk'])) {
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $encript = hash("md5", $passwd);

    // Cek username dan password di database
    $sql = "SELECT * FROM tb_login WHERE username = '$username' AND passwd = '$encript'";
    $result = $db->query($sql);

    if ($result && $result->num_rows > 0) {
        // Jika login berhasil, ambil data pengguna dan set session
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["status"] = $data['level'];
        $_SESSION['is_login'] = true;

        // Arahkan berdasarkan level pengguna
        if ($data['level'] == "admin") {
            header("location: admin.php");
        } elseif ($data['level'] == "user") {
            header("location: user.php");
        } elseif ($data['level'] == "operator") {
            header("location: operator.php");
        } elseif ($data['level'] == "super user") {
            header("location: superuser.php");
        }
    } else {
        // Jika login gagal, tampilkan pesan error
        $_SESSION['login_message'] = "Akun Tidak Ditemukan";
        header("Location: login.php");
        exit;
    }
}

$db->close();
?>