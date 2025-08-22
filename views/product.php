<?php 
session_start();
?>
<script>
  setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
      alert.style.transition = "opacity 0.5s ease-out";
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    });
  }, 3000); 
</script>


<?php
include("../config/database.php");
include("includes/navbar.php");
include("includes/sidebar.php");


$result = $connexion->query("SELECT * FROM product");
?>


<div style="margin-left: 220px; padding-top: 70px;">
  <div class="container-fluid">

    <h1 class="mb-4">Products</h1>

    <a href="add_product.php" class="btn btn-primary mb-3">Add New Product</a>
    
    <?php

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success text-center">' . htmlspecialchars($_SESSION['success']) . '</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger text-center">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
}
?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['price']; ?></td>
            <td><?= $row['quantity']; ?></td>
            <td>
              <a href="edit_product.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="delete_product.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    
  </div>
</div>

