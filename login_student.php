<?php
// Database configuration
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "wt";

// Create a database connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["student-email"];
    $password = $_POST["student-password"];

    // You should hash the password before storing it in the database.
    // For simplicity, we won't hash it here.
    
    // Perform a SQL query to check if the user exists
    $sql = "SELECT * FROM signup_student WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, redirect to a success page
        header("Location: students/select_company.html");
        exit();
    } else {    
        // User not found, display an error message
        echo "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>
