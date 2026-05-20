<?php include '../db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h3>All Questions</h3>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Question</th>
<th>Action</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM questions");

while($row=$res->fetch_assoc()){
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['question']; ?></td>
<td>
<a href="edit_question.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
<a href="delete_question.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>