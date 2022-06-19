<?php
if (isset($_POST['submitButton'])) {
    echo 'Form was submitted';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flix</title>
    <link rel="stylesheet" href="./assets/style/style.css">
</head>
<body>
<div class="signInContainer">
    <div class="column">
        <div class="header">
            <img src="./assets/img/TrekFlix.png" alt="Site Logo" title="Site Log">
            <h3>Sign In</h3>

        </div>
        <form action="" method="post">
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" name="submitButton" value="SUBMIT">
        </form>
        <a href="register.php" class="signInMessage">Don't have an account? Register here!</a>
    </div>
</div>
</body>
</html>