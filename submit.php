<?php
session_start();
include 'db.php';

$score = 0;

$questions = $conn->query("SELECT * FROM questions");

while($q = $questions->fetch_assoc()){
    $qid = $q['id'];
    $ans = $_POST["q$qid"] ?? '';

    if($ans == $q['correct']){
        $score++;
    }
}

$user_id = $_SESSION['user_id'];

$conn->query("INSERT INTO results (user_id,score) VALUES ('$user_id','$score')");

header("Location: result.php?score=$score");
?>