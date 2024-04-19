<?php
session_start();

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

// Clear errors and form data from session
unset($_SESSION['errors']);
unset($_SESSION['form_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container-lg">
    <div class="row justify-content-center my-5">
        <div class="col-lg-6">
            <form action="/tutorial/login_process" method="post">
                <h2 class="text-center">Login</h2>
                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email address:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope-at"></i>
                        </span>
                        <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) : ''; ?>" placeholder="yourname@example.com" autocomplete="off" required>
                    </div>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="text-danger"><?php echo $errors['email']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-key"></i>
                        </span>
                        <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" autocomplete="off" required>
                    </div>

                    <?php if (!empty($errors['password'])): ?>
                        <div class="text-danger"><?php echo $errors['password']; ?></div>
                    <?php elseif(isset($_POST['password']) && strlen($_POST['password']) < 8): ?>
                        <div class="invalid-feedback">
                            Password must be at least 8 characters long.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Error message for login failure -->
                <?php if(isset($errors['login'])): ?>
                    <div class="mb-3">
                        <div class="text-danger">
                            <?php echo $errors['login']; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="text-center">
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary my-5">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
