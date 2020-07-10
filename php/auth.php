<?php
    require "utils.php";
    require "db.php";

    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $pw = isset($_POST["password"]) ? $_POST["password"] : "";

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

    $encryptHelper = new EncryptHelper();

    $selectSQL = "SELECT password, grade, name FROM admin WHERE id='".$id."'";

    $conn = CreateConnection();
    $result = $conn->query($selectSQL);
    if ($result === FALSE)
    {
        $message = MakeMessage(FALSE, "DB Error : ".$conn->error);
        Response(500, $message);
        $conn->close();
        exit();
    }
    else
    {
        if ($result->num_rows == 0)
        {
            $message = MakeMessage(FALSE, "Couldn't find id");
            Response(404, $message);
            $conn->close();
            exit();
        }
        
        $array = $result->fetch_assoc();
        $encryptPw = $array["password"];
        $grade = $array["grade"];
        $name = $array["name"];

        $decrypePw = $encryptHelper->Decrypt($encryptPw);

        if ($decrypePw == $pw)
        {
            $message = MakeMessage(TRUE, "login success", array("grade" => $grade, "name" => $name));
            Response(200, $message);
            $conn->close();
            exit();
        }
        else
        {
            $message = MakeMessage(FALSE, "pw is wrong");
            Response(404, $message);
            $conn->close();
            exit();
        }
    }

?>