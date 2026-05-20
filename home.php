<?php 
session_start();
include 'db.php';

// 🔐 login check (VERY IMPORTANT)
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'navbar.php';

// user id
$uid = $_SESSION['user_id'];
$name = $_SESSION['name'] ?? "Student";

// total exams attempted
$res1 = $conn->query("SELECT COUNT(*) as total FROM results WHERE user_id='$uid'");
$row1 = $res1->fetch_assoc();
$totalExams = $row1['total'] ?? 0;

// average score
$res2 = $conn->query("SELECT AVG(score) as avgscore FROM results WHERE user_id='$uid'");
$row2 = $res2->fetch_assoc();
$avgScore = round($row2['avgscore'] ?? 0);

// total subjects
$res3 = $conn->query("SELECT COUNT(*) as subs FROM subjects");
$row3 = $res3->fetch_assoc();
$totalSubjects = $row3['subs'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6fb;
}

.hero{
    background: linear-gradient(135deg,#0d6efd,#6610f2);
    color:white;
    padding:60px 30px;
    border-radius:20px;
}

.card{
    border-radius:18px;
    border:none;
}

.feature{
    text-align:center;
    padding:25px;
}

/* Mobile friendly */
@media(max-width:768px){
    .hero{padding:40px 15px;}
}
</style>
</head>

<body>

<div class="container mt-4">

<!-- HERO -->
<div class="hero text-center shadow">
    <h1>👋 Welcome <?php echo $name; ?></h1>
    <p class="lead">Ready to test your knowledge today?</p>
    <a href="select_category.php" class="btn btn-light btn-lg mt-2">🚀 Start Exam</a>
</div>

<!-- STATS -->
<div class="row text-center mt-5">

<div class="col-md-4 mb-3">
<div class="card shadow p-4">
<h2><?php echo $totalExams; ?></h2>
<p>Exams Attempted</p>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card shadow p-4">
<h2><?php echo $avgScore; ?>%</h2>
<p>Average Score</p>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card shadow p-4">
<h2><?php echo $totalSubjects; ?></h2>
<p>Subjects Available</p>
</div>
</div>

</div>

<!-- QUICK ACTIONS -->
<h3 class="mt-5 text-center">⚡ Quick Actions</h3>

<div class="row mt-3">

<div class="col-md-4 mb-3">
<a href="select_category.php" class="btn btn-primary w-100 p-3">📝 Take Exam</a>
</div>

<div class="col-md-4 mb-3">
<a href="my_results.php" class="btn btn-success w-100 p-3">📊 My Results</a>
</div>

<div class="col-md-4 mb-3">
<a href="leaderboard.php" class="btn btn-dark w-100 p-3">🏆 Leaderboard</a>
</div>

</div>

<!-- FEATURES -->
<h3 class="mt-5 text-center">Why use CBT Exam?</h3>

<div class="row mt-4">

<div class="col-md-3 col-6 feature">
<h4>⏱ Real Exam Timer</h4>
<p>Auto submit & strict timing like real exams.</p>
</div>

<div class="col-md-3 col-6 feature">
<h4>🔒 Anti Cheat</h4>
<p>Tab switch detection & fullscreen mode.</p>
</div>

<div class="col-md-3 col-6 feature">
<h4>📈 Instant Result</h4>
<p>Get result & performance graph instantly.</p>
</div>

<div class="col-md-3 col-6 feature">
<h4>🏆 Leaderboard</h4>
<p>Compete with other students.</p>
</div>

</div>

</div>
</body>
</html>