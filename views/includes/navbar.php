<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
		<link rel="stylesheet" href="../css/style.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>



<?php




$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? '';


?>

<body class="d-flex flex-column" style="min-height: 100vh;">

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="dashboard.php">POS App</a>
			<div class="collapse navbar-collapse justify-content-end" id="navbarContent">
				<ul class="navbar-nav">
					<li class="nav-item">
						<span class="nav-link">Welcome, <?= $username ?? '' ?> (<?= $_SESSION['role'] ?? '' ?>)</span>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>