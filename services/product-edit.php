<?php

require_once 'authorization.php';
require_once "../db/database.php";
$db = new Database();

require_once "../utils/utils.php";
require_once("../utils/slug.php");
require_once("../utils/uuid.php");

if (isset($_POST["edit-btn"])) {
    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    $price = htmlspecialchars($_POST["price"]);
    $color = htmlspecialchars($_POST["color"]);
    $size = htmlspecialchars(implode(',', $_POST["size"]));
    $weight = htmlspecialchars($_POST["weight"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    $category_id = htmlspecialchars($_POST["category"]);

    $fileName = '';

    if (isset($_FILES['image'])) {
        $fileName = Utils::ImageProcessAndUpload($_FILES['image']);
    }

    $currentProduct = $db->getProductBySlug($_POST["slug"]);

    $data = [];

    if ($currentProduct->name != $name) {
        $slug = Slug::SlugGenerator($name);
        $data[] = $name;
        $data[] = $slug;
    } else {
        $data[] = $description;
        $data[] = $price;
        $data[] = $color;
        $data[] = $size;
        $data[] = $weight;
        $data[] = $quantity;
        $data[] = $category_id;
    }

    $data[] = $currentProduct->id;

    if (!$db->edit($data)) {
        echo "Error on insert data";
    }

    if (!$db->insertImage($fileName, $currentProduct->id)) {
        echo "Error on insert image";
    }

    header("location: ../dashboard.php");
}
