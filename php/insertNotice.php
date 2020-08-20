<?php
require_once "utils.php";
require_once "db.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$content = isset($_POST["content"]) ? $_POST["content"] : "";
$author = isset($_POST["author"]) ? $_POST["author"] : "";

$insertSQL = "
INSERT INTO `notice`
(`title`,
`content`,
`author`,
`created_at`)
VALUES
('$title',
'$content',
'$author',
NOW())
";

$conn = CreateConnection();

if ($conn->query($insertSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "삽입 실패", $conn->error);
    Response(500, $message);
    exit();
}

$conn->close();

$message = MakeMessage(TRUE, "insert success");
Response(200, $message);
?>