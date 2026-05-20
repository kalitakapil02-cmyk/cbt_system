<?php
session_start();
include '../db.php';   // ⭐ MOST IMPORTANT (missing tha)

if(!isset($_GET['id'])){
    die("Invalid Request");
}

$id = $_GET['id'];

// delete question
$conn->query("DELETE FROM questions WHERE id='$id'");

header("Location: manage_questions.php");
exit();
?>