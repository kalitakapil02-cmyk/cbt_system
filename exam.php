<?php
session_start();
include 'db.php';

$result = $conn->query("SELECT * FROM questions");
?>

<form action="submit.php" method="POST">
<?php while($row = $result->fetch_assoc()) { ?>
    <p><?php echo $row['question']; ?></p>

    <input type="radio" name="q<?php echo $row['id']; ?>" value="1"> <?php echo $row['option1']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="2"> <?php echo $row['option2']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="3"> <?php echo $row['option3']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="4"> <?php echo $row['option4']; ?><br>
<?php } ?>

<button type="submit">Submit Exam</button>
</form>