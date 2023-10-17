<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'wt'; // Replace with your actual database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert data into the database
$sql = "INSERT INTO createtest (";
for ($i = 1; $i <= 20; $i++) {
    $sql .= "Q$i, ";
}
$sql = rtrim($sql, ', ') . ') VALUES (';
for ($i = 1; $i <= 20; $i++) {
    $sql .= '?, ?, ?, ?, '; // Four placeholders for each question
}
$sql = rtrim($sql, ', ') . ')';

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters dynamically
    $bindTypes = str_repeat('s', 4 * 20); // 4 options for each of the 20 questions
    $stmt->bind_param($bindTypes, ...$values);

    // Get values from the form submission
    $values = [];
    for ($i = 1; $i <= 20; $i++) {
        foreach ($_POST["Q$i"] as $option) {
            $values[] = $option;
        }
    }

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error in preparing statement";
}

// Close the connection
$conn->close();
?>
