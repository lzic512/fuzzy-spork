<?php
$servername = "localhost";
$username = "lzic";
$password = "Whats.Up.You.1!?";
$dbname = "bookDatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT authors, title FROM allBooks12";
$result = $conn->query($sql);

$books = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($books);
?>

