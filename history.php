<?php
session_start();
include 'db.php';
$user_id = $_SESSION['user_id'];

$res = $conn->query("SELECT subjects.name,results.score,results.total,exam_date 
FROM results 
JOIN subjects ON subjects.id=results.subject_id
WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
<title>History</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2>📜 My Results</h2>

<table class="table table-bordered">
<tr><th>Subject</th><th>Score</th><th>Date</th></tr>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['name'] ?></td>
<td><?php echo $row['score']."/".$row['total'] ?></td>
<td><?php echo $row['exam_date'] ?></td>
</tr>
<?php } ?>

</table>
</div>
</body>
</html>