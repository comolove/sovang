<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";
$link = isset($_POST["link"]) ? $_POST["link"] : "";

$frontPcImage = isset($_FILES["frontPcImage"]) ? $_FILES["frontPcImage"] : "";
$backPcImage = isset($_FILES["backPcImage"]) ? $_FILES["backPcImage"] : "";
$mobileImage = isset($_FILES["mobileImage"]) ? $_FILES["mobileImage"] : "";

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
$frontImageID = $imageUploader->UploadImages($title, $frontPcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "흑백 이미지 업로드 실패");
    Response(500, $message);
}

$backImageID = $imageUploader->UploadImages($title, $backPcImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "컬러 이미지 업로드 실패");
    Response(500, $message);
}

$insertSQL = "INSERT INTO present_project (title, `desc`, link, front_img, back_img) VALUES ('$title', '$desc', '$link', $frontImageID, $backImageID)";

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