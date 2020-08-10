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
    $message = MakeMessage(FALSE, "제목이 없습니다.");
    Response(400, $message);
}

if (IsNullOrEmptyString($desc))
{
    $message = MakeMessage(FALSE, "설명이 없습니다.");
    Response(400, $message);
}

$imageUploader = new ImageUploader();
$frontImageID = $imageUploader->UploadImages($title, $frontPcImage, $frontMobileImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "흑백 이미지 업로드 실패");
    Response(500, $message);
}

$backImageID = $imageUploader->UploadImages($title, $backPcImage, $backMobileImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "컬러 이미지 업로드 실패");
    Response(500, $message);
}

$insertSQL = "INSERT INTO catering_story (title, `desc`, front_img, back_img) VALUES ('$title', '$desc', $frontImageID, $backImageID)";

$conn = CreateConnection();
if ($conn->query($insertSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "이미지 업로드 쿼리 실패");
    Response(500, $message);
}
$conn->close();

$message = MakeMessage(TRUE, "업로드 성공");
Response(200, $message);
?>