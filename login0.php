<?php

session_start();

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /login");
    } else {
        $message = 'Sorry, those credentials do not match';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require 'partials/header.php' ?>
    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>
        Login
    </h1> or
    <a href="signup.php">SignUp</a>
    <form action="login0.php" method="post">
        <input type="text" name="email" placeholder="Enter your mail">
        <input type="password" name="password" placeholder="Enter your pass">
        <input type="submit" value="send">
    </form>
</body>

</html>