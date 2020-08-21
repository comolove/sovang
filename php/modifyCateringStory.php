<?php
require_once "utils.php";
require_once "db.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$index = isset($_POST["index"]) ? $_POST["index"] : "";
$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";
$link = isset($_POST["link"]) ? $_POST["link"] : "";

$updateSQL = "
UPDATE catering_story
SET
`title` = '$title',
`desc` = '$desc',
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