<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
<link rel="stylesheet" href="../css/edit.css">
</head>


<?php
include __DIR__ . '/../config/database.php';

$product = [
    'id' => '',
    'name' => '',
    'price' => '',
    'quantity' => ''
];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $connexion->query("SELECT * FROM product WHERE id = $id");

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }
}

if (isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $name = $connexion->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    $sql = "UPDATE product SET name='$name', price=$price, quantity=$quantity WHERE id=$id";

    if ($connexion->query($sql)) {
        $success = "Product updated successfully!";
        header("refresh:2;url=product.php"); 
    } else {
        $error = "Error: " . $connexion->error;
    }
}
?>


    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="bg-light p-4 rounded shadow" style="width: 400px;">
            <h3 class="text-center mb-4">Edit Product</h3>

            <?php if (isset($success)) : ?>
                <div id="successMessage" class="alert alert-success text-center"><?php echo $success; ?></div>
            <?php elseif (isset($error)) : ?>
                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Update Product</button>
            </form>
        </div>
    </div>


<script>
    
    setTimeout(() => {
        const msg = document.getElementById('successMessage');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 2000);
</script>

