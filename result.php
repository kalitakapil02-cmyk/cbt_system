<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['subject'])){
    die("No result found!");
}

$subject_id = $_GET['subject'];
$score = $_GET['score'];
$total = $_GET['total'];

// ✅ SUBJECT NAME FETCH FIX
$getSubject = $conn->query("SELECT subject_name FROM subjects WHERE id='$subject_id'");
$subRow = $getSubject->fetch_assoc();
$subject_name = $subRow['subject_name'];

$percentage = $total > 0 ? round(($score/$total)*100) : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Result</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
background: linear-gradient(135deg,#667eea,#764ba2);
color:white;
}

.result-card{
max-width:450px;
margin:auto;
border-radius:20px;
background:white;
color:black;
}

canvas{
max-width:220px !important;
max-height:220px !important;
margin:auto;
}
</style>
</head>

<body>

<div class="container mt-5 text-center">

<h2 class="mb-3">🎯 Exam Result</h2>
<h5 class="mb-4"><?php echo $subject_name; ?></h5>

<div class="card result-card shadow-lg p-4">

<h3 class="mb-2"><?php echo "$score / $total"; ?></h3>
<h4 class="text-primary"><?php echo $percentage; ?>%</h4>

<canvas id="chart"></canvas>

<a href="select_category.php" class="btn btn-dark mt-4 w-100">
Back to Home
</a>

</div>

</div>

<script>
new Chart(document.getElementById("chart"), {
type: 'doughnut',
data: {
labels: ['Correct','Wrong'],
datasets: [{
data: [<?php echo $score ?>, <?php echo $total-$score ?>],
backgroundColor: ['#4CAF50','#F44336'],
borderWidth: 0
}]
},
options:{
cutout: '70%',
plugins:{
legend:{display:true}
}
}
});
</script>

</body>
</html>