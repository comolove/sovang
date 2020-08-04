<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";

$frontPcImage = isset($_FILES["frontPcImage"]) ? $_FILES["frontPcImage"] : "";
$backPcImage = isset($_FILES["backPcImage"]) ? $_FILES["backPcImage"] : "";
$mobileImage = isset($_FILES["mobileImage"]) ? $_FILES["mobileImage"] : "";

if (IsNullOrEmptyString($title))
{
    AlertAndRedirectToAdmin("title is null");
    exit();
}

if (IsNullOrEmptyString($desc))
{
    AlertAndRedirectToAdmin("desc is null");
    exit();
}

$imageUploader = new ImageUploader();
$frontImageID = $imageUploader->UploadImages($title, $frontPcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    Alert($frontImageID);
    // Alert("흑백 이미지 업로드 실패");
    AlertAndRedirectToAdmin("흑백 이미지 업로드 실패");
}

$backImageID = $imageUploader->UploadImages($title, $backPcImage);
if ($imageUploader->IsFail())
{
    Alert($backImageID);
    // Alert("컬러 이미지 업로드 실패");
    AlertAndRedirectToAdmin("컬러 이미지 업로드 실패");
}

$insertSQL = "INSERT INTO present_project (title, `desc`, front_img, back_img) VALUES ('$title', '$desc', $frontImageID, $backImageID)";

$conn = CreateConnection();
if ($conn->query($insertSQL) !== TRUE)
{
    AlertAndRedirectToAdmin("이미지 업로드 쿼리 실패");
}
$conn->close();

AlertAndRedirectToAdmin("업로드 성공");
?>