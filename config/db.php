<?php session_start();

$conn = new mysqli('localhost', 'root', '', 'student_management');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
