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
            FROM present_project AS PP 
                INNER JOIN image AS I1 ON I1.index=PP.front_img 
                INNER JOIN image AS I2 ON I2.index=PP.back_img
            WHERE PP.index=$index";
$deleteSQL = "DELETE FROM PP, I1, I2 
                USING present_project AS PP 
                    INNER JOIN image AS I1 ON PP.front_img=I1.index 
                    INNER JOIN image AS I2 ON PP.back_img=I2.index
                WHERE PP.index=$index";

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