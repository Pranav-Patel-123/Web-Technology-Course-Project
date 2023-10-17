<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "wt";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST["company_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($password != $confirmPassword) {
        echo "Passwords do not match.";
    } else {
        // Insert user data into the signup_company table
        $sql1 = "INSERT INTO signup_company (company_name, email, password) VALUES (?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("sss", $company_name, $email, $password);

        // Execute the prepared statement
        $stmt1->execute();

        // Check for successful insertion
        if ($stmt1->affected_rows > 0) {
            // Redirect to the company profile page
            header("Location: company_profile.html");
            exit();
        } else {
            echo "Error inserting data into the database.";
        }
    }
}

$conn->close();
?>
