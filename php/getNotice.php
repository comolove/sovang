<?php
require_once "utils.php";
require_once "db.php";

$list = array();

$selectSQL = "SELECT `index`, `title`, `content`, `author`, `created_at` AS createdAt FROM notice";

$conn = CreateConnection();
if ($result = $conn->query($selectSQL))
{
    while($row = $result->fetch_assoc())
    {
        array_push($list, array(
            "index" => $row["index"],
            "title" => $row["title"],
            "content" => $row["content"],
            "author" => $row["author"],
            "createdAt" => $row["createdAt"]
        ));
    }
}
$conn->close();

$message = MakeMessage(TRUE, "read success", $list);
Response(200, $message);
?>