<?php
require_once "db/database.php";
require_once "utils/utils.php";
$db = new Database();
$category = $_GET['category'] ?? '';
$search = $_GET['search'] ?? '';
$minPrice = $_GET['min-price'] ?? '';
$maxPrice = $_GET['max-price'] ?? '';
$sizes = $_GET['size'] ?? [];

$products = $db->getProductsWithFilter($category, $search, $minPrice, $maxPrice, $sizes);
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
    <title>Products | Wearshoes</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top px-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-2" href="index.php"><span class="text-secondary">Wear</span>Shoes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarSupportedContent">
                <form action="products.php" id="searchForm" class="search-form d-flex mx-auto mx-lg-0 ms-lg-auto col-12 col-sm-8 col-md-6" role="search">
                    <input id="searchInput" name="search" class="form-control" type="search" value="<?= $search ?>" placeholder="Search something here...">
                    <button class="btn btn-search d-flex" type="button" onclick="sendSearchInput()">SEARCH<i class="ms-1 bi bi-search"></i></button>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mt-2 mt-lg-0 mb-lg-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row pt-4 pb-16 mt-8">
            <!-- start sidebar -->
            <div class="col-12 col-md-3 bg-white px-4 py-4 shadow rounded mb-5">
                <form id="filterForm" action="products.php" method="get">
                    <div class="mb-3">
                        <h5 class="fw-bold">CATEGORIES</h5>
                        <div class="d-flex flex-column">
                            <!-- single category -->
                            <div class="form-check">
                                <input class="form-check-input" <?= $category == 'sport' || $category == '1' ? 'checked' : '' ?> type="checkbox" id="sport" name="category" value="1" data-name="sport" onclick="uncheckOthers(this)">
                                <label class="form-check-label" for="sport">Sport</label>
                            </div>
                            <!-- end single category -->
                            <!-- single category -->
                            <div class="form-check">
                                <input class="form-check-input" <?= $category == 'classic' || $category == '2' ? 'checked' : '' ?> type="checkbox" id="classic" name="category" value="2" data-name="classic" onclick="uncheckOthers(this)">
                                <label class="form-check-label" for="classic">Classic</label>
                            </div>
                            <!-- end single category -->
                            <!-- single category -->
                            <div class="form-check">
                                <input class="form-check-input" <?= $category == 'casual' || $category == '3' ? 'checked' : '' ?> type="checkbox" id="casual" name="category" value="3" data-name="casual" onclick="uncheckOthers(this)">
                                <label class="form-check-label" for="casual">Casual</label>
                            </div>
                            <!-- end single category -->
                        </div>

                    </div>
                    <div class="pt-4 mb-3">
                        <h5 class="fw-bold">PRICE</h5>
                        <div class="row d-flex flex-column gap-2">
                            <div class="col">
                                <input id="minPrice" type="text" value="<?= $minPrice ?>" name="min-price" class="form-control" placeholder="Min Price">
                            </div>
                            <div class="mx-auto text-center">
                                To
                            </div>
                            <div class="col">
                                <input id="maxPrice" type="text" value="<?= $maxPrice ?>" name="max-price" class="form-control" placeholder="Max Price">
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 mb-3">
                        <h5 class="mb-3 fw-bold">SIZE</h5>
                        <div class="d-flex flex-wrap gap-3">
                            <?php for ($i = 36; $i <= 47; $i++) { ?>
                                <div class="form-check">
                                    <input class="form-check-input" <?= in_array($i, $sizes) ? 'checked' : '' ?> type="checkbox" id="<?= $i ?>" name="size[]" value="<?= $i ?>">
                                    <label class="form-check-label" for="<?= $i ?>"><?= $i ?></label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <input type="hidden" id="searchInputFilter" name="search" value="<?= $search ?>">
                    <button class="btn btn-primary w-100 py-2 mt-3" onclick="sendFilterInputs()">Filter Product</button>
                </form>
            </div>
            <!-- end sidebar -->
            <!-- start main content -->
            <div class="col-12 col-md-9">
                <div class="bg-white g-0 px-4 py-3 shadow rounded">
                    <h2 class="fw-bold mb-3">PRODUCTS</h2>
                    <div class="row justify-content-center">
                        <?php if (count($products)) {
                            foreach ($products as $product) {
                        ?>
                                <div class="col-6 col-sm-4 mb-4">
                                    <a href="detail-product.php?product=<?= $product->slug ?>">
                                        <div class="card product-card">
                                            <img src="public/img/products/<?= $product->image ?>" class="card-img-top" alt="">
                                            <div class="card-body text-center">
                                                <h6 class="fw-semibold text-truncate"><?= $product->name ?></h6>
                                                <div class="price text-center">
                                                    <h5 class="my-0 fw-bold">$<?= Utils::CurrencyFormatting($product->price) ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php
                            }
                        } else {
                            echo Utils::GenerateNotFoundMessage($category, $search, $minPrice, $maxPrice, $sizes);
                        } ?>
                    </div>
                </div>
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
                        New Zealand, Amsterdam, Kalipuro,<br>Mugiwara Street, Wano Village
                    </div>
                </div>
                <div class="col text-center text-light mb-5 mb-md-0">
                    <div class="fw-semibold fs-4 mb-3">
                        Categories
                    </div>
                    <a href="products.php?category=sport">
                        <div class="footer-item mb-1">
                            <span>
                                Sports
                            </span>
                        </div>
                    </a>
                    <a href="products.php?category=classic">
                        <div class="footer-item mb-1">
                            <span>
                                Classics
                            </span>
                        </div>
                    </a>
                    <a href="products.php?category=casual">
                        <div class="footer-item mb-1">
                            <span>
                                Casuals
                            </span>
                        </div>
                    </a>
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
<script src="assets/js/products.js"></script>

</html>