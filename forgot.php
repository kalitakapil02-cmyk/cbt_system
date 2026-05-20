<?php
include 'db.php';

$msg = "";

if(isset($_POST['reset'])){
    $email = $_POST['email'];
    $newpass = $_POST['newpass'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($res->num_rows > 0){
        $conn->query("UPDATE users SET password='$newpass' WHERE email='$email'");
        $msg = "Password Updated Successfully";
    } else {
        $msg = "Email Not Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<link href="assets/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

<div class="card p-4" style="width:350px">

<h3 class="text-center">Reset Password</h3>

<?php if($msg){ ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<form method="POST">

<input type="email" name="email" class="form-control mb-2" placeholder="Enter Email" required>

<input type="password" name="newpass" class="form-control mb-2" placeholder="New Password" required>

<button name="reset" class="btn btn-success w-100">Update Password</button>

</form>

<div class="text-center mt-2">
<a href="login.php">Back to Login</a>
</div>

</div>

</div>

</body>
</html>