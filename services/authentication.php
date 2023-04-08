<?php

session_start();
require_once "../db/database.php";
$db = new Database();

if (isset($_POST['login-btn'])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $admin = $db->login($username);

    if ($admin) {
        if (password_verify($password, $admin->password)) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            header('location: ../dashboard.php');
            exit;
        }
    }

    header('location: ../login.php?error=invalid_login');
    exit();
}

if (isset($_POST['logout-btn'])) {
    session_unset();
    session_destroy();
    header('location: ../login.php');
    exit;
}
