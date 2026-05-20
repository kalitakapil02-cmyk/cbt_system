<?php
session_start();
include '../db.php';

$cat = $_GET['cat'];

if(isset($_POST['add'])){
    $name = $_POST['name'];

    $conn->query("INSERT INTO subjects(name, category_id) VALUES('$name','$cat')");
    echo "<script>alert('Subject Added');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Subject</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h3>Add Subject</h3>

<form method="POST">
<input class="form-control mb-2" name="name" placeholder="Subject Name" required>

<button name="add" class="btn btn-primary">Add</button>
</form>

</div>

</body>
</html>