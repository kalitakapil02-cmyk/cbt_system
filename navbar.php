<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">

<a class="navbar-brand" href="select_category.php">🎓 CBT Exam</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">
<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="home.php">🏠 Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="select_category.php">📝 Take Exam</a>
</li>

<li class="nav-item">
<a class="nav-link" href="my_results.php">📊 My Results</a>
</li>

<li class="nav-item">
  <a class="nav-link" href="http://localhost/cbt_system/profile.php">Profile</a>
</li>

<li class="nav-item">
  <a class="nav-link" href="http://localhost/cbt_system/leaderboard.php">Leaderboard</a>
</li>

<li class="nav-item">
<a href="logout.php" class="btn btn-danger"
onclick="return confirm('Are you sure you want to logout?');">
 Logout
</a>
</li>

</ul>
</div>
</div>
</nav>