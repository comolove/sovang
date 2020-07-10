<?php
    require "utils.php";
    require "db.php";

    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $pw = isset($_POST["password"]) ? $_POST["password"] : "";
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $hp = isset($_POST["hp"]) ? $_POST["hp"] : "";
    $grade = 2;

    if (IsNullOrEmptyString($id))
    {
        $message = MakeMessage(FALSE, "id is null");
        Response(400, $message);
        exit();
    }
    if (IsNullOrEmptyString($pw))
    {
        $message = MakeMessage(FALSE, "pw is null");
        Response(400, $message);
        exit();
    }
    if (IsNullOrEmptyString($name))
    {
        $message = MakeMessage(FALSE, "name is null");
        Response(400, $message);
        exit();
    }
    if (IsNullOrEmptyString($hp))
    {
        $message = MakeMessage(FALSE, "hp is null");
        Response(400, $message);
        exit();
    }

    $encryptHelper = new EncryptHelper();
    $encryptPw = $encryptHelper->Encrypt($pw);
    
    $insertSQL = "INSERT INTO admin (id, password, hp, name, grade) VALUES (?, ?, ?, ?, ?)";

    $conn = CreateConnection();
    $stmt = $conn->prepare($insertSQL);
    $stmt->bind_param("ssssi", $id, $encryptPw, $hp, $name, $grade);
    $result = $stmt->execute();

    if ($result === TRUE)
    {
        $message = MakeMessage(TRUE, "success");
        Response(200, $message);
        $conn->close();
        exit();
    }
    else
    {
        $message = MakeMessage(FALSE, "DB Error : ".$conn->error);
        Response(500, $message);
        $conn->close();
        exit();
    }
?>