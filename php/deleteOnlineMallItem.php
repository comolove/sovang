<?php
require_once "utils.php";
require_once "db.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$index = isset($_POST["index"]) ? $_POST["index"] : "";
if (IsNullOrEmptyString($index))
{
    $message = MakeMessage(FALSE, "index is null");
    Response(400, $message);
    exit();
}

$selectSQL = "SELECT I.pc AS pcPath, I.mobile AS mobilePath FROM onlineMall AS O INNER JOIN image AS I ON I.index=O.imageIndex WHERE O.index=$index";
$deleteSQL = "DELETE FROM O, I USING onlineMall AS O INNER JOIN image AS I ON O.imageIndex=I.index WHERE O.index=$index";

$conn = CreateConnection();

// Delete image file
if ($result = $conn->query($selectSQL))
{
    while($row = $result->fetch_assoc())
    {
        $pcPath = $row["pcPath"];
        $mobilePath = $row["mobilePath"];

        DeleteFileIfExists($pcPath);
        DeleteFileIfExists($mobilePath);
    }
}

// Delete image path in db
$result = $conn->query($deleteSQL);

$conn->close();

$message = MakeMessage(TRUE, "delete success");
Response(200, $message);
?>