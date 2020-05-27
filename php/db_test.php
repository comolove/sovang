<?php
    echo "DB 테스트<br>";
    $host = 'localhost';
    $user = 'admin';
    $pw = 'sovang135';
    $dbName = 'test_db';
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