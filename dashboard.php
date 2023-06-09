<?php
require_once './services/authorization.php';
require_once './db/database.php';
$db = new Database();
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
  <!-- Datatables Css -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <title>Dashboard | Wearshoes</title>

</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-center" href="">WEARSHOES</a>
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
              <a class="nav-link active" aria-current="page" href="#">
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

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Products</h1>
          <div class="btn-group me-2">
            <a href="create-product.php" class="btn btn-sm btn-primary">Create New Product</a>
            <a href="./services/product-export.php" class="btn btn-sm btn-outline-secondary">Export</a>
          </div>
        </div>

        <div class="table-responsive">
          <table id="productsTable" class="table table-striped table-sm align-middle">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Stock</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $products = $db->fetchAllProducts();
              $index = 1;
              foreach ($products as $product) { ?>
                <tr>
                  <td><?= $index ?></td>
                  <td><img width="25" src="public/img/products/<?= $product->image ?>" alt="product-image"></td>
                  <td><?= $product->name ?></td>
                  <td><?= $product->category ?></td>
                  <td><?= $product->quantity ?></td>
                  <td>
                    <div class="d-flex gap-1">
                      <a target="_blank" href="detail-product.php?product=<?= $product->slug ?>" class="btn btn-sm btn-success">View</a>
                      <a href="edit.php?product=<?= $product->slug ?>" class="btn btn-sm btn-warning">Edit</a>
                      <a data-bs-toggle="modal" data-bs-target="#deleteModal" data-product-id="<?= $product->id ?>" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                  </td>
                </tr>
              <?php $index++;
              } ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <!-- modal delete -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="lead h-3">Are you sure to delete this product?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="services/product-delete.php" method="POST">
            <input type="hidden" name="id" id="product-id">
            <button name="delete-btn" type="submit" class="btn btn-danger">Delete Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>


<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/dashboard.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const table = document.querySelector("#productsTable");
    if (table) {
      new DataTable(table);
    }
  });

  var deleteModal = document.querySelector('#deleteModal');
  deleteModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    console.log(button);
    var productId = button.getAttribute('data-product-id');
    var modal = event.target; // Modal
    modal.querySelector('.modal-footer #product-id').value = productId;
  });
</script>

</html>