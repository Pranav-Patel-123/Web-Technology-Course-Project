<?php
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

// Query to retrieve data from the table
$sql = "SELECT username, resume_filename FROM student_detail";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch data and store it in an associative array
    $students = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>

<!-- Inside the <ul> tag -->
<?php foreach ($students as $student) : ?>
    <li>
        <span class="studentName"><?php echo $student['username']; ?></span>
        <a class="resume" href="../students/uploads/<?php echo $student['resume_filename']; ?>" target="_blank">View Resume</a>
    </li>
<?php endforeach; ?>


