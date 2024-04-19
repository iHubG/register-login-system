<?php
require 'db.php';

session_start();

$errors = [];

if (empty($_POST['name'])) {
    $errors['name'] = "Name is required";
} else {
    $name = $_POST['name'];
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $errors['name'] = "Only letters and white space allowed";
    }
}

if (empty($_POST['email'])) {
    $errors['email'] = "Email is required";
} else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
}

if (empty($_POST['password'])) {
    $errors['password'] = "Password is required";
} else {
    $password = $_POST['password'];
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long";
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: /tutorial/register");
    exit();
}


if ($stmt = $conn->prepare('SELECT id, password FROM user_details WHERE name = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['name']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
        $_SESSION['name'] = $_POST['name'];
        header('Location: table.php');

	} else {
		// Insert new account
        // Username doesn't exists, insert new account
        if ($stmt = $conn->prepare('INSERT INTO user_details (name, password, email) VALUES (?, ?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['name'], $password, $_POST['email']);
            $stmt->execute();
            $_SESSION['name'] = $_POST['name'];
            echo 'You have successfully registered! You can now login!';
            header('Location: /tutorial/table');
        } else {
            // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
            echo 'Could not prepare statement!';
        }
	}
	$stmt->close();
} else {
	// Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$conn->close();
?>

