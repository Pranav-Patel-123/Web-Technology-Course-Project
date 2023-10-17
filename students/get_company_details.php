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

// Get the company name from the query parameter
$companyName = $_GET['company'];

// Fetch company details from the database
$sql = "SELECT title, description, deadline FROM positions WHERE company_name = '$companyName'";
$result = $conn->query($sql);

// Process the result
if ($result->num_rows > 0) {
    $companyDetails = array();
    while ($row = $result->fetch_assoc()) {
        $position = array(
            "title" => $row["title"],
            "description" => $row["description"],
            "deadline" => $row["deadline"]
        );
        $companyDetails["positions"][] = $position;
    }
    echo json_encode($companyDetails);
} else {
    echo "0 results";
}

$conn->close();
?>
