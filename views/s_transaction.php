<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
<link rel="stylesheet" href="../css/style.css">
</head

<?php
include("../config/database.php"); 
include("includes/navbar.php");
include("includes/sidebar.php");

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {

    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    
    $product_query = $connexion->query("SELECT * FROM product WHERE id = $product_id");
    $product = $product_query->fetch_assoc();

    if ($product && $product['quantity'] >= $quantity) {
        $total = $product['price'] * $quantity;

        
        $stmt = $connexion->prepare("INSERT INTO transactions (product_id, quantity, total, date) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iid", $product_id, $quantity, $total);
        $stmt->execute();

        
        $new_quantity = $product['quantity'] - $quantity;
        $connexion->query("UPDATE product SET quantity = $new_quantity WHERE id = $product_id");

        $message = "✅ Transaction completed successfully!";
        $msgClass = "success";
    } else {
        $message = "❌ Not enough stock for this product.";
        $msgClass = "error";
    }
} else {
    $message = "⚠️ Please fill out the form correctly.";
    $msgClass = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Transaction</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <p class="<?= $msgClass ?>"><?= $message ?></p>
    <a href="transaction.php">Back to Transactions</a>
</body>
</html>

