<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$storeIndex = isset($_POST["storeIndex"]) ? $_POST["storeIndex"] : "";

$pcImage = isset($_FILES["pcImage"]) ? $_FILES["pcImage"] : "";
$mobileImage = isset($_FILES["mobileImage"]) ? $_FILES["mobileImage"] : "";

if (IsNullOrEmptyString($storeIndex))
{
    AlertAndRedirectToAdmin("store index is null");
    exit();
}

$imgList = array();

$imageUploader = new ImageUploader();
$result = $imageUploader->UploadImages($storeIndex, $pcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    Alert($result);
    AlertAndRedirectToAdmin("이미지 업로드 실패");
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
    AlertAndRedirectToAdmin("업로드 쿼리 실패");
    exit();
}
$conn->close();

AlertAndRedirectToAdmin("업로드 성공");
?>