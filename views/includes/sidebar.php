 <?php
$role = $_SESSION['role'] ?? '';
?>

<div class="d-flex flex-column bg-light position-fixed top-0 start-0 pt-5"
     style="width: 220px; height: 100vh; margin-top: 56px;">
  <ul class="nav flex-column p-3">
    <li class="nav-item"><a href="dashboard.php" class="nav-link link-dark">Dashboard</a></li>
    <li class="nav-item"><a href="transaction.php" class="nav-link link-dark">Transactions</a></li>
    <li class="nav-item"><a href="users.php" class="nav-link link-dark">Users</a></li>
    <li class="nav-item"><a href="product.php" class="nav-link link-dark">Products</a></li>
    <li class="nav-item"><a href="currency.php" class="nav-link link-dark">Currency</a></li>
  </ul>
</div>

