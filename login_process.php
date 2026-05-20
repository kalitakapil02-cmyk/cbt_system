<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// user check
$res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

if($res->num_rows > 0){

    $user = $res->fetch_assoc();

    // 🔥 SESSION SAVE (IMPORTANT)
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name']    = $user['name'];   // ⭐ THIS WAS MISSING
    $_SESSION['role']    = $user['role'];

    // redirect by role
    if($user['role'] == 'admin'){
        header("Location: admin/dashboard.php");
    }else{
        header("Location: home.php");
    }

}else{
    echo "<script>alert('Invalid Login'); window.location='login.php';</script>";
}
?>