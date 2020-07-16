<?php
require_once "utils.php";
require_once "db.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$storeIndex = isset($_POST["storeIndex"]) ? $_POST["storeIndex"] : "";

if (IsNullOrEmptyString($storeIndex))
{
    $message = MakeMessage(FALSE, "store index is null");
    Response(400, $message);
    exit();
}

$conn = CreateConnection();

// Delete img list
$getImageListSQL = "SELECT img_list AS imgList FROM store WHERE `index`=$storeIndex";
if ($imgListQueryResult = $conn->query($getImageListSQL))
{
    $rawImgList = $imgListQueryResult->fetch_row();
    if (!IsNullOrEmptyString($rawImgList[0]))
    {
        $strImgList = $rawImgList[0];

        $selectSQL = "SELECT `index`, pc AS pcPath, mobile AS mobilePath FROM image WHERE `index` IN ($strImgList)";
        if ($result = $conn->query($selectSQL))
        {
            while($row = $result->fetch_assoc())
            {
                $pcPath = $row["pcPath"];
                $mobilePath = $row["mobilePath"];

                DeleteFileIfExists($pcPath);
                DeleteFileIfExists($mobilePath);

                $deletedImageIndex = $row["index"];

                // Delete image path in db
                $deleteSQL = "DELETE FROM image WHERE `index`=$deletedImageIndex";
                $conn->query($deleteSQL);
            }
        }
    }
}

$selectSQL = "SELECT I.pc AS pcPath, I.mobile AS mobilePath FROM store AS S INNER JOIN image AS I ON I.index=S.home_image WHERE S.index=$storeIndex";
$deleteSQL = "DELETE FROM S, I USING store AS S INNER JOIN image AS I ON S.home_image=I.index WHERE S.index=$storeIndex";

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
if ($conn->query($deleteSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "삭제 실패");
    Response(500, $message);
    exit();
}

$conn->close();

$message = MakeMessage(TRUE, "delete success");
Response(200, $message);
?>