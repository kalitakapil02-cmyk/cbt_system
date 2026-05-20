<?php
include '../db.php';

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM questions WHERE id=$id");
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h3>Edit Question</h3>

<form method="POST">
<input class="form-control mb-2" name="q" value="<?php echo $row['question']; ?>">
<input class="form-control mb-2" name="o1" value="<?php echo $row['option1']; ?>">
<input class="form-control mb-2" name="o2" value="<?php echo $row['option2']; ?>">
<input class="form-control mb-2" name="o3" value="<?php echo $row['option3']; ?>">
<input class="form-control mb-2" name="o4" value="<?php echo $row['option4']; ?>">
<input class="form-control mb-2" name="c" value="<?php echo $row['correct']; ?>">

<button class="btn btn-success" name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
$conn->query("UPDATE questions SET 
question='$_POST[q]',
option1='$_POST[o1]',
option2='$_POST[o2]',
option3='$_POST[o3]',
option4='$_POST[o4]',
correct='$_POST[c]'
WHERE id=$id");

echo "<div class='alert alert-success mt-2'>Updated</div>";
}
?>

</div>
</body>
</html>