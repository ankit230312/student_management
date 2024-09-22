<?php include_once('common/header.php');
?>







<div class="main-wrapper">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <?php

                    include_once('common/header.php');


                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }

                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    $result = $conn->query("SELECT * FROM students");

                    if ($result->num_rows > 0): ?>

                        <div class="container ">


                            <div class="row my-3">
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                    <h2 class="mb-0 me-auto">Student List</h2>
                                    <div class="d-flex align-items-center"> <!-- Add a flex container here -->
                                        <a href="add_student.php" class="btn btn-success me-2">Add Student</a>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Export Excel/CSV
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="ajax/export_excel.php">Export Excel</a></li>
                                                <li><a class="dropdown-item" href="ajax/export_csv.php">Export CSV</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="table-responsive">
                                <table class="table table-bordered" id="student_data">
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
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
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
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input status-toggle" type="checkbox" role="switch" id="status_<?php echo $row['id']; ?>"
                                                            data-id="<?php echo $row['id']; ?>" <?php echo ($row['status'] == 'Active') ? 'checked' : ''; ?>>

                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            No students found.
                        </div>
                    <?php endif;

                    $conn->close();
                    ?>

                </div>
            </div>
        </div>
    </div>


</div>


</div>




<?php include_once('common/footer.php'); ?>