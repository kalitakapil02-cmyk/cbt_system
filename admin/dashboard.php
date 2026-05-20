<?php
session_start();
include '../db.php';

// admin check
if($_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}

$res = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/cbt_system/assets/style.css" rel="stylesheet">
</head>

<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">

<h2 class="text-center mb-4">⚙️ Admin Dashboard</h2>

<a href="add_category.php" class="btn btn-primary mb-3">+ Add Category</a>

<div class="row">

<?php while($row = $res->fetch_assoc()) { ?>

<div class="col-md-3">
<div class="card p-3 text-center shadow mb-3">

<h5 class="category-title"><?php echo $row['name']; ?></h5>

<!-- ✅ Add Subject -->
<a href="add_subject.php?cat=<?php echo $row['id']; ?>" 
class="btn btn-success mt-2 w-100">
Add Subject
</a>

<!-- 🔥 Add Question -->
<a href="addQuestion.php?cat=<?php echo $row['id']; ?>" 
class="btn btn-danger mt-2 w-100">
Add Question
</a>



</div>
</div>



<?php } ?>

</div>

</div>

</body>
</html>