<?php include_once('common/auth_header.php');

$successMessage = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if (empty($name) || !preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "Invalid or empty name. Only letters";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (
        empty($password) || strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[\W]/', $password)
    ) {
        $errors[] = "Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }


    if (empty($errors)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            $successMessage = "Registration successful!";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<div class="card login-box-container">
    <div class="card-body">
        <div class="authent-logo">
            <a href="#">User Registration</a>
        </div>
        <div class="authent-text"></div>


        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success" id="successMessage" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" id="errorMessage" role="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form id="register_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Fullname" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                    <label for="name">Fullname</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                    <label for="email">Email address</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating position-relative">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    <label for="password">Password</label>

                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePasswordVisibility('password','togglePasswordIcon1')">
                        <i class="fas fa-eye" id="togglePasswordIcon1"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
                    <label for="confirmPassword">Confirm Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePasswordVisibility('confirmPassword','togglePasswordIcon2')">
                        <i class="fas fa-eye" id="togglePasswordIcon2"></i>
                    </span>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary m-b-xs">Register</button>
            </div>
        </form>
        <div class="authent-login">
            <p>Already have an account? <a href="index.php">Sign in</a></p>
        </div>
    </div>
</div>

<?php include_once('common/auth_footer.php'); ?>