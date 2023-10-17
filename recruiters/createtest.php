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
            width: 60%; /* Adjusted width for better visibility */
            max-width: 600px; /* Set a maximum width */
            margin-top: 20px; /* Added margin to separate form from header */
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

        .sub-input {
            margin-left: 75px;
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

    <form action="fill-questions.php" method="post">

    <label for="companyname">company name:</label>
    <input type="text" name="company">
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <label for="form1_question<?php echo $i; ?>">Question <?php echo $i; ?>:</label>
            <input type="text" name="question<?php echo $i; ?>" placeholder="Enter your question">
            <label class="sub-input">
                <label for="form1_option<?php echo $i; ?>_1">Option 1:</label>
                <input type="text" name="option<?php echo $i; ?>_1" placeholder="Enter option">
                <label for="form1_option<?php echo $i; ?>_2">Option 2:</label>
                <input type="text" name="option<?php echo $i; ?>_2" placeholder="Enter option">
                <label for="form1_option<?php echo $i; ?>_3">Option 3:</label>
                <input type="text" name="option<?php echo $i; ?>_3" placeholder="Enter option">
                <label for="form1_option<?php echo $i; ?>_4">Option 4:</label>
                <input type="text" name="option<?php echo $i; ?>_4" placeholder="Enter option">
                <label for="form1_option<?php echo $i; ?>_4">Answer</label>
                <input type="text" name="answer<?php echo $i; ?>_4" placeholder="Enter answer">
            </label>
        <?php endfor; ?>
        <center><input type="submit" value="Submit Questions"></center>
    </form>

    <footer>
        <p>&copy; 2023 Your Company Name. All rights reserved.</p>
    </footer>
</body>

</html>
