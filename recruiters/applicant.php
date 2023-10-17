<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* CSS styles for the table */
        table {
            border-collapse: collapse;
            width: 97%;
            padding: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        th.sortable:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Your Logo</div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="about_us.html">About Us</a></li>
                <li><a href="contact_us.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <br><br>
    <h1><center>Student List</h1>
    <br>
    &emsp;<label for="sortDropdown">Sort By:</label>
    <select id="sortDropdown">
        <option value="username">Username</option>
        <option value="department">Department</option>
        <option value="cgpa">CGPA</option>
    </select>
    <br>
    <br>
    <center>
        <table id="studentTable">
            <thead>
                <tr>
                    <th class="sortable" onclick="sortTable(0)">Username</th>
                    <th class="sortable" onclick="sortTable(1)">Department</th>
                    <th class="sortable" onclick="sortTable(2)">CGPA</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code for dynamic table content -->
                <?php
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'wt';

                // Create a connection
                $conn = new mysqli($host, $username, $password, $database);

                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to retrieve data from the table
                $sql = "SELECT * FROM student_detail";
                $result = $conn->query($sql);

                // Check if the query was successful
                if ($result) {
                    // Fetch data and store it in an associative array
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close the connection
                $conn->close();

                // Inside the <tbody> tag
                foreach ($data as $row) :
                ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['cgpa']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br><br>
    </center>
    <footer>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>&emsp;&emsp;
                <li><a href="#about">About Us</a></li>&emsp;&emsp;
                <li><a href="contact_us.html">Contact Us</a></li>
            </ul>
        </nav>
        <p>&copy; 2023 Your Company Name. All rights reserved.</p>
    </footer>

    <script>
        function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("studentTable");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.getElementsByTagName("tr");

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    if (columnIndex === 2) { // For CGPA sorting
                        shouldSwitch = parseFloat(x.textContent) < parseFloat(y.textContent);
                    } else {
                        shouldSwitch = x.textContent.toLowerCase() > y.textContent.toLowerCase();
                    }

                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }
        }

        document.getElementById('sortDropdown').addEventListener('change', function () {
            var sortBy = this.value;
            var columnIndex = sortBy === 'username' ? 0 : sortBy === 'department' ? 1 : 2;
            sortTable(columnIndex);
        });
    </script>
</body>

</html>
