<?php
session_start();
include '../db.php';

$msg = "";

/* FETCH SUBJECTS FOR DROPDOWN (FIXED COLUMN NAME) */
$subjects = $conn->query("SELECT id, subject_name FROM subjects ORDER BY subject_name ASC");

/* ADD QUESTION */
if(isset($_POST['add']))
{
    $q = mysqli_real_escape_string($conn,$_POST['question']);
    $o1 = mysqli_real_escape_string($conn,$_POST['o1']);
    $o2 = mysqli_real_escape_string($conn,$_POST['o2']);
    $o3 = mysqli_real_escape_string($conn,$_POST['o3']);
    $o4 = mysqli_real_escape_string($conn,$_POST['o4']);
    $correct = $_POST['correct'];
    $subject = $_POST['subject'];

    if($subject == ""){
        $msg = "<div class='alert alert-danger'>⚠ Please select subject</div>";
    }
    else{
        $conn->query("INSERT INTO questions 
        (question, option1, option2, option3, option4, correct, subject_id)
        VALUES('$q','$o1','$o2','$o3','$o4','$correct','$subject')");

        $msg = "<div class='alert alert-success'>Question Added Successfully 🎉</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Question</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
<div class="card shadow p-4">

<h3 class="mb-3">➕ Add Question</h3>

<?php echo $msg; ?>

<form method="POST">

<label class="form-label">Question</label>
<textarea name="question" class="form-control mb-3" required></textarea>

<label>Option 1</label>
<input name="o1" class="form-control mb-2" required>

<label>Option 2</label>
<input name="o2" class="form-control mb-2" required>

<label>Option 3</label>
<input name="o3" class="form-control mb-2" required>

<label>Option 4</label>
<input name="o4" class="form-control mb-3" required>

<label>Correct Option Number (1-4)</label>
<select name="correct" class="form-control mb-3" required>
<option value="">Select Correct Option</option>
<option value="1">Option 1</option>
<option value="2">Option 2</option>
<option value="3">Option 3</option>
<option value="4">Option 4</option>
</select>

<!-- SUBJECT DROPDOWN FIXED -->
<label>Select Subject</label>
<select name="subject" class="form-control mb-3" required>
<option value="">Select Subject</option>

<?php while($sub = $subjects->fetch_assoc()){ ?>
<option value="<?php echo $sub['id']; ?>">
<?php echo $sub['subject_name']; ?>
</option>
<?php } ?>

</select>

<button name="add" class="btn btn-primary w-100">Add Question</button>

</form>
</div>
</div>

</body>
</html>