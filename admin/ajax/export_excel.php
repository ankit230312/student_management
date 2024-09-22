<?php session_start();

if (!isset($_SESSION['user_id'])) {

    header('Location: ../index.php');
    exit();
}
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=students.xls');

$conn = new mysqli('localhost', 'root', '', 'student_management');
$result = $conn->query("SELECT * FROM students");

echo '<table class="table table-bordered" id="student_data" border="1">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Create Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

$counter = 1;
while ($row = $result->fetch_assoc()):
?>
    <tr>
        <th scope="row"><?php echo $counter++; ?></th>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['mobile']); ?></td>
        <td><?php echo htmlspecialchars($row['gender']); ?></td>
        <td><?php echo htmlspecialchars($row['age']); ?></td>
        <td><?php echo htmlspecialchars($row['address']); ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo date('d-M-Y', strtotime($row['created_at'])); ?></td>

    </tr>
<?php endwhile; ?>
</tbody>

</table><?php
        exit;
        ?>