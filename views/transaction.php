<?php
session_start();
include("../config/database.php");
include("includes/navbar.php");
include("includes/sidebar.php");

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);


$products_result = $connexion->query("SELECT * FROM product");


if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'] ?? 0;
    $quantity = $_POST['quantity'] ?? 0;

    if ($product_id && $quantity > 0) {
       
        $product_res = $connexion->query("SELECT price FROM product WHERE id = $product_id");
        $product = $product_res->fetch_assoc();
        $total = $product['price'] * $quantity;

       
        $connexion->query("INSERT INTO transactions (product_id, quantity, total, date) VALUES ($product_id, $quantity, $total, NOW())");

      
        $connexion->query("UPDATE product SET stock = stock - $quantity WHERE id = $product_id");

        $_SESSION['message'] = "<div id='successMessage' class='alert alert-success'>Transaction added successfully!</div>";
        header("Location: transaction.php");
        exit();
    } else {
        $message = "<div class='alert alert-danger'>Please fill in the form correctly.</div>";
    }
}


$transactions = $connexion->query("
    SELECT t.id, t.product_id, p.name as product_name, t.quantity, t.total, t.date
    FROM transactions t
    JOIN product p ON t.product_id = p.id
    ORDER BY t.date DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div style="margin-left: 240px; padding-top: 70px;">
    <div class="container-fluid">
        <h1 class="mb-4">Transactions</h1>

       
        <?= $message ?>

        
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="product_id" class="form-label">Product</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">--Select Product--</option>
                            <?php while ($row = $products_result->fetch_assoc()): ?>
                                <option value="<?= $row['id'] ?>">
                                    <?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['price']) ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="1" class="form-control" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" name="submit" class="btn btn-primary w-100">Add Transaction</button>
                    </div>
                </form>
            </div>
        </div>

      
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-3">Transaction History</h2>
                <table class="table table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $transactions->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['product_name']) ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td><?= $row['total'] ?></td>
                                <td><?= $row['date'] ?></td>
                                <td>
                                    <a href="edit_transaction.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="delete_transaction.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if ($transactions->num_rows === 0): ?>
                            <tr>
                                <td colspan="6" class="text-center">No transactions yet</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    setTimeout(() => {
        const alert = document.getElementById('successMessage');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>

</body>
</html>
