<?php
// turn on output buffering
    ob_start();
    session_start();
    date_default_timezone_set("America/Anchorage");
    $db = $_ENV['DBNAME'];
    $dbhost= $_ENV["DBHOST"];
    $dbuser= $_ENV['DBUSER'];
    $dbpass= $_ENV['DBPASS'];



    try {
        $conn = new PDO("mysql:dbname={$db};host={$dbhost}","$dbuser","$dbpass");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (PDOException $e) {
        exit("Connection failed: " . $e->getMessage());
    }