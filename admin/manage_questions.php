<?php
session_start();
include '../db.php';

// questions + subject name join (FIXED COLUMN NAME)
$sql = "SELECT questions.*, subjects.subject_name 
        FROM questions
        JOIN subjects ON questions.subject_id = subjects.id
        ORDER BY questions.id DESC";

$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Questions</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2 class="text-center mb-4">📚 Manage Questions</h2>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Subject</th>
<th>Question</th>
<th>Options</th>
<th>Answer</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php if($res && $res->num_rows > 0){ ?>
<?php while($row = $res->fetch_assoc()){ ?>
<tr>

<td><?php echo $row['id']; ?></td>

<td>
<b><?php echo $row['subject_name']; ?></b>
</td>

<td><?php echo $row['question']; ?></td>

<td>
A) <?php echo $row['option1']; ?><br>
B) <?php echo $row['option2']; ?><br>
C) <?php echo $row['option3']; ?><br>
D) <?php echo $row['option4']; ?>
</td>

<td>
<span class="badge bg-success">
Option <?php echo $row['correct']; ?>
</span>
</td>

<td>
<a href="delete_question.php?id=<?php echo $row['id']; ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this question?')">
Delete
</a>
</td>

</tr>
<?php } ?>
<?php } else { ?>
<tr>
<td colspan="6" class="text-center">No Questions Found</td>
</tr>
<?php } ?>

</tbody>
</table>

</div>
</body>
</html>