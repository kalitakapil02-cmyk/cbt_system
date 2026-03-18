<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
    
    if($res->num_rows>0){
        $user = $res->fetch_assoc();
        $_SESSION['user_id']=$user['id'];
        $_SESSION['role']=$user['role'];

        if($user['role']=="admin"){
            header("Location: admin/dashboard.php");
        } else {
            header("Location: exam.php");
        }
    } else {
        echo "Invalid Login";
    }
}
?>

<form method="POST">
Email: <input type="email" name="email"><br>
Password: <input type="password" name="password"><br>
<button name="login">Login</button>
</form>