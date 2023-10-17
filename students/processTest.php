<?php
// processTest.php

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

// Retrieve the selected answers and company name from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);
$selectedAnswers = $data['answers'];
$companyName = $data['company'];

// Construct the SQL query dynamically based on the selected company
$sql = "SELECT ";
for ($i = 1; $i <= 5; $i++) {
    $sql .= "Q{$i}option1, Q{$i}option2, Q{$i}option3, Q{$i}option4, Q{$i}Answer";
    if ($i < 5) {
        $sql .= ", "; // Add a comma if it's not the last column
    }
}
$sql .= " FROM createtest WHERE company = '$companyName'";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    // Compare selected answers with correct answers and calculate marks
    $marks = 0;
    for ($i = 1; $i <= 5; $i++) {
        $correctAnswer = $row["Q{$i}Answer"];
        $selectedAnswer = $selectedAnswers[$i - 1]; // Adjust the index for selected answers

        if ($correctAnswer == $selectedAnswer) {
            $marks++;
        }
    }

    echo $marks;
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
