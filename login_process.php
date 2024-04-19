<?php
session_start();

require 'db.php';

$errors = [];

// Validate email
if (empty($_POST['email'])) {
    $errors['email'] = "Email is required";
} else {
    $email = $_POST['email'];
}

// Validate password
if (empty($_POST['password'])) {
    $errors['password'] = "Password is required";
} else {
    $password = $_POST['password'];
}

// Redirect if there are errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: /tutorial/login");
    exit(); // Exit immediately after redirection
}

// Check if the email and password match in the database
$stmt = $conn->prepare('SELECT id, name, password FROM user_details WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

// Handle database errors
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();
    if (password_verify($password, $hashed_password)) {
        $_SESSION['name'] = $name; // Set the username in session
        $stmt->close(); // Close the prepared statement before redirection
        $conn->close(); // Close the database connection before redirection
        header('Location: /tutorial/table'); // Redirect to the table page
        exit(); // Exit immediately after redirection
    } else {
        $errors['login'] = "Invalid email or password";
    }
} else {
    $errors['login'] = "Invalid email or password";
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();

// Redirect with errors
$_SESSION['errors'] = $errors;
header("Location: /tutorial/login");
exit(); // Exit immediately after redirection
?>
