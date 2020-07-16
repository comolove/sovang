<?php
    require_once "utils.php";
    require_once "db.php";

    $_POST = json_decode(file_get_contents("php://input"), true);
    
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
            $message = MakeMessage(FALSE, "ID를 찾을 수 없습니다.");
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
            $message = MakeMessage(FALSE, "비밀번호가 틀립니다.");
            Response(404, $message);
            $conn->close();
            exit();
        }
    }

?>