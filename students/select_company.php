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

// Fetch companies from the database
$query = "SELECT company FROM company_detail";
$result = $conn->query($query);

// Check for errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Store companies in an array
$companies = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row['company'];
    }
} 

// Return companies as JSON
echo json_encode($companies);

$conn->close();
?>
