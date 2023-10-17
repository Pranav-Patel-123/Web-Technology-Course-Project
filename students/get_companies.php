<?php

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch companies from the database
$sql = "SELECT company_name FROM companies";
$result = $conn->query($sql);

// Process the result
if ($result->num_rows > 0) {
    $companies = array();
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row["company_name"];
    }
    echo json_encode($companies);
} else {
    echo "0 results";
}

$conn->close();
?>
