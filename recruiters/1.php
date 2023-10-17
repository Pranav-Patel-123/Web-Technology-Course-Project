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
    $company_name = $_POST["company_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Validate inputs (you can add more validation)
    if ($password != $confirmPassword) {
        echo "Passwords do not match.";
    } else {
        // Insert user data into the signup_company table
        $sql1 = "INSERT INTO signup_company (company_name, email, password) VALUES (?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("sss", $company_name, $email, $password);

        // Insert user data into the company_details table
        $sql2 = "INSERT INTO company_detail (company) VALUES (?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("s", $company_name);

        // Execute both queries
        if ($stmt1->execute() && $stmt2->execute()) {
            // Registration successful, redirect to a success page
            header("Location: company_profile.html");
            exit();
        } else {
            // Registration failed, display an error message
            echo "Error: " . $stmt1->error . " " . $stmt2->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
