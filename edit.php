<?php
require_once './services/authorization.php';
require_once "db/database.php";
$db = new Database();
$product = $db->getProductBySlug($_GET["product"]);
$images = $db->getImagesByProductId($product->id);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Css For This Page -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <!-- Bootstrap Icon Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Detail Product | Wearshoes</title>
</head>

<style>
    output {
        width: 100%;
        min-height: 150px;
        display: none;
        justify-content: flex-start;
        flex-wrap: wrap;
        gap: 15px;
        position: relative;
        border-radius: 5px;
    }

    output .image {
        height: 150px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        position: relative;
    }

    output .image img {
        height: 100%;
        width: 100%;
    }

    output .image span {
        position: absolute;
        top: -4px;
        right: 4px;
        cursor: pointer;
        font-size: 22px;
        color: white;
    }

    output .image span:hover {
        opacity: 0.8;
    }

    output .span--hidden {
        visibility: hidden;
    }
</style>

<body>
    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-center" href="#">WEARSHOES</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky sidebar-sticky">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Dashboard</span>
                        <a class="link-secondary" href="dashboard.php" aria-label="Add a new report">
                            <span class="align-text-bottom"><i class="bi bi-speedometer"></i></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="dashboard.php">
                                <span class="align-text-bottom"><i class="bi bi-box-fill me-2"></i></span>
                                Products
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>More</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span class="align-text-bottom"><i class="bi bi-plus-circle-fill"></i></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="./">
                                <span class="align-text-bottom"><i class="bi bi-eye-fill me-2"></i></span>
                                View Catalog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="align-text-bottom"><i class="bi bi-person-fill-dash me-2"></i></span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="col-lg-10 ms-sm-auto col-md-9 mt-4 pb-5">
                <h2 class="text-center mb-4 fw-bold">Edit Product</h2>
                <div class="card p-5 shadow">
                    <form action="services/product-edit.php" method="POST" enctype="multipart/form-data" class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required value="<?= $product->name ?>">
                        </div>
                        <input type="hidden" value="<?= $product->slug ?>" name="slug">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required><?= $product->description ?></textarea>
                        </div>
                        <div class="col-md-2">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" class="form-control" id="price" name="price" required value="<?= $product->price ?>">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Size</label>
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <?php for ($i = 36; $i <= 47; $i++) { ?>
                                    <div class="form-check">
                                        <input class="form-check-input" <?= str_contains($product->size, $i) ? "checked" : "fdafsd" ?> type="checkbox" name="size[]" value="<?= $i ?>" id="<?= $i ?>">
                                        <label class="form-check-label" for="<?= $i ?>">
                                            <?= $i ?>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="weight" class="form-label">Weight (gr)</label>
                            <input type="text" class="form-control" id="weight" name="weight" required value="<?= $product->weight ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="text" class="form-control" id="stock" name="quantity" required value="<?= $product->quantity ?>">
                        </div>
                        <div class="col-md-8">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" required value="<?= $product->color ?>">
                            <small class="form-text text-muted">Separate color with a comma. example: red,blue,green,pink</small>
                        </div>
                        <div class="col-md-2">
                            <label for="category" class="form-label">Product Category</label>
                            <select name="category" id="category" class="form-select" required>
                                <?php
                                $categories = $db->fetchAllCategories();
                                foreach ($categories as $category) { ?>
                                    <option <?= $product->category == $category->category ? "selected" : "" ?> value="<?= $category->id ?>"><?= $category->category ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="images" class="form-label d-block">Images</label>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <?php foreach ($images as $image) { ?>
                                    <div class="position-relative">
                                        <img width="150" src="public/img/products/<?= $image->image ?>" alt="product-image">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-id="<?= $image->id ?>" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>

                            <?php if (count($images) < 5) { ?>
                                <input class="form-control mt-3" type="file" id="images" accept="image/jpeg, image/png, image/jpg" required value="<?= $product->name ?>" name="image">
                            <?php } ?>
                            <output></output>

                        </div>
                        <div class="col-12 d-flex justify-content-between mt-5">
                            <a href="dashboard.php" class="btn btn-secondary text-center">Back To Dashboard</a>
                            <button type="submit" name="edit-btn" class="btn btn-primary text-center">Edit Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteImageModalLabel">Delete Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead h-3">Are you sure to delete this image?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="services/image-delete.php" method="POST">
                        <input type="hidden" name="id" id="image-id">
                        <button name="delete-btn" type="submit" class="btn btn-danger">Delete Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    <?php if (count($images) < 5) { ?>
        const output = document.querySelector("output")
        const input = document.querySelector("#images")

        let imagesArray = []

        input.addEventListener("change", () => {
            output.style.display = "flex";
            const files = input.files
            for (let i = 0; i < files.length; i++) {
                imagesArray.push(files[i])
            }
            displayImages()
        })

        function displayImages() {
            let images = ""
            imagesArray.forEach((image, index) => {
                images += `<div class="image mt-3 mx-auto">
                <img src="${URL.createObjectURL(image)}" alt="image">
                <span onclick="deleteImage(${index})">&times;</span>
                </div>`
            })
            output.innerHTML = images
        }

        function deleteImage(index) {
            imagesArray.splice(index, 1)
            displayImages()
        }
    <?php } ?>

    var deleteModal = document.querySelector('#deleteImageModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        console.log(button);
        var imageId = button.getAttribute('data-image-id');
        var modal = event.target; // Modal
        modal.querySelector('.modal-footer #image-id').value = imageId;
    });
</script>
</script>


</html>