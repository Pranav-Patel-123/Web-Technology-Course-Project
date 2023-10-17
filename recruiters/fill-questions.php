<?php
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the company from the form
    $company = $_POST["company"];

    // Initialize an associative array to store form data
    $formData = array('company' => $company);

    // Iterate through each question
    for ($i = 1; $i <= 5; $i++) {
        // Get the question, options, and answer from the form
        $question = $_POST["question$i"];
        $option1 = $_POST["option${i}_1"];
        $option2 = $_POST["option${i}_2"];
        $option3 = $_POST["option${i}_3"];
        $option4 = $_POST["option${i}_4"];
        $answer = $_POST["answer${i}_4"]; // New line to get the answer

        // Add question data to the associative array
        $formData["Q$i"] = $question;
        $formData["Q${i}option1"] = $option1;
        $formData["Q${i}option2"] = $option2;
        $formData["Q${i}option3"] = $option3;
        $formData["Q${i}option4"] = $option4;
        $formData["Q${i}Answer"] = $answer; // New line to add the answer
    }

    // Use the associative array to build the SQL query
    $columns = implode(", ", array_keys($formData));
    $values = "'" . implode("', '", $formData) . "'";
    
    $sql = "INSERT INTO createtest ($columns) VALUES ($values)";

    // Execute the query
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        // Redirect to the fill-answers page
        header("Location: test_main.html");
        exit();
    }
}

// Close the connection
$conn->close();
?>
