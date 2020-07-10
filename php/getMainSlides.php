<?php
require_once "utils.php";
require_once "db.php";

$list = array();

$selectSQL = "SELECT I.name AS name, I.pc AS pcPath, I.mobile AS mobilePath FROM mainSlide AS M INNER JOIN image AS I ON I.index=M.imageIndex;";

$conn = CreateConnection();
if ($result = $conn->query($selectSQL))
{
    while($row = $result->fetch_assoc())
    {
        array_push($list, array("name" => $row["name"], "pcPath" => $row["pcPath"], "mobilePath" => $row["mobilePath"]));
    }
}
$conn->close();

$message = MakeMessage(TRUE, "read success", $list);
Response(200, $message);
?>