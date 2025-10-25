<?php
// $conn = new mysqli('localhost', 'root', '', 'peso_3c');
// $conn = new mysqli('localhost', 'u686565759_peso_admin', 'PESO4c2025', 'u686565759_peso_smb');
require_once __DIR__ . '/../vendor/autoload.php'; 
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$servername = $_ENV['DB_HOST'];
$username   = $_ENV['DB_USER'];
$password   = $_ENV['DB_PASS'];
$database   = $_ENV['DB_NAME'];

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>