<?php
$servername = "localhost";
$username = "lzic";
$password = "Whats.Up.You.1!?";
$dbname = "bookDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, text FROM Strings ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>String</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["text"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No results found";
}
$conn->close();
?>

