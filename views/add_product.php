<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
<link rel="stylesheet" href="../css/style.css">
</head>

<?php

include __DIR__ . '/../config/database.php';
include __DIR__ . '/includes/sidebar.php'; 
include("includes/navbar.php");

if(isset($_POST['submit'])){
    $name = $connexion->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    $sql = "INSERT INTO product (name, price, quantity) VALUES ('$name', $price, $quantity)";
    if($connexion->query($sql)){
        echo "Product added!";
    } else {
        echo "Error: " . $connexion->error;
    }
}
?>
<div style="margin-left: 220px; padding-top: 70px;">
    <div class="container-fluid">
    <h1>Add New Product</h1>
<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Price: <input type="number" step="0.01" name="price" required><br><br>
    Quantity: <input type="number" name="quantity" required><br><br>
    <input type="submit" name="submit" value="Add Product">
</form>
    </div>
</div>


<?php include __DIR__ . '/includes/footer.php';?>

