<?php
// givetest.php

// Database connection parameters
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

// Retrieve the company name from the AJAX request
$companyName = isset($_GET['company']) ? $_GET['company'] : '';

// Fetch questions and options for the specified company
$sql = "SELECT * FROM createtest WHERE company = '$companyName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each row of the result
    $row = $result->fetch_assoc();

    for ($i = 1; $i <= 5; $i++) {
        echo "<label for='question{$i}'>Question {$i}:</label>";
        echo "<input type='text' name='question{$i}' value='{$row["Q{$i}"]}' readonly>";

        echo "<label for='options{$i}'>Options:</label>";
        for ($j = 1; $j <= 4; $j++) {
            $option = "Q{$i}option{$j}";
            echo "<input type='radio' name='answer{$i}' value='{$row[$option]}'> {$row[$option]}";
        }
        echo "<br>"; // Add line break for better readability
    }
} else {
    echo "No questions found for the specified company.";
}

// Close the connection
$conn->close();
?>
