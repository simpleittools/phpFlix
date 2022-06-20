<?php
    require('./vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
    $dotenv->load();
    require_once('./includes/config.php');
    require_once('./includes/classes/Account.php');
    require_once('./includes/classes/FormSanitizer.php');
    require_once('./includes/classes/Constants.php');
    require_once('./includes/functions/fuctions.php');

?>
