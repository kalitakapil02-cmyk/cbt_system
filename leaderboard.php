<?php
session_start();
include 'db.php';
include 'navbar.php';

// Top 10 users highest total score
$res = $conn->query("
SELECT users.name, SUM(results.score) as totalscore, COUNT(results.id) as exams
FROM results
JOIN users ON users.id = results.user_id
GROUP BY users.id
ORDER BY totalscore DESC
LIMIT 10
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f7fb;
}
.top-card{
    border-radius:20px;
    background: linear-gradient(135deg,#ff9800,#ff5722);
    color:white;
}
.rank1{background:#ffd700;}
.rank2{background:#c0c0c0;}
.rank3{background:#cd7f32;}
.table{
    border-radius:15px;
    overflow:hidden;
}
</style>
</head>

<body>

<div class="container mt-5">

<!-- HEADER -->
<div class="top-card p-4 text-center shadow mb-4">
    <h1>🏆 Global Leaderboard</h1>
    <p>Top performers across all exams</p>
</div>

<div class="card shadow p-4">

<table class="table table-hover text-center align-middle">
<thead class="table-dark">
<tr>
<th>Rank</th>
<th>Student</th>
<th>Exams</th>
<th>Total Score</th>
</tr>
</thead>

<tbody>

<?php 
$rank = 1;
while($row = $res->fetch_assoc()) { 

$badge="";
if($rank==1) $badge="rank1";
if($rank==2) $badge="rank2";
if($rank==3) $badge="rank3";
?>

<tr class="<?php echo $badge; ?>">
<td><h4>#<?php echo $rank; ?></h4></td>
<td><strong><?php echo $row['name']; ?></strong></td>
<td><?php echo $row['exams']; ?></td>
<td><b><?php echo $row['totalscore']; ?></b></td>
</tr>

<?php $rank++; } ?>

</tbody>
</table>

<div class="text-center mt-3">
<a href="home.php" class="btn btn-primary">🏠 Back to Home</a>
</div>

</div>
</div>

</body>
</html>