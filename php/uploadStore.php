<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$storeName = isset($_POST["storeName"]) ? $_POST["storeName"] : "";
$link = isset($_POST["link"]) ? $_POST["link"] : "";

$pcImage = isset($_FILES["pcImage"]) ? $_FILES["pcImage"] : "";
$mobileImage = isset($_FILES["mobileImage"]) ? $_FILES["mobileImage"] : "";

if (IsNullOrEmptyString($storeName))
{
    AlertAndRedirectToAdmin("store name is null");
    exit();
}

if (IsNullOrEmptyString($link))
{
    AlertAndRedirectToAdmin("link is null");
    exit();
}

$imageUploader = new ImageUploader();
$result = $imageUploader->UploadImages($storeName."-home-image", $pcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    Alert($result);
    AlertAndRedirectToAdmin("업로드 실패");
}

$insertSQL = "INSERT INTO store (store_name,home_image,link) VALUES ('$storeName', $result, '$link')";

$conn = CreateConnection();
if ($conn->query($insertSQL) !== TRUE)
{
    AlertAndRedirectToAdmin("업로드 쿼리 실패");
}
$conn->close();

AlertAndRedirectToAdmin("업로드 성공");
?>