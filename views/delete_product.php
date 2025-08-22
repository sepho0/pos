<?php
include __DIR__ . '/../config/database.php';
session_start();

try {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);

     
        $sql = "DELETE FROM product WHERE id = $id";
        if (!$connexion->query($sql)) {
            throw new Exception($connexion->error);
        }

        $_SESSION['success'] = "Product deleted successfully!";
    } else {
        $_SESSION['error'] = "Invalid product ID.";
    }
} catch (Exception $e) {
    $_SESSION['error'] = "An exeption error as occured" . $e->getMessage();
    // if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
    //     $_SESSION['error'] = "Cannot delete product: it is linked to other records.";
    // } else {
    //     $_SESSION['error'] = "Error deleting product: " . $e->getMessage();
    // }
}


header("Location: product.php");
exit();
