<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
<link rel="stylesheet" href="../css/style.css">
</head>

<?php
session_start();
include("../config/database.php");
include("includes/navbar.php");
include("includes/sidebar.php");




$users_count = $connexion->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$products_count = $connexion->query("SELECT COUNT(*) as total FROM product")->fetch_assoc()['total'];
$transactions_count = $connexion->query("SELECT COUNT(*) as total FROM transactions")->fetch_assoc()['total'];
$currency_count = $connexion->query("SELECT COUNT(*) as total FROM currency")->fetch_assoc()['total'];
?>

<div style="margin-left: 220px; padding-top: 70px;">
  <div class="container-fluid">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div class="card text-white bg-primary mb-3">
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <p class="card-text"><?= $users_count ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card text-white bg-success mb-3">
          <div class="card-body">
            <h5 class="card-title">Products</h5>
            <p class="card-text"><?= $products_count ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card text-white bg-warning mb-3">
          <div class="card-body">
            <h5 class="card-title">Transactions</h5>
            <p class="card-text"><?= $transactions_count ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card text-white bg-info mb-3">
          <div class="card-body">
            <h5 class="card-title">Currency</h5>
            <p class="card-text"><?= $currency_count ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
