<?php
require_once "utils.php";
require_once "db.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$index = isset($_POST["index"]) ? $_POST["index"] : "";
$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";
$popupTitle = isset($_POST["popupTitle"]) ? $_POST["popupTitle"] : "";
$body = isset($_POST["body"]) ? $_POST["body"] : "";

$updateSQL = "
UPDATE present_item
SET
`title` = '$title',
`desc` = '$desc',
`popup_title` = '$popupTitle',
`body` = '$body'
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