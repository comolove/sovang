<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$storeIndex = isset($_POST["storeIndex"]) ? $_POST["storeIndex"] : "";

$pcImage = isset($_FILES["pcImage"]) ? $_FILES["pcImage"] : "";
$mobileImage = isset($_FILES["mobileImage"]) ? $_FILES["mobileImage"] : "";

if (IsNullOrEmptyString($storeIndex))
{
    $message = MakeMessage(FALSE, "store index is null.");
    Response(400, $message);
}

$imgList = array();

$imageUploader = new ImageUploader();
$result = $imageUploader->UploadImages($storeIndex, $pcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "이미지 업로드 실패");
    Response(500, $message);
}
$imgIndex = $result;

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

array_push($imgList, $imgIndex);
$strImgList = implode(",", $imgList);

$updateSQL = "UPDATE store SET img_list = '$strImgList' WHERE `index` = $storeIndex";
if ($conn->query($updateSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "이미지 업로드 쿼리 실패");
    Response(500, $message);
}
$conn->close();

$message = MakeMessage(TRUE, "업로드 성공");
Response(200, $message);
?>