<?php include '../db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h3>Student Results</h3>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>User ID</th>
<th>Score</th>
<th>Date</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM results");

while($row=$res->fetch_assoc()){
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user_id']; ?></td>
<td><?php echo $row['score']; ?></td>
<td><?php echo $row['exam_date']; ?></td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>