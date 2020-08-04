<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";

$frontPcImage = isset($_FILES["frontPcImage"]) ? $_FILES["frontPcImage"] : "";
$frontMobileImage = isset($_FILES["frontMobileImage"]) ? $_FILES["frontMobileImage"] : "";
$backPcImage = isset($_FILES["backPcImage"]) ? $_FILES["backPcImage"] : "";
$backMobileImage = isset($_FILES["backMobileImage"]) ? $_FILES["backMobileImage"] : "";

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
$frontImageID = $imageUploader->UploadImages($title, $frontPcImage, $frontMobileImage);
if ($imageUploader->IsFail())
{
    Alert($frontImageID);
    AlertAndRedirectToAdmin("흑백 이미지 업로드 실패");
}

$backImageID = $imageUploader->UploadImages($title, $backPcImage, $backMobileImage);
if ($imageUploader->IsFail())
{
    Alert($backImageID);
    AlertAndRedirectToAdmin("컬러 이미지 업로드 실패");
}

$insertSQL = "INSERT INTO catering_story (title, `desc`, front_img, back_img) VALUES ('$title', '$desc', $frontImageID, $backImageID)";

$conn = CreateConnection();
if ($conn->query($insertSQL) !== TRUE)
{
    AlertAndRedirectToAdmin("이미지 업로드 쿼리 실패");
}
$conn->close();

AlertAndRedirectToAdmin("업로드 성공");
?>