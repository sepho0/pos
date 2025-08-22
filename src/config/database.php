<?php
$host     = 'localhost';
$database = 'e-commerce';
$user     = 'root';
$password = 'root';
$port     = 3306;
$socket   = '/Applications/MAMP/tmp/mysql/mysql.sock';

$conn = new mysqli($host, $user, $password, $database, $port, $socket);


if ($conn->connect_error) {
    die("Connection failed : " . $conn->connect_error);
}
?>
