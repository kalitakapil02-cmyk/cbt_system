<?php
include 'db.php';

// Join users + results
$res = $conn->query("
SELECT users.name, results.subject, results.score, results.total 
FROM results 
JOIN users ON users.id = results.user_id 
ORDER BY results.score DESC 
LIMIT 10
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2 class="text-center mb-4">🏆 Leaderboard</h2>

<table class="table table-striped text-center">

<tr>
<th>Name</th>
<th>Subject</th>
<th>Score</th>
</tr>

<?php while($row = $res->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['subject']; ?></td>
<td><?php echo $row['score']."/".$row['total']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>