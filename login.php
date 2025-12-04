<?php
require "fungsi/fungsi_login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div  class="row justify-content-center"><h1>SISPRAS</h1></div><br>
        <div class="row justify-content-center">
 <div class="col-md-6 card card-left">
                <div class="card-body">
                    <h1 class="text-center">Sign In</h1>
                    <form action="login.php" method="post">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <input type="password" class="form-control" placeholder="Password" name="passwd" required>
                        <button type="submit" class="btn" name="masuk">Sign In</button>
                    </form>

                    <?php if ($login_message): ?>
                        <div class="alert alert-danger mt-3">
                            <?= htmlspecialchars($login_message); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
            <div class="col-md-4 card card-right"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>