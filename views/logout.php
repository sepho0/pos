 
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
<link rel="stylesheet" href="../css/style.css">
</head

<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
