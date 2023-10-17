<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Recruitment Page</title>
    <link rel="stylesheet" href="students main.css">
</head>

<body>
    <header>
        <h1>Welcome to Our Company</h1>
    </header>
    <br>

    <section class="carousel" aria-label="Gallery">
        <!-- Your carousel code (unchanged) -->
    </section>

    <section class="recruitment">
        <h2>Open Positions</h2>
    </section>

    <div class="position-cards">
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

        // Fetch data from the company_detail table
        $sql = "SELECT image1, image2, position1, deadline1, position2, deadline2 FROM company_detail";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="position-card">';
                // Display images
                echo '<img src="' . $row['image1'] . '" alt="Image 1">';
                echo '<img src="' . $row['image2'] . '" alt="Image 2">';
                
                // Display position details
                echo '<h3>' . $row['position1'] . '</h3>';
                echo '<p>Description of ' . $row['position1'] . '</p>';
                echo '<p>Deadline: ' . $row['deadline1'] . '</p>';
                echo '<button class="apply-button"><a href="apply and edit profile.html">Apply</a></button>';
                echo '</div>';

                echo '<div class="position-card">';
                echo '<h3>' . $row['position2'] . '</h3>';
                echo '<p>Description of ' . $row['position2'] . '</p>';
                echo '<p>Deadline: ' . $row['deadline2'] . '</p>';
                echo '<button class="apply-button"><a href="apply and edit profile.html">Apply</a></button>';
                echo '</div>';
                // Add more position cards as needed
            }
        } else {
            echo "No positions found.";
        }

        // Close the connection
        $conn->close();
        ?>
    </div>

    <footer>
        <p>Contact us at: contact@company.com</p>
    </footer>

</body>

</html>
