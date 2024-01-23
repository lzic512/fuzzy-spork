<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost"; 
$username = "lzic"; 
$password = "Whats.Up.You.1!?"; 
$dbname = "bookDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Hello"
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 100; 
$offset = ($page - 1) * $limit;
$query = "SELECT * FROM your_table LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>

