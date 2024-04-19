<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['name'])) {
    $username = htmlspecialchars($_SESSION['name']);
} else {
    // If the user is not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}

require 'db.php';

$sql = "SELECT name, email, date_created FROM user_details";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->execute();
    $stmt->bind_result($name, $email, $date);
    $users = [];
    while ($stmt->fetch()) {
        $user = [
            'name' => $name,
            'email' => $email,
            'date_created' => $date,
        ];
        $users[] = $user;
    }
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>    
<div class="container bg-info-subtle my-5">
    <p class="h4 lead"><?php echo isset($_SESSION['name']) ? "Hello, Welcome " . htmlspecialchars($_SESSION['name']) : ""; ?></p>
    <div class="row">
        <div class="col-4 text-center" id="name">
            <h2>Name</h2>
            <?php foreach ($users as $user) : ?>
            <p class="fs-5 border border-black"><?php echo htmlspecialchars($user['name']); ?></p>
            <?php endforeach; ?>
        </div>
        <div class="col-4 text-center" id="email">
            <h2>Email</h2>
            <?php foreach ($users as $user) : ?>
            <p class="fs-5 border border-black"><?php echo htmlspecialchars($user['email']); ?></p>
            <?php endforeach; ?>
        </div>
        <div class="col-4 text-center" id="age">
            <h2>Date Created</h2>
            <?php foreach ($users as $user) : ?>
            <p class="fs-5 border border-black"><?php echo htmlspecialchars($user['date_created']); ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
