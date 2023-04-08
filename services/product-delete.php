<?php

require_once 'authorization.php';
require_once "../db/database.php";
$db = new Database();

if (isset($_POST["delete-btn"])) {
    $id = $_POST["id"];

    $images = $db->getImagesByProductId($id);

    foreach ($images as $image) {
        unlink("../public/img/products/$image->image");
    }

    if (!$db->destroyImagesByProductId($id)) {
        echo "Error on delete images";
    }

    if (!$db->destroy($id)) {
        echo "Error on delete data";
    }

    header("location: ../dashboard.php");
}
