<?php


include_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {

  header('Location: ../index.php');
  exit();
}


if (isset($_GET['id'])) {
  $id = $_GET['id'];

  
  $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
  $stmt->bind_param("i", $id);

  
  if ($stmt->execute()) {
    $_SESSION['success_message'] = "Student delete successfully!";
    header('Location: index.php');
    exit();
  } else {
    $_SESSION['error_message'] = "Error: Could not save student information. Please try again.";
    header('Location: index.php');
    exit();
  }
} else {
  echo "Invalid student ID.";
}
