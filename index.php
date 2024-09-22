<?php

include_once('common/auth_header.php');

$errors = [];
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    
    if (empty($errors)) {
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['success_message'] = "Login Success";
            header('Location: admin/index.php');
        } else {
            $errors[] = "Invalid email or password.";
            
        }

        $stmt->close();
    }
}
?>

<div class="card login-box-container">
    <div class="card-body">
        <div class="authent-logo">
            <a href="#">User Login</a>
        </div>

        
        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <label for="email">Email address</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                    <label for="password">Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePasswordVisibility('password','togglePasswordIconLogin')">
                        <i class="fas fa-eye" id="togglePasswordIconLogin"></i>
                    </span>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-info m-b-xs">Sign In</button>
            </div>
        </form>
        <div class="authent-reg">
            <p>Not registered? <a href="register.php">Create an account</a></p>
        </div>
    </div>
</div>



<?php include_once('common/auth_footer.php'); ?>