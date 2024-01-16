<!DOCTYPE html>
<html>
<head>
    <title>My Database</title>
    <link rel="stylesheet" type="text/css" href="./myStyle.css">
</head>
<body>
<div class="top-section">
<div class="button-group">
    <button type="button" onclick="location.href='add.php'">Add</button>
    <button type="button" onclick="location.href='delete.php'">Remove</button>
</div>
</div>
<div class="container">
    <h1>Below is our selection</h1>
    <?php

    $servername = "localhost";
    $username = "lzic";
    $password = "Whats.Up.You.1!?";
    $dbname = "bookDatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();

    if (!isset($_SESSION['full_list']) || !isset($_SESSION['total_count'])) {
        $sql = "SELECT authors, title FROM allBooks12";
        $result = $conn->query($sql);
        if ($result) {
            $_SESSION['full_list'] = $result->fetch_all(MYSQLI_ASSOC);
            $_SESSION['total_count'] = $result->num_rows;
        } else {
            echo "Error fetching data";
        }
    }

    $pageSize = 20; 
    if (isset($_GET['page'])) {
    	$currentPage = (int)$_GET['page'];
    } else {
    	$currentPage = 1;
    }
    $offset = ($currentPage - 1) * $pageSize;
    $subset = array_slice($_SESSION['full_list'], $offset, $pageSize);

    if (count($subset) > 0) {
        echo "<table border='1'><tr><th>Authors</th><th>Title</th></tr>";
        foreach ($subset as $row) {
            echo "<tr><td>" . $row["authors"] . "</td><td>" . $row["title"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $totalPages = ceil($_SESSION['total_count'] / $pageSize);
    $startPage = max(1, $currentPage - 2); 
    $endPage = min($totalPages, $currentPage + 2); 
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            echo "<span class='current-page'>$i</span> "; 
        } else {
            echo "<a href='?page=$i' class='button'>$i</a> ";
        }
    }

    $conn->close();
    ?>
</div>
</body>
</html>

