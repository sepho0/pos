<?php
session_start();
include("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {

        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

        if ($connexion->query($sql) === TRUE) {
            $_SESSION['success_message'] = "User registered successfully!";
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error: " . $connexion->error;
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div style="margin-left: 220px; padding-top: 70px;">
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form method="POST" class="p-4 rounded shadow" style="width: 350px; background-color:white;">
        <h2 class="text-center mb-4">Register</h2>

        <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        
        <button type="submit" name="submit" class="btn btn-success w-100">Register</button>
    </form>
</div>
</div>

</body>
</html>
