<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
<link rel="stylesheet" href="../css/style.css">
</head

<?php
include("../config/database.php");
include("includes/navbar.php");
include("includes/sidebar.php");

if(isset($_POST['submit'])){
    $name = $connexion->real_escape_string($_POST['name']);
    $symbol = $connexion->real_escape_string($_POST['symbol']);
    $code = $connexion->real_escape_string($_POST['code']);

    $connexion->query("INSERT INTO currency (name, symbol, code) VALUES ('$name', '$symbol', '$code')");
}


$result = $connexion->query("SELECT * FROM currency");
?>

<div style="margin-left: 220px; padding-top: 70px;">
    <div class="container-fluid">
    <h1>Manage Currency</h1>

<form method="POST">
    Name: <input type="text" name="name" required>
    Symbol: <input type="text" name="symbol" required>
    Code: <input type="text" name="code" required>
    <input type="submit" name="submit" value="Add Currency">
</form>

<h2>Existing Currencies</h2>
<div class="table-responsive">
<table class="table table-striped table-bordered align-middle">
  <thead class="table-info">
  <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Symbol</th>
        <th>Code</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['symbol'] ?></td>
            <td><?= $row['code'] ?></td>
        </tr>
    <?php endwhile; ?>
  </tbody>
  
</table>
</div>

    </div>
</div>

