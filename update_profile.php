<?php
session_start();
include 'db.php';

$uid = $_SESSION['user_id'];

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// if password filled → update password also
if(!empty($password)){
    $conn->query("UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$uid'");
}else{
    $conn->query("UPDATE users SET name='$name', email='$email' WHERE id='$uid'");
}

// update session name
$_SESSION['name'] = $name;

header("Location: profile.php");
?>