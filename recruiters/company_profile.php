<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'wt';

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function sanitizeInput($input) {
    global $mysqli;
    return $mysqli->real_escape_string($input);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = isset($_POST['company_name']) ? sanitizeInput($_POST['company_name']) : '';
    $numPositions = isset($_POST['numPositions']) ? min((int)$_POST['numPositions'], 5) : 0;
    $imagePaths = array();

    // Handle file uploads for images
    for ($i = 1; $i <= 4; $i++) {
        $fileInputName = "image$i";

        // Check if a file was uploaded
        if (!empty($_FILES[$fileInputName]['name'])) {
            // Define the target file path
            $targetDir = 'uploads/';
            $targetFile = $targetDir . basename($_FILES[$fileInputName]['name']);

            // Move the file to the uploads directory
            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFile)) {
                $imagePaths[] = $targetFile;
            } else {
                echo "Error uploading file.";
                exit; // Stop execution if there's an error in file upload
            }
        } else {
            // If no file was uploaded, you may want to set a default or handle this case accordingly
            $imagePaths[] = null;
        }
    }

    // Insert data into the company_detail table
    $sql = "INSERT INTO company_detail (company, image1, image2, image3, image4, ";
    for ($i = 1; $i <= 5; $i++) {
        $sql .= "position$i, deadline$i, ";
    }

    $sql = rtrim($sql, ', ');
    $sql .= ") VALUES (?, ?, ?, ?, ?, ";
    for ($i = 1; $i <= 5; $i++) {
        $sql .= "?, ?, ";
    }

    $sql = rtrim($sql, ', ');
    $sql .= ")";

    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        // Create an array to hold all values
        $bindValues = array_merge([$company_name], $imagePaths);

        for ($i = 1; $i <= 5; $i++) {
            $position = isset($_POST["position$i"]) ? sanitizeInput($_POST["position$i"]) : null;
            $deadline = isset($_POST["deadline$i"]) ? sanitizeInput($_POST["deadline$i"]) : null;

            $bindValues[] = $position;
            $bindValues[] = $deadline;
        }

        // Create an array of types corresponding to the values
        $types = str_repeat('s', count($bindValues));

        // Bind the parameters dynamically
        $stmt->bind_param($types, ...$bindValues);

        if ($stmt->execute()) {
            header("Location: recruiters_main.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error in preparing statement";
    }

    $mysqli->close();
}
?>
