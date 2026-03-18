<?php include '../db.php'; ?>

<form method="POST">
Question: <input type="text" name="q"><br>
Option1: <input type="text" name="o1"><br>
Option2: <input type="text" name="o2"><br>
Option3: <input type="text" name="o3"><br>
Option4: <input type="text" name="o4"><br>
Correct (1-4): <input type="text" name="c"><br>

<button name="add">Add</button>
</form>

<?php
if(isset($_POST['add'])){
    $q=$_POST['q'];
    $o1=$_POST['o1'];
    $o2=$_POST['o2'];
    $o3=$_POST['o3'];
    $o4=$_POST['o4'];
    $c=$_POST['c'];

    $conn->query("INSERT INTO questions (question,option1,option2,option3,option4,correct)
                  VALUES ('$q','$o1','$o2','$o3','$o4','$c')");
}
?>