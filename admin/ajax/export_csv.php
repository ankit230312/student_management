<?php session_start();

if (!isset($_SESSION['user_id'])) {

    header('Location: ../index.php');
    exit();
  }
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=students.csv');

$conn = new mysqli('localhost', 'root', '', 'student_management');
$result = $conn->query("SELECT * FROM students");

$output = fopen("php://output", "w");
fputcsv($output, ['S.no','Name', 'Age', 'Mobile', 'Email', 'Gender', 'Address', 'Status','Create At']);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
