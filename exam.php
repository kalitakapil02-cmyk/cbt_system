<?php
session_start();
include 'db.php';

if(!isset($_GET['subject'])){
    die("Subject not found!");
}

$subject_id = $_GET['subject'];

$getSub = $conn->query("SELECT * FROM subjects WHERE id='$subject_id'");
$subRow = $getSub->fetch_assoc();

if(!$subRow){
    die("Invalid subject!");
}

$subject_name = $subRow['subject_name'];

$q = $conn->query("SELECT * FROM questions 
                   WHERE subject_id='$subject_id' 
                   ORDER BY RAND() LIMIT 5");

if($q->num_rows == 0){
    die("⚠️ No questions added for this subject yet!");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Exam</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- RULES SCREEN -->
<div id="warningBox" style="position:fixed;top:0;left:0;width:100%;height:100%;background:black;color:white;z-index:9999;display:flex;justify-content:center;align-items:center;text-align:center;flex-direction:column;">
<h1>⚠ Exam Rules</h1>
<p>Fullscreen mode will be enabled</p>
<p>Tab change / Minimize = Auto Submit</p>
<button onclick="startExam()" class="btn btn-success mt-3">Start Exam</button>
</div>

<div class="container mt-4">
<h3 class="text-center mb-3">📝 Subject: <?php echo $subject_name; ?></h3>

<!-- PER QUESTION TIMER -->
<div class="alert alert-danger text-center">
⏳ Question Time Left: <span id="qTimer">120</span> sec
</div>

<form method="POST" action="submit.php?subject=<?php echo $subject_id; ?>">

<div id="questionBox">

<?php $i=0; while($row = $q->fetch_assoc()){ $i++; ?>

<div class="question-slide" id="qslide<?php echo $i; ?>" style="display:none">

<div class="card mb-3 shadow-sm">
<div class="card-body">

<h5>Q<?php echo $i; ?>. <?php echo $row['question']; ?></h5>

<input type="radio" name="q<?php echo $row['id']; ?>" value="1"> <?php echo $row['option1']; ?><br>
<input type="radio" name="q<?php echo $row['id']; ?>" value="2"> <?php echo $row['option2']; ?><br>
<input type="radio" name="q<?php echo $row['id']; ?>" value="3"> <?php echo $row['option3']; ?><br>
<input type="radio" name="q<?php echo $row['id']; ?>" value="4"> <?php echo $row['option4']; ?><br>

</div>
</div>

</div>

<?php } ?>

</div>

<button type="button" onclick="nextQuestion()" class="btn btn-warning w-100 mb-2">Next Question</button>
<button class="btn btn-success w-100">Submit Exam</button>

</form>
</div>

<script>
// START EXAM
function startExam(){
    document.getElementById("warningBox").style.display="none";
    document.documentElement.requestFullscreen();
}

// QUESTION SLIDER + TIMER
let currentQuestion = 1;
let totalQuestions = document.getElementsByClassName("question-slide").length;
let timePerQuestion = 120;
let timeLeft = timePerQuestion;
const timerEl = document.getElementById("qTimer");

document.getElementById("qslide1").style.display="block";
startQuestionTimer();

function startQuestionTimer(){
    timerEl.innerText = timeLeft;
    let interval = setInterval(()=>{
        timeLeft--;
        timerEl.innerText = timeLeft;
        if(timeLeft <= 0){
            clearInterval(interval);
            nextQuestion();
        }
    },1000);
}

function nextQuestion(){
    document.getElementById("qslide"+currentQuestion).style.display="none";
    currentQuestion++;
    if(currentQuestion > totalQuestions){
        alert("Exam Finished!");
        document.forms[0].submit();
        return;
    }
    document.getElementById("qslide"+currentQuestion).style.display="block";
    timeLeft = timePerQuestion;
    startQuestionTimer();
}

// 🚨 ANTI CHEAT
document.addEventListener("visibilitychange",()=>{ if(document.hidden){ document.forms[0].submit(); }});
window.onblur=()=>document.forms[0].submit();
document.addEventListener("fullscreenchange",()=>{ if(!document.fullscreenElement){ document.forms[0].submit(); }});
document.oncontextmenu=()=>false;
document.oncopy=()=>false;
document.onpaste=()=>false;
document.oncut=()=>false;
document.onkeydown=e=>{
 if(e.keyCode==123) return false;
 if(e.ctrlKey&&e.shiftKey&&e.keyCode==73) return false;
 if(e.ctrlKey&&e.keyCode==85) return false;
};
</script>

</body>
</html>