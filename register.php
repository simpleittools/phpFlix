<?php
    include_once('./layouts/header.php');

    $account = new Account($conn);

    if(isset($_POST["submitButton"])){
        $firstName = FormSanitizer::sanitizeFormString($_POST['firstName']);
        $lastName = FormSanitizer::sanitizeFormString($_POST['lastName']);
        $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
        $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST['email2']);
        $password = FormSanitizer::sanitizeFormPassword($_POST['password']);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST['password2']);
        $success = $account->register(
                $firstName,
                $lastName,
                $username,
                $email,
                $email2,
                $password,
                $password2
        );

        if($success) {
            $_SESSION['userLoggedIn'] = $username;
            header("Location: index.php");
        }


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
                <h3>Sign Up</h3>
                <span>to continue to TrekFlix</span>

            </div>
            <form method="post">
                <?= $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" placeholder="First Name" name="firstName" value="<?php getInputValue('firstName');?>" required>

                <?= $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" placeholder="Last Name" name="lastName" value="<?php getInputValue('lastName');?>" required>
                <?= $account->getError(Constants::$usernameCharacters); ?>
                <?= $account->getError(Constants::$usernameTaken); ?>
                <input type="text" placeholder="Username" name="username" value="<?php getInputValue('username');?>" required>
                <?= $account->getError(Constants::$emailsDontMatch); ?>
                <?= $account->getError(Constants::$emailInvalid); ?>
                <?= $account->getError(Constants::$emailTaken); ?>
                <input type="email" placeholder="Email" name="email" value="<?php getInputValue('email');?>" required>
                <input type="email" placeholder="Confirm Email" name="email2" value="<?php getInputValue('email2');?>" required>
                <?= $account->getError(Constants::$passwordsDontMatch); ?>
                <?= $account->getError(Constants::$passwordLength); ?>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="password2" required>
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
        </div>
    </div>
</body>
</html>