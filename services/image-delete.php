<?php

require_once 'authorization.php';
require_once "../db/database.php";
$db = new Database();

if (isset($_POST["delete-btn"])) {
    $id = $_POST["id"];

    $images = $db->getImagesById($id);

    unlink("../public/img/products/$images->image");

    if (!$db->destroyImagesById($images->id)) {
        echo "Error on delete image";
    }

    header("location: " . $_SERVER['HTTP_REFERER']);
}
