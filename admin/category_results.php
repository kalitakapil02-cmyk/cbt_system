<?php
include 'open_db.php';


/* CATEGORY WISE ANALYTICS */
$sql = "SELECT 
categories.name AS category_name,
COUNT(quiz_attempts.id) AS total_attempts,
AVG(quiz_attempts.score) AS avg_score,
MAX(quiz_attempts.score) AS highest_score
FROM quiz_attempts
JOIN subjects ON quiz_attempts.subject_id = subjects.id
JOIN categories ON subjects.category_id = categories.id
GROUP BY categories.id
ORDER BY total_attempts DESC";

$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Category Results</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2 class="text-center mb-4">📊 Category Wise Results</h2>

<div class="card shadow p-4">

<table class="table table-bordered text-center">
<thead class="table-dark">
<tr>
<th>Category</th>
<th>Total Attempts</th>
<th>Average Score</th>
<th>Highest Score</th>
</tr>
</thead>

<tbody>

<?php if($res && $res->num_rows > 0){ ?>
    <?php while($row = $res->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['category_name']; ?></td>
            <td><?php echo $row['total_attempts']; ?></td>
            <td><?php echo round($row['avg_score'],2); ?></td>
            <td><?php echo $row['highest_score']; ?></td>
        </tr>
    <?php } ?>
<?php } else { ?>
<tr>
<td colspan="4">No Attempts Yet</td>
</tr>
<?php } ?>

</tbody>
</table>

</div>
</div>

</body>
</html>