<?php
session_start();
include("../config/database.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $connexion->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "User successfully deleted.";
    } else {
        $_SESSION['message'] = "Error deleting user.";
    }

    $stmt->close();
}

header("Location: users.php");
exit();

