<?php
require_once './services/authorization.php';
require_once "db/database.php";
$db = new Database();
$message = $db->getContactUsById($_GET["message"]);
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
    <title>Detail Message | Wearshoes</title>
</head>

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
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span><i class="bi bi-speedometer"></i></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="dashboard.php">
                                <span><i class="bi bi-box-fill me-2"></i></span>
                                Products
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Messages</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span><i class="bi bi-envelope-exclamation-fill"></i></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="messages.php">
                                <span><i class="bi bi-envelope-fill me-2"></i></span>
                                Read Messages
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>More</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span><i class="bi bi-plus-circle-fill"></i></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="./">
                                <span><i class="bi bi-eye-fill me-2"></i></span>
                                View Catalog
                            </a>
                        </li>
                        <li class="nav-item">
                            <form class="nav-link" method="POST" action="./services/authentication.php">
                                <button name="logout-btn" class="border-0 bg-transparent ps-0 col-12 d-flex" style="font-weight: 500; color: #333;" type="submit"><span><i class="bi bi-person-fill-dash" style="margin-right: 0.75rem;"></i></span>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="col-lg-10 ms-sm-auto col-md-9 mt-4 pb-5">
                <h2 class="text-center mb-4 fw-bold">Detail Message</h2>
                <div class="card p-5 shadow">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="email" class="form-label">User Email</label>
                            <input type="text" class="form-control" id="email" name="email" readonly value="<?= $message->email ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" readonly value="<?= $message->subject ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"><?= $message->message ?></textarea>
                        </div>
                        <div class="col-12 d-flex justify-content-between mt-5">
                            <a href="messages.php" class="btn btn-secondary text-center">Back To List Messages</a>
                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger d-flex align-items-center">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead h-3">Are you sure to delete this message?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="services/contact-us-delete.php" method="POST">
                        <input type="hidden" name="id" value="<?= $message->id ?>">
                        <button name="delete-btn" type="submit" class="btn btn-danger">Delete Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="assets/js/bootstrap.min.js"></script>

</html>