<?php

require_once 'authorization.php';
require_once "../db/database.php";
$db = new Database();

if (isset($_POST["delete-btn"])) {
    $id = $_POST["id"];

    if (!$db->destroyContactUsById($id)) {
        echo "Error on delete message";
    }

    header("location: ../messages.php");
}
