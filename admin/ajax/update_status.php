<?php
//
include '../../config/db.php';  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = intval($_POST['id']);
  $status = $_POST['status'] == 'Active' ? 'Active' : 'Inactive';

  
  $stmt = $conn->prepare("UPDATE students SET status = ? WHERE id = ?");
  $stmt->bind_param('si', $status, $id);

  if ($stmt->execute()) {
    echo 'success';
  } else {
    echo 'error';
  }

  $stmt->close();
  $conn->close();
}
