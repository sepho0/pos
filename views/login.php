<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">

<title>Login - POS App</title>
</head>

<?php
session_start();
include("../config/database.php");


if(isset($_POST['submit'])){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $res = $connexion->query("SELECT * FROM users WHERE Username= '$username'");
    if($res && $res->num_rows > 0){
        $user = $res->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; 
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form method="POST" class="p-4 rounded shadow" style="width: 350px; background-color:white;">
        <h2 class="text-center mb-4">Login</h2>

        <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
       <a href="register.php" class="btn btn-success w-100 mt-2" >Register</a>
       
    </form>
</div>
