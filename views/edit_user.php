<?php
session_start();
include("../config/database.php");

$id = $_GET['id'] ?? null;

if (!$id) {
	$_SESSION['message'] = "Invalid user ID.";
	header("Location: users.php");
	exit();
}


$stmt = $connexion->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_assoc();
$stmt->close();


$roles = $connexion->query("SELECT * FROM roles");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$role = $_POST['role'];

	$update = $connexion->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
	$update->bind_param("sii", $username, $role, $id);

	if ($update->execute()) {
		$_SESSION['message'] = "User updated successfully.";
		header("Location: users.php");
		exit();
	} else {
		$_SESSION['message'] = "Error updating user.";
	}

	$update->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Edit User</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">





	

</head>

<body>
	<div class="container mt-5">
		<h1>Edit User</h1>

		<form method="POST">
			<div class="mb-3">
				<label class="form-label">Username</label>
				<input type="text" name="username" class="form-control" $users=$connexion required
					</div>
				<div class="mb-3">
					<label class="form-label">Role</label>
					<select name="role" class="form-control" $users=$connexion required>
						<?php while ($role = $roles->fetch_assoc()): ?>
							<option value="<?= $role['id'] ?>" <?= $role['id'] == $users['role'] ? 'selected' : '' ?>>
								<?= htmlspecialchars($role['role_name']) ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">Update</button>
				<a href="users.php" class="btn btn-secondary">Cancel</a>
		</form>
	</div>
</body>

</html>