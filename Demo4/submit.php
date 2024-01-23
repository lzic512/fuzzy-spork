<?php
$servername = "localhost";
$username = "lzic";
$password = "Whats.Up.You.1!?";
$dbname = "bookDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $string = $conn->real_escape_string($_POST['string']);

    $sql = "INSERT INTO Strings (text) VALUES ('$string')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<a href="form.html">Go back to form</a>

