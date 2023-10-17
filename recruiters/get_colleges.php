<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wt"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch colleges from the database
$query = "SELECT college FROM student_detail";
$result = $conn->query($query);

// Store colleges in an array
$colleges = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $colleges[] = $row['college'];
    }
}

// Return colleges as JSON
echo json_encode($colleges);

$conn->close();
?>
