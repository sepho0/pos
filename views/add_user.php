<?php
session_start();
include("../config/database.php");


$error = "";


$roles = $connexion->query("SELECT id, role_name FROM roles");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($username) && !empty($password) && !empty($role)) {
        
        $check = $connexion->prepare("SELECT id FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "<div class='alert alert-danger'>This username already exists. Please choose another.</div>";
        } else {
           
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            
            $stmt = $connexion->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $username, $hashedPassword, $role);
            $stmt->execute();

            $_SESSION['message'] = "<div id='successMessage' class='alert alert-success'>User added successfully!</div>";
            header("Location: users.php");
            exit();
        }
    } else {
        $error = "<div class='alert alert-danger'>All fields are required.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Add New User</h2>

    <?= $error ?>

    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
            <div class="form-text">Minimum 6 characters</div>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
            <select name="role" id="role" class="form-select" required>
                <option value="">-- Select Role --</option>
                <?php while ($r = $roles->fetch_assoc()): ?>
                    <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['role_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Add User</button>
            <a href="users.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

    <script>
        
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>
</body>
</html>
