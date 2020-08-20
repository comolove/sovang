<?php
require_once "utils.php";
require_once "db.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$index = isset($_POST["index"]) ? $_POST["index"] : "";
$title = isset($_POST["title"]) ? $_POST["title"] : "";
$content = isset($_POST["content"]) ? $_POST["content"] : "";
$author = isset($_POST["author"]) ? $_POST["author"] : "";

$updateSQL = "
UPDATE notice
SET
`title` = '$title',
`content` = '$content',
`author` = '$author'
WHERE `index` = $index
";

$conn = CreateConnection();

if ($conn->query($updateSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "수정", $conn->error);
    Response(500, $message);
    exit();
}

$conn->close();

$message = MakeMessage(TRUE, "insert success");
Response(200, $message);
?>