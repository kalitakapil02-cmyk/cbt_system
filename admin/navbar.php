<nav class="navbar navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand">🛠 Admin Panel</a>

<div>
<a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
<a href="manage_questions.php" class="btn btn-light btn-sm">Questions</a>

<!-- FIXED LINK -->
<a href="addquestion.php" class="btn btn-success btn-sm">Add Question</a>

<a href="add_category.php" class="btn btn-light btn-sm">Category</a>
<a href="category_results.php" class="btn btn-warning btn-sm">Analytics</a>
<a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
</div>
</div>
</nav>

<script>
function confirmLogout(){
    if(confirm("Are you sure you want to logout?")){
        window.location.href="../logout.php";
    }
}
</script>