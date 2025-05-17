<?php
$conn = new mysqli("localhost", "u1fkgwiwpmjub", "mp8cjl5322br", "dbu7zpt7hyx89t");
$answers = $_POST['answer'];
$score = 0;
$total = count($answers);

foreach ($answers as $id => $userAnswer) {
  $q = $conn->query("SELECT correct_option FROM questions WHERE id=$id")->fetch_assoc();
  if ($userAnswer == $q['correct_option']) {
    $score++;
  }
}

$percentage = ($score / $total) * 100;
$feedback = "Your EQ score is $percentage%. ";

if ($percentage >= 80) {
  $feedback .= "You have excellent emotional intelligence!";
} elseif ($percentage >= 60) {
  $feedback .= "Your emotional intelligence is good, but there’s room to grow.";
} else {
  $feedback .= "Consider working on your emotional awareness and empathy.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>EQ Results</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Your EQ Score</h1>
    <p><?= $feedback ?></p>
    <a href="quiz.php" class="btn">Retake Test</a>
    <a href="index.php" class="btn">Home</a>
  </div>
</body>
</html>
