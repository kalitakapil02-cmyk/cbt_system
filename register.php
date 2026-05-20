<?php
include 'db.php';

$msg="";

if(isset($_POST['register']))
{
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];   // ⭐ plain password

// check user exist
$check = $conn->query("SELECT * FROM users WHERE email='$email'");

if($check->num_rows > 0){
    $msg = "User already exists!";
}else{

$conn->query("INSERT INTO users(name,email,password,role)
VALUES('$name','$email','$password','student')");

$msg = "Registration Successful 🎉";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

<div class="card p-4" style="width:350px">
<h3 class="text-center">Register</h3>

<?php if($msg) echo "<div class='alert alert-info'>$msg</div>"; ?>

<form method="POST">
<input name="name" class="form-control mb-2" placeholder="Full Name" required>
<input name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

<button name="register" class="btn btn-success w-100">Register</button>
</form>

<a href="login.php" class="d-block text-center mt-3">Already have account? Login</a>

</div>
</div>

</body>
</html>