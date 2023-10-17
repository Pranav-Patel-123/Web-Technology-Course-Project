<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        header,
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            max-width: 600px;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <h1>Questionnaire Form</h1>
    </header>

    <form>
        <label for="company">Enter Company Name:</label>
        <input type="text" id="company" required>

        <div id="questions-container"></div>

        <center><button type="button" onclick="fetchQuestions()">Get Questions</button></center>
    </form>

    <footer>
        <p>&copy; 2023 Your Company Name. All rights reserved.</p>
    </footer>

    <script>
        function fetchQuestions() {
            var companyName = document.getElementById('company').value;

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure it: GET-Request for the specified company
            xhr.open('GET', 'givetest.php?company=' + encodeURIComponent(companyName), true);

            // Set up the callback function to handle the response
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 400) {
                    // Successful response
                    document.getElementById('questions-container').innerHTML = xhr.responseText;
                } else {
                    // Error in the request
                    console.error('Error fetching questions:', xhr.statusText);
                }
            };

            // Handle network errors
            xhr.onerror = function () {
                console.error('Network error while fetching questions.');
            };

            // Send the request
            xhr.send();
        }
    </script>
</body>

</html>
