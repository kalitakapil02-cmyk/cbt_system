<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$subject_id = $_GET['subject'];

$score = 0;
$total_questions = 0;

// correct answers fetch
$q = $conn->query("SELECT id, correct FROM questions WHERE subject_id='$subject_id'");
$total_questions = $q->num_rows;

while($row = $q->fetch_assoc()){
    $qid = $row['id'];
    if(isset($_POST["q$qid"]) && $_POST["q$qid"] == $row['correct']){
        $score++;
    }
}

// ✅ SAVE ATTEMPT (IMPORTANT FIX)
$conn->query("INSERT INTO quiz_attempts 
(user_id, subject_id, score, total_questions, created_at)
VALUES 
('$user_id','$subject_id','$score','$total', NOW())");

header("Location: result.php?subject=$subject_id&score=$score&total=$total_questions");
exit();
?>
<!DOCTYPE html>
<html>
<head>
<title>Result</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">

<div class="container mt-5 text-center">

<h2>🎯 Result - <?php echo $subject_name; ?></h2>

<div class="card p-4 shadow mt-4">

<h3 class="mb-3">Score: <?php echo "$score / $total"; ?></h3>

<?php 
$percent = ($total>0) ? round(($score/$total)*100) : 0;
?>

<h5 class="text-success"><?php echo $percent; ?>% Score</h5>

<canvas id="chart" width="250" class="mt-3"></canvas>

<a href="dashboard.php" class="btn btn-primary mt-4">Go Dashboard</a>

</div>
</div>

<script>
new Chart(document.getElementById("chart"), {
type: 'doughnut',
data: {
labels: ['Correct','Wrong'],
datasets: [{
data: [<?php echo $score ?>, <?php echo $total-$score ?>]
}]
}
});
</script>

</body>
</html>