<?php
require_once './services/guest-only.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Css For This Page -->
    <link href="assets/css/login.css" rel="stylesheet">
</head>

<body>
    <main class="form-signin w-100 m-auto shadow">
        <form action="services/authentication.php" method="POST">
            <div class="text-center">
                <a class="navbar-brand fw-bold fs-2" href=""><span class="text-secondary">Wear</span>Shoes</a>
            </div>

            <?php if (isset($_GET['error'])) {
                if ($_GET['error'] == 'invalid_login') {
                    echo '<div class="alert alert-danger mt-3 text-center">Invalid username or password.</div>';
                }
            } ?>
            <div class="form-floating mt-4">
                <input type="text" name="username" class="form-control" id="username" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mt-2">
                <input type="password" name="password" class="form-control" id="password" required>
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-4" name="login-btn" type="submit">Sign in</button>
        </form>
        <p class="mt-3 text-center">Looking for product? <a class="text-decoration-none" href="./">Back to home</a>
    </main>
</body>

</html>