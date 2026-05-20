<?php
session_start();
include 'db.php';

if(!isset($_GET['cat'])){
    header("Location: select_category.php");
    exit();
}

$cat_id = $_GET['cat'];

/* CATEGORY FETCH */
$cat_query = $conn->query("SELECT * FROM categories WHERE id='$cat_id'");
$cat = $cat_query->fetch_assoc();

/* SUBJECT FETCH */
$subjects = $conn->query("SELECT * FROM subjects WHERE category_id='$cat_id'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Select Subject</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9">

<div class="container mt-5">

<h2 class="text-center mb-4">
📚 <?php echo $cat['name']; ?> Subjects
</h2>

<div class="row">

<?php while($row = $subjects->fetch_assoc()){ ?>

<div class="col-md-4">
<div class="card shadow p-4 mb-4 text-center">

<h4 class="mb-3">
<?php echo $row['subject_name']; ?>
</h4>

<a href="exam.php?subject=<?php echo $row['id']; ?>" 
class="btn btn-primary w-100">Start Exam</a>

</div>
</div>

<?php } ?>

</div>

<div class="text-center mt-4">
<a href="select_category.php" class="btn btn-secondary">⬅ Back</a>
</div>

</div>
</body>
</html>