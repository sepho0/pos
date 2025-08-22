<?php
session_start();
include("../config/database.php");

$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['quantity'];

    
    $res = $connexion->query("SELECT * FROM transactions WHERE id = $transaction_id");
    $old = $res->fetch_assoc();

   
    if ($old['product_id'] != $product_id) {
        $connexion->query("UPDATE product SET stock = stock + {$old['quantity']} WHERE id = {$old['product_id']}");
        $connexion->query("UPDATE product SET stock = stock - $new_quantity WHERE id = $product_id");
    } else {
        $diff = $new_quantity - $old['quantity'];
        $connexion->query("UPDATE product SET stock = stock - $diff WHERE id = $product_id");
    }

 
    $price = $connexion->query("SELECT price FROM product WHERE id = $product_id")->fetch_assoc()['price'];
    $total = $price * $new_quantity;

    $connexion->query("UPDATE transactions SET product_id = $product_id, quantity = $new_quantity, total = $total WHERE id = $transaction_id");

    
    header("Location: transaction.php?message=Transaction+updated+successfully");
    exit;
}


$transaction = $connexion->query("SELECT * FROM transactions WHERE id = $id")->fetch_assoc();
$products = $connexion->query("SELECT * FROM product");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2>Edit Transaction</h2>

    <form method="POST" class="row g-3">
        <input type="hidden" name="transaction_id" value="<?= $transaction['id'] ?>">
        <div class="col-md-6">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <?php while($row = $products->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>" <?= $transaction['product_id'] == $row['id'] ? 'selected' : '' ?>>
                        <?= ($row['name']) ?> (<?= $row['price'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="<?= $transaction['quantity'] ?>" min="1" required>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <
