<?php
require_once "db/database.php";
$db = new Database();

$randomProduct = $db->getSingleRandomProduct();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Css For This Page -->
    <link rel="stylesheet" href="assets/css/homepage.css">
    <!-- Bootstrap Icon Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Home | Wearshoes</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top px-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-2" href=""><span class="text-secondary">Wear</span>Shoes</a>
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
                        <a class="nav-link active" aria-current="page" href="./">Home</a>
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

    <div class="container-fluid col-xxl-8 px-5 pb-5 pt-0 pt-lg-5 hero">
        <div class="container">
            <div class="row flex-lg-row-reverse align-items-center justify-content-center">
                <div class="col-10 col-sm-8 col-lg-5">
                    <img src="public/img/products/<?= $randomProduct->image ?>" class="d-block mx-auto mx-lg-0 ms-lg-auto img-fluid" alt="hero-image" width="400" loading="lazy">
                </div>
                <div class="col-lg-7 text-lg-start text-center">
                    <span>Best Selling!</span>
                    <h1>Best Top Collection</h1>
                    <p>Get your best footwear, cool, comfortable<br>and fresh design</p>
                    <a href="detail-product.php?product=<?= $randomProduct->slug ?>"><button type="button" class="btn btn-shop btn-lg fw-bold mt-4">SEE
                            NOW</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="feature row row-cols-1 row-cols-lg-3">
            <div class="col">
                <div class="feature-1 d-flex align-items-center justify-content-center gap-3 mb-3 p-3">
                    <i class="bi bi-truck fs-1"></i>
                    <div class="d-flex flex-column">
                        <h3 class="fs-5 fw-semibold m-0 p-0">Free Shipping</h3>
                        <p class="m-0 p-0">Free shipping on all orders</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="feature-2 d-flex align-items-center justify-content-center gap-3 mb-3 p-3">
                    <i class="bi bi-clock fs-1"></i>
                    <div class="d-flex flex-column">
                        <h3 class="fs-5 fw-semibold m-0 p-0">Online Support</h3>
                        <p class="m-0 p-0">Online Suppurt 24 hours a day</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="feature-3 d-flex align-items-center justify-content-center gap-3 mb-3 p-3">
                    <i class="bi bi-cash-coin fs-1"></i>
                    <div class="d-flex flex-column">
                        <h3 class="fs-5 fw-semibold m-0 p-0">Money Returns</h3>
                        <p class="m-0 p-0">Back guarantee under 5 days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-5">
        <h2 class="text-center mb-5 fw-bold">Our Latest Product</h2>
        <div class="row">
            <?php
            $products = $db->fetchNewestProducts();
            foreach ($products as $product) { ?>
                <div class="product-card col-md-3 col-6 mb-4">
                    <div class="card h-100 product-shadow shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img src="public/img/products/<?= $product->image ?>" class="img-fluid card-img-top" alt="product-image">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="fw-semibold mb-2"><?= $product->name ?></h6>
                            <div class="d-flex justify-content-center align-items-center price gap-1">
                                <h5 class="mb-0 fw-bold">$<?= number_format($product->price / 100, 2, '.', ',') ?></h5>
                            </div>
                            <div class="star mt-1 mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <a href="detail-product.php?product=<?= $product->slug ?>"><button type="button" class="btn btn-primary">See Now</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container pt-2 pt-sm-5">
        <a href="detail-product.php"><img class="img-fluid" src="assets/img/banner.png" alt="banner-image"></a>
    </div>

    <div class="container py-5 mt-0 mt-sm-3">
        <h2 class="text-center mb-5 fw-bold">Our Latest Product</h2>
        <div class="row row-cols-2 row-cols-lg-3 g-3 g-md-4 justify-content-center">
            <div class="col">
                <a href="" class="position-relative category-card">
                    <img src="assets/img/sports-category.png" class="img-fluid category rounded" alt="sports-category">
                    <h1 class="center-overlay">SPORTS</h1>
                </a>
            </div>
            <div class="col">
                <a href="" class="position-relative category-card">
                    <img src="assets/img/classic-category.png" class="img-fluid category rounded" alt="sports-category">
                    <h1 class="center-overlay">CLASSIC</h1>
                </a>
            </div>
            <div class="col">
                <a href="" class="position-relative category-card">
                    <img src="assets/img/casual-category.png" class="img-fluid category rounded" alt="sports-category">
                    <h1 class="center-overlay">CASUAL</h1>
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-4 pb-5">
        <h2 class="text-center mb-5 fw-bold">Shop Now</h2>
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
            <div class="product-card col-md-3 col-6 mb-4">
                <a href="detail-product.php">
                    <div class="card h-100 product-shadow shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img src="assets/img/product-5.png" class="img-fluid" alt="product-image">
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
            <div class="product-card col-md-3 col-6 mb-4">
                <a href="detail-product.php">
                    <div class="card h-100 product-shadow shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img src="assets/img/product-4.png" class="img-fluid" alt="product-image">
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
                                <img src="assets/img/product-5.png" class="img-fluid" alt="product-image">
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
                                <img src="assets/img/product-6.png" class="img-fluid" alt="product-image">
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
                    <div class="footer-item fs-5 mb-1">
                        info@wearshoes.com
                    </div>
                    <div class="footer-item">
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

</html>