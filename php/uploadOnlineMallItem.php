<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$itemName = isset($_POST["itemName"]) ? $_POST["itemName"] : "";
$itemDesc = isset($_POST["itemDesc"]) ? $_POST["itemDesc"] : "";
$link = isset($_POST["link"]) ? $_POST["link"] : "";

$pcImage = isset($_FILES["pcImage"]) ? $_FILES["pcImage"] : "";
$mobileImage = isset($_FILES["mobileImage"]) ? $_FILES["mobileImage"] : "";

if (IsNullOrEmptyString($itemName))
{
    AlertAndRedirectToAdmin("name is null");
    exit();
}

if (IsNullOrEmptyString($itemDesc))
{
    AlertAndRedirectToAdmin("desc is null");
    exit();
}

if (IsNullOrEmptyString($link))
{
    AlertAndRedirectToAdmin("link is null");
    exit();
}

$imageUploader = new ImageUploader();
$result = $imageUploader->UploadImages($itemName, $pcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    Alert($result);
    AlertAndRedirectToAdmin("이미지 업로드 실패");
}

$insertSQL = "INSERT INTO onlineMall (item_name,item_desc,link,imageIndex) VALUES ('$itemName', '$itemDesc', '$link' ,$result)";

$conn = CreateConnection();
if ($conn->query($insertSQL) !== TRUE)
{
    AlertAndRedirectToAdmin("이미지 업로드 쿼리 실패");
}
$conn->close();

AlertAndRedirectToAdmin("업로드 성공");
?>