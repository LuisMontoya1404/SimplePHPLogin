<?php

require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        $message = 'Successfully created new user';
    } else {
        $message = 'Sorry there must have been an issue creating your account';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require 'partials/header.php' ?>
    <?php if (!empty($message)) : ?>
        <p> <?= $message ?> </p>
    <?php endif; ?>
    <h1>SignUp</h1> or
    <a href="login0.php">Login</a>
    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Enter your mail">
        <input type="password" name="password" placeholder="Enter your pass">
        <input type="password" name="confirm_password" placeholder="Confirm your pass">
        <input type="submit" value="submit">
    </form>
</body>

</html>