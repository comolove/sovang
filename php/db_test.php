<?php
    require __DIR__ . '/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.php_env');
    $dotenv->load();

    echo "DB 테스트<br>";
    $host = $_ENV["DB_HOST"];
    $user = $_ENV["DB_USER"];
    $pw = $_ENV["DB_PW"];
    $dbName = $_ENV["DB_NAME"];
    $mysqli = mysqli_connect($host, $user, $pw, $dbName);

    if (mysqli_connect_errno())
    {
        echo "Faild to connect MySQL : " . mysqli_connect_error() . "<br>";
    }
    else
    {
        echo "성공<br>";
    }

    mysqli_close($mysqli)
?>