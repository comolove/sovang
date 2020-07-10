<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.php_env');
$dotenv->load();

function CreateConnection()
{
    $host = $_ENV["DB_HOST"];
    $user = $_ENV["DB_USER"];
    $pw = $_ENV["DB_PW"];
    $dbName = $_ENV["DB_NAME"];

    $conn = new mysqli($host, $user, $pw, $dbName);
    $conn->set_charset("utf8");

    return $conn;
}
?>