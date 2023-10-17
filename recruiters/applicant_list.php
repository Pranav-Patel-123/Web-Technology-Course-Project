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
?>

<!-- Inside the <tbody> tag -->
<?php foreach ($data as $row) : ?>
    <tr>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['department']; ?></td>
        <td><?php echo $row['cgpa']; ?></td>
    </tr>
<?php endforeach; ?>
