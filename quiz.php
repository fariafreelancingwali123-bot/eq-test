<?php
// Connect to database
$conn = new mysqli("localhost", "u1fkgwiwpmjub", "mp8cjl5322br", "dbu7zpt7hyx89t");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>EQ Test - Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ecf0f1;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        form {
            margin-top: 20px;
        }

        .question {
            margin-bottom: 25px;
        }

        .question h3 {
            margin-bottom: 10px;
            color: #34495e;
        }

        label {
            display: block;
            margin: 5px 0;
            cursor: pointer;
            color: #555;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .submit-btn {
            display: block;
            background: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 30px auto 0;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: #2980b9;
        }

        @media(max-width: 600px) {
            .container {
                padding: 20px;
            }

            .submit-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>EQ Quiz</h1>
        <form method="post" action="result.php">
            <?php
            if ($result->num_rows > 0) {
                $qno = 1;
                while($row = $result->fetch_assoc()) {
                    echo '<div class="question">';
                    echo '<h3>' . $qno++ . '. ' . $row["question"] . '</h3>';
                    echo '<label><input type="radio" name="answers['.$row["id"].']" value="a"> ' . $row["option_a"] . '</label>';
                    echo '<label><input type="radio" name="answers['.$row["id"].']" value="b"> ' . $row["option_b"] . '</label>';
                    echo '<label><input type="radio" name="answers['.$row["id"].']" value="c"> ' . $row["option_c"] . '</label>';
                    echo '<label><input type="radio" name="answers['.$row["id"].']" value="d"> ' . $row["option_d"] . '</label>';
                    echo '</div>';
                }
            } else {
                echo "<p>No questions available.</p>";
            }
            ?>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</body>
</html>
