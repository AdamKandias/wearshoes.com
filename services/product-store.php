<?php

require_once 'authorization.php';
require_once "../db/database.php";
$db = new Database();

require_once "../utils/utils.php";
require_once("../utils/slug.php");
require_once("../utils/uuid.php");

if (isset($_POST["create-btn"])) {
    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    $price = htmlspecialchars($_POST["price"]);
    $color = htmlspecialchars($_POST["color"]);
    $size = htmlspecialchars(implode(',', $_POST["size"]));
    $weight = htmlspecialchars($_POST["weight"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    $category_id = htmlspecialchars($_POST["category"]);

    $files = Utils::CollectUploadedFiles($_FILES['images']);
    if (!Utils::FilesValidation($files)) {
        echo "Gambar harus berekstensi jpg, jpeg, atau png dan tidak boleh lebih dari 1 MB";
    }

    $id = Uuid::GenerateUuid();
    $slug = Slug::SlugGenerator($name);

    $data = [
        "id" => $id,
        "name" => $name,
        "slug" => $slug,
        "description" => $description,
        "price" => $price,
        "color" => $color,
        "size" => $size,
        "weight" => $weight,
        "quantity" => $quantity,
        "category_id" => $category_id
    ];

    if (!$db->insert($data)) {
        echo "Error on insert data";
    }

    if (!$db->insertImages($files, $id)) {
        echo "Error on insert image";
    }

    Utils::MoveStoredImage($files);

    header("location: ../dashboard.php");
}
