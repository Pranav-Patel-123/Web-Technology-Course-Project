<!-- fetch_questions.html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer Questions</title>
</head>
<body>

<?php
// fetch_questions.php

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

// Fetch data from the database
$sql = "SELECT * FROM createtest ORDER BY id DESC LIMIT 1"; // Assuming you have an 'id' column for ordering
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Display questions and options
    echo '<form method="post" action="submit_answers.php">';
    echo '<ul>';
    for ($i = 1; $i <= 5; $i++) {
        $question = $row["Q$i"];
        $option1 = $row["Q${i}option1"];
        $option2 = $row["Q${i}option2"];
        $option3 = $row["Q${i}option3"];
        $option4 = $row["Q${i}option4"];

        echo '<li>';
        echo "<strong>Question $i:</strong> $question<br>";
        echo '<label><input type="radio" name="answer' . $i . '" value="1"> ' . $option1 . '</label><br>';
        echo '<label><input type="radio" name="answer' . $i . '" value="2"> ' . $option2 . '</label><br>';
        echo '<label><input type="radio" name="answer' . $i . '" value="3"> ' . $option3 . '</label><br>';
        echo '<label><input type="radio" name="answer' . $i . '" value="4"> ' . $option4 . '</label><br>';
        echo '</li>';
    }
    echo '</ul>';
    echo '<input type="submit" value="Submit Answers">';
    echo '</form>';
} else {
    echo '<p>No data found.</p>';
}

// Close the connection
$conn->close();
?>

</body>
</html>
