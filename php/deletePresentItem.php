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

$selectSQL = "SELECT 
                I1.pc AS frontPcPath, 
                I1.mobile AS frontMobilePath,
                I2.pc AS backPcPath,
                I2.mobile AS backMobilePath 
            FROM present_item AS CS 
                INNER JOIN image AS I1 ON I1.index=CS.thumb_img 
                INNER JOIN image AS I2 ON I2.index=CS.body_img
            WHERE CS.index=$index";
$deleteSQL = "DELETE FROM CS, I1, I2 
                USING present_item AS CS 
                    INNER JOIN image AS I1 ON CS.thumb_img=I1.index 
                    INNER JOIN image AS I2 ON CS.body_img=I2.index
                WHERE CS.index=$index";

$conn = CreateConnection();

// Delete image file
if ($result = $conn->query($selectSQL))
{
    while($row = $result->fetch_assoc())
    {
        $frontPcPath = $row["frontPcPath"];
        $frontMobilePath = $row["frontMobilePath"];
        $backPcPath = $row["backPcPath"];
        $backMobilePath = $row["backMobilePath"];

        DeleteFilesIfExists($frontPcPath, $frontMobilePath, $backPcPath, $backMobilePath);
    }
}

// Delete image path in db
$result = $conn->query($deleteSQL);

$conn->close();

$message = MakeMessage(TRUE, "delete success");
Response(200, $message);
?>