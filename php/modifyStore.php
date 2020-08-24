<?php
require_once "utils.php";
require_once "db.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$index = isset($_POST["index"]) ? $_POST["index"] : "";
$storeName = isset($_POST["storeName"]) ? $_POST["storeName"] : "";
$link = isset($_POST["link"]) ? $_POST["link"] : "";

$updateSQL = "
UPDATE store
SET
`store_name` = '$storeName',
`link` = '$link'
WHERE `index` = $index
";

$conn = CreateConnection();

if ($conn->query($updateSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "수정 실패", $conn->error);
    Response(500, $message);
    exit();
}

$conn->close();

$message = MakeMessage(TRUE, "수정 성공");
Response(200, $message);
?>