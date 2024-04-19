<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['errors'], $_SESSION['form_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container-lg">
        <div class="row justify-content-center my-5">
            <div class="col-lg-6">
                <form action="/tutorial/register_validation" method="post">
                <h2 class="text-center">Register</h2>
                
                <!-- Email Address -->
                <label for="email" class="form-label fw-bold">Email address:</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope-at"></i>
                    </span>
                    <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="yourname@example.com" autocomplete="off" value="<?php echo $form_data['email'] ?? ''; ?>" required> 
                </div>

                <!-- Display Email Validation Error -->
                <?php if (!empty($errors['email'])): ?>
                    <div class="text-danger"><?php echo $errors['email']; ?></div>
                <?php endif; ?>

                <!-- Name -->
                <label for="name" class="form-label mt-2 fw-bold">Name:</label><br>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Fullname" autocomplete="off" value="<?php echo $form_data['name'] ?? ''; ?>" required>
                </div>

                <!-- Display Name Validation Error -->
                <?php if (!empty($errors['name'])): ?>
                    <div class="text-danger"><?php echo $errors['name']; ?></div>
                <?php endif; ?>

                <!-- Password -->
                <label for="password" class="form-label mt-2 fw-bold">Password:</label><br>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-key"></i>
                    </span>
                    <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password" autocomplete="off" required>
                </div>

                <!-- Display Password Validation Error -->
                <?php if (!empty($errors['password'])): ?>
                    <div class="text-danger"><?php echo $errors['password']; ?></div>
                <?php endif; ?>

                <div class="text-center">
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary my-5">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
