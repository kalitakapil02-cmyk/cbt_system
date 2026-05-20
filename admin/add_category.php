<?php
session_start();
include '../db.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}

$msg = "";

// form submit check
if(isset($_POST['add_category'])){

    $name = $_POST['category_name'];

    if(!empty($name)){
        $conn->query("INSERT INTO categories(name) VALUES('$name')");
        $msg = "Category Added Successfully 🎉";
    }else{
        $msg = "Category name cannot be empty!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
<div class="card p-4 shadow" style="max-width:500px;margin:auto;">

<h3 class="text-center">➕ Add Category</h3>

<?php if($msg!=""){ ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<form method="POST">
<input type="text" name="category_name" class="form-control mb-3" placeholder="Enter Category Name" required>

<button name="add_category" class="btn btn-primary w-100">
Add Category
</button>
</form>

</div>
</div>

</body>
</html>