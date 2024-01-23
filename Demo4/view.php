<!DOCTYPE html>
<html>
<head>
    <title>View Strings</title>
    <link rel="stylesheet" type="text/css" href="myStyle.css">
    <script>
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("data-container").innerHTML = this.responseText;
                }
            };
            xhr.open("GET", "fetchData.php", true);
            xhr.send();
        }

        function startAutoRefresh() {
            fetchData();
            setInterval(fetchData, 5000); 
        }
    </script>
</head>
<body onload="startAutoRefresh()">
    <div class="container">
        <div id="data-container">
        </div>
    </div>
</body>
</html>

