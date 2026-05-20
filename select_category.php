<?php
session_start();
include 'db.php';

$res = $conn->query("SELECT * FROM categories");
if(!$res){
    die("Query Failed : " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Select Category</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2 class="text-center mb-4">📚 Select Category</h2>

<div class="row">

<?php while($row = $res->fetch_assoc()) { ?>

<div class="col-md-3">
<div class="card p-4 text-center shadow mb-3">

<h4><?php echo $row['name']; ?></h4>



<!-- 🚀 START EXAM (MOST IMPORTANT FIX) -->
<a href="select_subject.php?cat=<?php echo $row['id']; ?>" class="btn btn-primary mt-3 w-100">
Select Subjects
</a>

</div>
</div>

<?php } ?>

</div>
</div>

</body>
</html>