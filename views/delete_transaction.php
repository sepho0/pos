<?php
session_start();
include("../config/database.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $res = $connexion->query("SELECT product_id, quantity FROM transactions WHERE id = $id");
    if ($res && $res->num_rows > 0) {
        $data = $res->fetch_assoc();

        
        $connexion->query("UPDATE product SET stock = stock + {$data['quantity']} WHERE id = {$data['product_id']}");

        
        $connexion->query("DELETE FROM transactions WHERE id = $id");

        
        $_SESSION['message'] = "<div id='successMessage' class='alert alert-success'>Transaction deleted successfully!</div>";
    }
}

header("Location: transaction.php");
exit();
