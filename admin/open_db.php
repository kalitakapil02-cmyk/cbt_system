<?php
$conn = new mysqli("localhost","root","","cbt_db");

if($conn->connect_error){
    die("Database Connection Failed");
}
?>