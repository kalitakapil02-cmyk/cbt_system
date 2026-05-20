<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];

// total exams
$exams = $conn->query("SELECT COUNT(*) as total FROM results WHERE user_id='$user_id'");
$total_exams = $exams->fetch_assoc()['total'];

// average score
$avg = $conn->query("SELECT AVG(score/total*100) as avg FROM results WHERE user_id='$user_id'");
$avg_score = round($avg->fetch_assoc()['avg']);

// last result
$last = $conn->query("SELECT * FROM results WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
$lastRow = $last->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">

<h2>👋 Student Dashboard</h2>

<div class="row mt-4">

<div class="col-md-4">
<div class="card p-3 shadow text-center">
<h4>📊 Exams Attempted</h4>
<h2><?php echo $total_exams ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 shadow text-center">
<h4>🎯 Avg Score</h4>
<h2><?php echo $avg_score ?>%</h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 shadow text-center">
<h4>🏆 Last Score</h4>
<h2><?php echo $lastRow['score']."/".$lastRow['total']; ?></h2>
</div>
</div>

</div>

<div class="mt-4 text-center">
<a href="select_category.php" class="btn btn-success">Start Exam</a>
<a href="history.php" class="btn btn-primary">My Results</a>
<a href="leaderboard.php" class="btn btn-warning">Leaderboard</a>

</div>

</div>
</body>
</html>