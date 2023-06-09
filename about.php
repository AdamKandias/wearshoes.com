<?php
require_once "db/database.php";
require_once "utils/utils.php";
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
    <title>About Us | Wearshoes</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top px-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-2" href=""><span class="text-secondary">Wear</span>Shoes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarSupportedContent">
                <form action="products.php" class="d-flex mx-auto mx-lg-0 ms-lg-auto col-12 col-sm-8 col-md-6" role="search">
                    <input name="search" class="form-control" type="search" placeholder="Search something here...">
                    <button class="btn btn-search d-flex" type="submit">SEARCH<i class="ms-1 bi bi-search"></i></button>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mt-2 mt-lg-0 mb-lg-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h2 class="text-center mb-3 fw-bold">About Us</h2>
        <div class="row content py-3 d-flex flex-row justify-content-center gap-4">
            <div class="col-md-5 card p-4 shadow">
                <p>
                    Welcome to Wearshoes.com, shoe catalog website! We are dedicated to providing you with the best selection of footwear. Our extensive collection includes shoes for men, women, and children, covering a wide range of styles, sizes, and brands.
                </p>
                <ul class="ps-2">
                    <li class="list-group-item"><i class="bi bi-check2-all"></i> Discover the latest shoe trends and fashion-forward designs</li>
                    <li class="list-group-item"><i class="bi bi-check2-all"></i> Find shoes for every occasion, from casual outings to formal events</li>
                    <li class="list-group-item"><i class="bi bi-check2-all"></i> Enjoy a seamless shopping experience with our user-friendly interface</li>
                    <li class="list-group-item"><i class="bi bi-check2-all"></i> Benefit from our fast and reliable delivery services</li>
                </ul>
            </div>
            <div class="col-md-5 card p-4 shadow">
                <p>
                    At our shoe catalog website, we are passionate about footwear. We offer an extensive collection of shoes from top brands, ranging from sneakers and sandals to boots and formal shoes. Each product in our catalog is carefully curated to provide you with the latest trends and timeless classics.
                </p>
                <p>
                    Our detailed product pages provide comprehensive information about each shoe, including material, color options, sizes available, and customer reviews. We believe in delivering the highest quality shoes that combine style, comfort, and durability.
                </p>
                <p>
                    Whether you need shoes for a casual day out, a special event, or sports activities, our catalog has something for everyone. Browse through our collection and find the perfect pair that suits your style and meets your needs.
                </p>
            </div>
        </div>
    </div>


    <div class="container py-5">
        <h2 class="text-center mb-4 fw-bold">Contact Us</h2>
        <div class="card py-4 shadow">
            <div class="card-body row">
                <div class="col-md-5 mb-3 mb-md-0 text-center d-flex align-items-center justify-content-center">
                    <div class="">
                        <h2 class="fw-bold"><span style="color: #38BDF8;">Wear</span>Shoes</h2>
                        <p class="lead">+62893 New Zealand, Amsterdam, Kalipuro,<br>Mugiwara Street, Wano Village
                        </p>
                    </div>
                </div>
                <div class="col-md-7">
                    <form action="services/contact-us-store.php" method="post">
                        <?php if (isset($_GET['error'])) {
                            if ($_GET['error'] == 'email_invalid') {
                                echo '<div class="alert alert-danger mt-3 text-center">Email tidak valid!</div>';
                            }
                        } ?>
                        <?php if (isset($_GET['status'])) {
                            if ($_GET['status'] == 'success') {
                                echo '<div class="alert alert-success mt-3 text-center">Berhasil mengirim pesan, terimakasih!</div>';
                            }
                        } ?>
                        <div class="form-group mt-3">
                            <label class="form-label fw-semibold" for="email">E-Mail</label>
                            <input type="email" id="email" name="email" class="form-control" required />
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label fw-semibold" for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" required />
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label fw-semibold" for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="6"></textarea>
                        </div>
                        <div class="form-group mt-4">
                            <input type="submit" name="create-btn" class="btn btn-primary">
                        </div>
                    </form>
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

</html>