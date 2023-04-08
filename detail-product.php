<?php
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
    <link rel="stylesheet" href="assets/css/detail-product.css">
    <!-- Bootstrap Icon Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title><?= $product->name ?> | Wearshoes</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top px-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-2" href="./"><span class="text-secondary">Wear</span>Shoes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarSupportedContent">
                <form action="" class="d-flex mx-auto mx-lg-0 ms-lg-auto col-12 col-sm-8 col-md-6" role="search">
                    <input class="form-control" type="search" placeholder="Search something here...">
                    <button class="btn btn-search d-flex" type="submit">SEARCH<i class="ms-1 bi bi-search"></i></button>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mt-2 mt-lg-0 mb-lg-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pt-4">
        <div class="detail-product card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="col-12 pt-1 pt-sm-0">
                        <img src="public/img/products/<?= $images[0]->image ?>" class="product-image img-fluid" alt="Product Image">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        <div class="product-image-thumb active"><img src="public/img/products/<?= $images[0]->image ?>" alt="Product Image" class="img-fluid"></div>
                        <?php for ($i = 1; $i < count($images); $i++) { ?>
                            <div class="product-image-thumb"><img src="public/img/products/<?= $images[$i]->image ?>" alt="Product Image" class="img-fluid">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-12 mt-4">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th class="col-3 text-center" scope="row">Category</th>
                                    <td class="ps-3"><?= $product->category ?> Shoes</td>
                                </tr>
                                <tr>
                                    <th class="col-3 text-center" scope="row">Color</th>
                                    <td class="ps-3"><?= str_replace(",", ", ", $product->color) ?></td>
                                </tr>
                                <tr>
                                    <th class="col-3 text-center" scope="row">Weight</th>
                                    <td class="ps-3"><?= $product->weight ?> gr</td>
                                </tr>
                                <tr>
                                    <th class="col-3 text-center" scope="row">Size</th>
                                    <td class="ps-3"><?= str_replace(",", ", ", $product->size) ?></td>
                                </tr>
                                <tr>
                                    <th class="col-3 text-center" scope="row">Stock</th>
                                    <td class="ps-3"><?= $product->quantity ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="description col-12 col-sm-6 mt-4 mt-sm-0">
                    <h3 class="fw-bold"><?= $product->name ?></h3>
                    <h5 class="my-2 fw-bold">$<?= number_format($product->price) ?></h5>
                    <div class="star mt-1 mb-3">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p><?= $product->description ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container mt-5 pb-5">
        <h2 class="text-center mb-5 fw-bold">Related Products</h2>
        <div class="row">
            <div class="product-card col-md-3 col-6 mb-4">
                <a href="detail-product.php">
                    <div class="card h-100 product-shadow shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img src="assets/img/product-1.png" class="img-fluid" alt="product-image">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="fw-semibold">Nike Legend Essential 3 Next Nature</h6>
                            <div class="star mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="price">
                                <h5 class="mb-0 fw-bold">$386.66</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="product-card col-md-3 col-6 mb-4">
                <a href="detail-product.php">
                    <div class="card h-100 product-shadow shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img src="assets/img/product-3.png" class="img-fluid" alt="product-image">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="fw-semibold">Nike Legend Essential 3 Next Nature</h6>
                            <div class="star mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="price">
                                <h5 class="mb-0 fw-bold">$386.66</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="product-card col-md-3 col-6 mb-4">
                <a href="detail-product.php">
                    <div class="card h-100 product-shadow shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img src="assets/img/product-7.png" class="img-fluid" alt="product-image">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="fw-semibold">Nike Legend Essential 3 Next Nature</h6>
                            <div class="star mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="price">
                                <h5 class="mb-0 fw-bold">$386.66</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="product-card col-md-3 col-6 mb-4">
                <a href="detail-product.php">
                    <div class="card h-100 product-shadow shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img src="assets/img/product-2.png" class="img-fluid" alt="product-image">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="fw-semibold">Nike Legend Essential 3 Next Nature</h6>
                            <div class="star mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="price">
                                <h5 class="mb-0 fw-bold">$386.66</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container-fluid">
            <div class="footer pt-5 pb-0 pb-md-5 d-block d-md-flex">
                <div class="col text-center text-light mb-5 mb-md-0">
                    <div class="footBrand fw-semibold fs-2">
                        <span style="color: #38BDF8;">Wear</span><span>Shoes</span>
                    </div>
                    <div class="fw-semibold fs-4 my-3">
                        Contact Me
                    </div>
                    <div class="footer-email-item mb-1">
                        info@wearshoes.com
                    </div>
                    <div class="footer-address-item">
                        New Zealand, Amsterdam, Kalipuro,<br>Mugiwara Street, Wano village
                    </div>
                </div>
                <div class="col text-center text-light mb-5 mb-md-0">
                    <div class="fw-semibold fs-4 mb-3">
                        Categories
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Kursi
                        </span>
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Meja
                        </span>
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Sofa
                        </span>
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Electronic
                        </span>
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Almari
                        </span>
                    </div>
                    <div class="footer-item">
                        <span>
                            Lainnya
                        </span>
                    </div>
                </div>
                <div class="col text-center text-light mb-5 mb-md-0">
                    <div class="fw-semibold fs-4 mb-3">
                        Legal
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Claim
                        </span>
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Privacy
                        </span>
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Policy
                        </span>
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Terms
                        </span>
                    </div>
                    <div class="footer-item mb-1">
                        <span>
                            Copyright
                        </span>
                    </div>
                </div>

            </div>
            <div class="line"></div>
            <div class="py-4">
                <div class="d-flex text-light gap-3 justify-content-center">
                    <div><i class="bi-facebook sosmed-icon"></i></div>
                    <div><i class="bi-twitter sosmed-icon"></i></div>
                    <div><i class="bi-instagram sosmed-icon"></i></div>
                    <div><i class="bi-linkedin sosmed-icon"></i></div>
                    <div><i class="bi-telegram sosmed-icon"></i></div>
                </div>
                <div class="text-muted text-center mt-2">
                    ©Wearshoes.com | Made with ❤️️ by <span class="text-secondary">Adam Kandias</span>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    const thumbs = document.querySelectorAll('.product-image-thumb');

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Menghapus class active dari semua image thumb
            thumbs.forEach(t => t.classList.remove('active'));

            // Menambahkan class active pada image thumb yang diklik
            this.classList.add('active');
        });
    });

    const productImage = document.querySelector('.product-image');

    document.querySelectorAll('.product-image-thumb').forEach(thumb => {
        thumb.addEventListener('click', () => {
            const imageSrc = thumb.querySelector('img').getAttribute('src');
            productImage.setAttribute('src', imageSrc);

            document.querySelector('.product-image-thumb.active').classList.remove('active');
            thumb.classList.add('active');
        });
    });
</script>

</html>