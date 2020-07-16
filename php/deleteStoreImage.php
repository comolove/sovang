<?php
require_once "utils.php";
require_once "db.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$storeIndex = isset($_POST["storeIndex"]) ? $_POST["storeIndex"] : "";
$imageIndex = isset($_POST["imageIndex"]) ? $_POST["imageIndex"] : "";

if (IsNullOrEmptyString($storeIndex))
{
    $message = MakeMessage(FALSE, "store index is null");
    Response(400, $message);
    exit();
}

if (IsNullOrEmptyString($imageIndex))
{
    $message = MakeMessage(FALSE, "image index is null");
    Response(400, $message);
    exit();
}

$conn = CreateConnection();
$getImageListSQL = "SELECT img_list AS imgList FROM store WHERE `index`=$storeIndex";
if ($imgListQueryResult = $conn->query($getImageListSQL))
{
    $rawImgList = $imgListQueryResult->fetch_row();
    if (!IsNullOrEmptyString($rawImgList[0]))
    {
        $imgList = explode(",", $rawImgList[0]);
    }
}

$deletedImageIndex = $imgList[$imageIndex];
array_splice($imgList, $imageIndex, 1);

// Delete image file
$selectSQL = "SELECT pc AS pcPath, mobile AS mobilePath FROM image WHERE `index`=$deletedImageIndex";
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
$deleteSQL = "DELETE FROM image WHERE `index`=$deletedImageIndex";
if ($conn->query($deleteSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "삭제 쿼리 실패");
    Response(500, $message);
    exit();
}

$strImgList = implode(",", $imgList);

$updateSQL = "UPDATE store SET img_list = '$strImgList' WHERE `index` = $storeIndex";
if ($conn->query($updateSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "업데이트 쿼리 실패");
    Response(500, $message);
    exit();
}
$conn->close();

$message = MakeMessage(TRUE, "delete success");
Response(200, $message);
?>