<?php
session_start();
include '../db.php';

if($_SESSION['role']!="admin"){
    header("Location: ../login.php");
    exit();
}

$cat = $_GET['cat'] ?? '';

if($cat==""){
    die("Category not selected");
}

// TOTAL ATTEMPTS
$total_attempts = $conn->query("SELECT COUNT(*) as total FROM quiz_attempts WHERE category='$cat'")->fetch_assoc()['total'];

// AVG SCORE
$avg_score = $conn->query("SELECT AVG(score) as avg FROM quiz_attempts WHERE category='$cat'")->fetch_assoc()['avg'];
$avg_score = round($avg_score,2);

// HIGHEST SCORE
$high_score = $conn->query("SELECT MAX(score) as max FROM quiz_attempts WHERE category='$cat'")->fetch_assoc()['max'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Analytics</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

<h2>📊 <?php echo $cat; ?> Analytics</h2>

<div class="row mt-4">

<div class="col-md-4">
<div class="card p-3 bg-primary text-white">
<h4>Total Attempts</h4>
<h2><?php echo $total_attempts; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 bg-success text-white">
<h4>Average Score</h4>
<h2><?php echo $avg_score; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 bg-danger text-white">
<h4>Highest Score</h4>
<h2><?php echo $high_score; ?></h2>
</div>
</div>

</div>

<hr>

<h4 class="mt-4">🏆 Student Attempts</h4>

<table class="table table-striped">
<tr>
<th>User</th>
<th>Score</th>
<th>Date</th>
</tr>

<?php
$res = $conn->query("
SELECT users.name, quiz_attempts.score, quiz_attempts.attempt_date 
FROM quiz_attempts 
JOIN users ON users.id = quiz_attempts.user_id
WHERE quiz_attempts.category='$cat'
ORDER BY quiz_attempts.id DESC
");

while($row = $res->fetch_assoc()){
?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['score']; ?></td>
<td><?php echo $row['attempt_date']; ?></td>
</tr>
<?php } ?>

</table>

</div>
</body>
</html>