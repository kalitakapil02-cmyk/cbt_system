<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/*
Make sure quiz_attempts table me ye columns ho:
id | user_id | subject_id | score | total_questions | created_at
*/

$sql = "SELECT qa.*, s.subject_name
        FROM quiz_attempts qa
        LEFT JOIN subjects s ON qa.subject_id = s.id
        WHERE qa.user_id='$user_id'
        ORDER BY qa.id DESC";

$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Results</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#667eea,#764ba2);
    color:white;
}
.card{
    border-radius:20px;
}
.table{
    background:white;
}
</style>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2 class="text-center mb-4">📊 My Exam History</h2>

<div class="card shadow-lg p-4">

<table class="table table-bordered table-striped text-center align-middle">
<thead class="table-dark">
<tr>
<th>Subject</th>
<th>Score</th>
<th>Percentage</th>
<th>Date & Time</th>
</tr>
</thead>

<tbody>

<?php if($res && $res->num_rows > 0){ ?>

<?php while($row = $res->fetch_assoc()){ 
    
    // division by zero safe
    $totalQ = $row['total_questions'] ?? 0;
    $score = $row['score'] ?? 0;
    $percent = ($totalQ > 0) ? round(($score/$totalQ)*100) : 0;

    // date format safe
    $date = isset($row['created_at']) 
            ? date("d M Y h:i A", strtotime($row['created_at']))
            : "N/A";
?>

<tr>
<td><?php echo $row['subject_name'] ?? "Unknown"; ?></td>
<td><?php echo $score." / ".$totalQ; ?></td>
<td><b><?php echo $percent; ?>%</b></td>
<td><?php echo $date; ?></td>
</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="4">No Exam Attempted Yet</td>
</tr>

<?php } ?>

</tbody>
</table>

<div class="text-center">
<a href="home.php" class="btn btn-dark mt-3">⬅ Back to Home</a>
</div>

</div>
</div>

</body>
</html>