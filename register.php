<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/regis.css">
    <link rel="stylesheet" href="css/navbarr.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="operator.php">SISPRAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION["username"]; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="register.php" method="post">
                                    <button type="submit" class="logout" name="logout" style="width: 100%; background: none; border: none; padding: 12px 16px; text-align: left;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <h1>SISPRAS</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 card card-left">
                <div class="card-body">
                    <h1>Register</h1>
                    <?php
                    if (isset($_SESSION['reg_message'])) {
                        echo "<div class='alert alert-info text-center'>" . $_SESSION['reg_message'] . "</div>";
                        unset($_SESSION['reg_message']);
                    }
                    ?>
                    <form action="fungsi/fungsi_regist.php" method="post">
                        <label for="email" class="form-label">Masukkan e-Mail</label>
                        <input type="text" class="form-control" placeholder="e-Mail" name="e-mail" required>
                        <label for="username" class="form-label">Masukkan Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <label for="passwd" class="form-label">Masukkan Password</label>
                        <input type="text" class="form-control" placeholder="Password" name="passwd" required>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level Akun</label>
                            <select class="form-select form-control" id="level" name="level" required>
                                <option value="" disabled selected>Pilih Level Akun</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                                <option value="super user">Super User</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn primary-btn tmbl" name="daftar">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>