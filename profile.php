<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user_id'];

// 🔹 user info
$user = $conn->query("SELECT * FROM users WHERE id='$uid'")->fetch_assoc();

// 🔹 stats
$totalExam = $conn->query("SELECT COUNT(*) as t FROM results WHERE user_id='$uid'")->fetch_assoc()['t'];
$avgScore = $conn->query("SELECT AVG(score) as a FROM results WHERE user_id='$uid'")->fetch_assoc()['a'];
$bestScore = $conn->query("SELECT MAX(score) as b FROM results WHERE user_id='$uid'")->fetch_assoc()['b'];

$avgScore = round($avgScore ?? 0);
$bestScore = $bestScore ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.profile-header{
    background: linear-gradient(135deg,#0d6efd,#6610f2);
    color:white;
    padding:40px;
    border-radius:20px;
}
.stat-card{
    border-radius:18px;
    text-align:center;
    padding:25px;
}
</style>
</head>

<body>
<?php include 'navbar.php'; ?>

<div class="container mt-4">

<!-- HEADER -->
<div class="profile-header text-center shadow">
    <h1>👤 <?php echo $user['name']; ?></h1>
    <p><?php echo $user['email']; ?></p>
    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#editModal">
        ✏ Edit Profile
    </button>
</div>

<!-- STATS -->
<div class="row mt-4 text-center">

<div class="col-md-4">
<div class="card stat-card shadow">
<h2><?php echo $totalExam; ?></h2>
<p>Exams Attempted</p>
</div>
</div>

<div class="col-md-4">
<div class="card stat-card shadow">
<h2><?php echo $avgScore; ?>%</h2>
<p>Average Score</p>
</div>
</div>

<div class="col-md-4">
<div class="card stat-card shadow">
<h2><?php echo $bestScore; ?></h2>
<p>Best Score</p>
</div>
</div>

</div>

<!-- EXTRA INFO -->
<div class="card mt-4 shadow p-4">
<h4>📌 Account Details</h4>
<hr>

<p><b>Name:</b> <?php echo $user['name']; ?></p>
<p><b>Email:</b> <?php echo $user['email']; ?></p>
<p><b>Role:</b> <?php echo ucfirst($user['role']); ?></p>
<p><b>Member Since:</b> <?php echo $user['created_at'] ?? "N/A"; ?></p>
</div>

</div>

<!-- ✏ EDIT PROFILE MODAL -->
<div class="modal fade" id="editModal">
<div class="modal-dialog">
<div class="modal-content">

<form method="POST" action="update_profile.php">
<div class="modal-header">
<h5>Edit Profile</h5>
</div>

<div class="modal-body">
<input class="form-control mb-2" name="name" value="<?php echo $user['name']; ?>" required>
<input class="form-control mb-2" name="email" value="<?php echo $user['email']; ?>" required>
<input class="form-control mb-2" type="password" name="password" placeholder="New Password">
</div>

<div class="modal-footer">
<button class="btn btn-primary">Save Changes</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>