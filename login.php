<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db.php';

$error="";

if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $res=$conn->query("SELECT * FROM users WHERE email='$email'");

    if($res && $res->num_rows>0){
        $user=$res->fetch_assoc();

        if($password==$user['password']){

            // 🔥 SESSION SAVE (IMPORTANT FIX)
            $_SESSION['user_id']=$user['id'];
            $_SESSION['name']=$user['name'];   // ⭐ THIS FIXES HOME PAGE
            $_SESSION['role']=$user['role'];

            if ($user['role']=="admin"){
                header("Location: admin/dashboard.php");
            }else{
                header("Location: home.php"); // ⭐ go to home now
            }
            exit();

        }else{
            $error="Wrong Password";
        }

    }else{
        $error="User Not Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<script src="assets/script.js"></script>
<link href="assets/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

<div class="card p-4" style="width:350px">

<h3 class="text-center">Login</h3>

<?php if($error){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST" action="login_process.php"></form>

<form method="POST">
<input class="form-control mb-2" name="email" placeholder="Email" required>
<input class="form-control mb-2" type="password" name="password" placeholder="Password" required>

<button name="login" class="btn btn-primary w-100">Login</button>
</form>

<!-- ✅ FORGOT PASSWORD LINK -->
<div class="text-center mt-3">
<a href="forgot.php" style="text-decoration:none;">Forgot Password?</a>

<div style="text-align:center; margin-top:10px;">
</div>
</div>

</div>

</div>
</body>
</body>

<script>
window.onload = function(){
    document.body.style.opacity = 1;
}
</script>
</html>