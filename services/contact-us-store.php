<?php

require_once "../db/database.php";
require_once "../utils/utils.php";
$db = new Database();

if (isset($_POST["create-btn"])) {
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    if (!Utils::EmailValidation($email)) {
        header('location: ../about.php?error=email_invalid');
        exit();
    }

    $data = [
        "email" => $email,
        "subject" => $subject,
        "message" => $message,
    ];

    if (!$db->insertContactUs($data)) {
        echo "Error on insert contact us data";
    }

    header("location: ../about.php?status=success");
}
