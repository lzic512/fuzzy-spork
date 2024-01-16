<!DOCTYPE html>
<html>
<head>
    <title>My Database</title>
    <link rel="stylesheet" type="text/css" href="./myStyle.css">
    <script>
        function displayData(data, page, pageSize) {
            const start = (page - 1) * pageSize;
            const end = start + pageSize;
            const paginatedData = data.slice(start, end);

            const container = document.getElementById('data-container');
            container.innerHTML = '<table border="1"><tr><th>Authors</th><th>Title</th></tr>';

            paginatedData.forEach(row => {
                container.innerHTML += `<tr><td>${row.authors}</td><td>${row.title}</td></tr>`;
            });
            container.innerHTML += '</table>';
        }

        function fetchData(page = 1, pageSize = 20) {
            fetch('showingData.php')
            .then(response => response.json())
            .then(data => {
                displayData(data, page, pageSize);

                // Add pagination buttons (example logic)
                const totalPages = Math.ceil(data.length / pageSize);
                const paginationContainer = document.getElementById('pagination');
                paginationContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationContainer.innerHTML += `<button onclick="fetchData(${i}, ${pageSize})">${i}</button> `;
                }
            })
            .catch(error => console.error('Error:', error));
        }

        window.onload = () => fetchData();
    </script>
</head>
<body>
    <div id="data-container">
    </div>
    <div id="pagination">
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "lzic";
$password = "Whats.Up.You.1!?";
$dbname = "bookDatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
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
echo json_encode($books);
?>

