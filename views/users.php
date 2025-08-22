<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
		<link rel="stylesheet" href="../css/style.css">
</head

	<?php

	$message = $_SESSION['message'] ?? '';
	unset($_SESSION['message']);

	session_start();
	include("../config/database.php");
	include("includes/navbar.php");
	include("includes/sidebar.php");

	$users = $connexion->query("SELECT u.id, u.username, r.role_name FROM users u LEFT JOIN roles r ON u.role = r.id");
	?>
	<div style="margin-left: 240px; padding-top: 70px;">

<div class="container-fluid">

	<a href="add_user.php" class="btn btn-primary mb-3">Add User</a>

	<h1>Users</h1>
	<table class="table table-bordered mt-3">
		<thead>
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>Role</th>
				<th>Action</th>
			</tr>

		</thead>
		<tbody>
			<?php while ($row = $users->fetch_assoc()): ?>
				<tr>
					<td><?= $row['id'] ?></td>
					<td><?= $row['username'] ?></td>
					<td><?= $row['role_name'] ?></td>
					<td>
						<a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
					</td>

				</tr>

				<?= $message ?>

			<?php endwhile; ?>
		</tbody>
	</table>
</div>
</div>