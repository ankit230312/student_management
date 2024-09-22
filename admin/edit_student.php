<?php
include_once('common/header.php');

$errors = [];
$successMessage = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = intval($_POST['id']);

  $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
  $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
  $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
  $address = trim(filter_var($_POST['address'], FILTER_SANITIZE_STRING));


  
  if (empty($name)) {
    $errors[] = "Name is required.";
  }
  if (empty($age) || $age <= 0) {
    $errors[] = "A valid age is required.";
  }
  if (!preg_match("/^[0-9]{10}$/", $mobile)) {
    $errors[] = "Please provide a valid 10-digit mobile number.";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please provide a valid email address.";
  }
  if (empty($gender) || !in_array($gender, ['Male', 'Female'])) {
    $errors[] = "Please select a valid gender.";
  }
  if (empty($address)) {
    $errors[] = "Address is required.";
  }

  
  if (empty($errors)) {
    $stmt = $conn->prepare("UPDATE students SET name = ?, age = ?, mobile = ?, email = ?, gender = ?, address = ?  WHERE id = ?");
    $stmt->bind_param("sissssi", $name, $age, $mobile, $email, $gender, $address, $id);

    if ($stmt->execute()) {
      $_SESSION['success_message'] = "Record Edit successfully!";
    } else {
      $_SESSION['error_message'] = "Error: Could not save student information. Please try again.";
    }
    $stmt->close();
    header('Location: index.php');
    exit();
  }
}


if ($id) {
  $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = htmlspecialchars($row['name']);
    $age = $row['age'];
    $mobile = $row['mobile'];
    $email = htmlspecialchars($row['email']);
    $gender = htmlspecialchars($row['gender']);
    $address = htmlspecialchars($row['address']);
  } else {
    $_SESSION['user_not_found'] = 'User not found';
    header("Location: index.php");
    exit;
  }
  $stmt->close();
} else {
  $_SESSION['invalid_id'] = 'Invalid student ID';
  header("Location: index.php");
  exit;
}

?>




  <div class="main-wrapper">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">


            <?php if (!empty($successMessage)): ?>
              <div id="successMessage" class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
              <div id="errorMessage" class="alert alert-danger" role="alert">
                <ul>
                  <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <form id="edit_student" class="row g-3 needs-validation" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" class="form-control" id="id" name="id" placeholder="id" value="<?php echo htmlspecialchars($row['id']); ?>" required>
                  <label for="firstName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="firstName" name="name" placeholder="Name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                  <div class="invalid-feedback">
                    Name is required.
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Age" value="<?php echo htmlspecialchars($row['age']); ?>" required>
                <div class="invalid-feedback">
                  Please provide a valid age.
                </div>
              </div>

              <div class="col-md-6">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Mobile number" required pattern="[0-9]{10}" value="<?php echo htmlspecialchars($row['mobile']); ?>">
                <div class="invalid-feedback">
                  Please provide a valid 10-digit mobile number.
                </div>
              </div>

              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                <div class="invalid-feedback">
                  Please provide a valid email.
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label">Gender</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="invalid-feedback">
                  Please select a gender.
                </div>
              </div>


              <div class="col-md-12">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" placeholder="Enter your address" rows="3" required><?php echo htmlspecialchars($row['address']); ?></textarea>
                <div class="invalid-feedback">
                  Please provide your address.
                </div>
              </div>

              <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit Form</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>

</div>

<?php include_once('common/footer.php'); ?>