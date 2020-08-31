<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";
$popupTitle = isset($_POST["popupTitle"]) ? $_POST["popupTitle"] : "";
$body = isset($_POST["body"]) ? $_POST["body"] : "";

$thumbPcImg = isset($_FILES["thumbPcImg"]) ? $_FILES["thumbPcImg"] : "";
$thumbMobileImg = isset($_FILES["thumbMobileImg"]) ? $_FILES["thumbMobileImg"] : "";
$bodyPcImage = isset($_FILES["bodyPcImage"]) ? $_FILES["bodyPcImage"] : "";
$bodyMobileImage = isset($_FILES["bodyMobileImage"]) ? $_FILES["bodyMobileImage"] : "";

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
$frontImageID = $imageUploader->UploadImages($title, $thumbPcImg, $thumbMobileImg);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "이미지 업로드 실패");
    Response(500, $message);
}

$backImageID = $imageUploader->UploadImages($title, $bodyPcImage, $bodyMobileImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "팝업 이미지 업로드 실패");
    Response(500, $message);
}

$insertSQL = "INSERT INTO present_item (title, `desc`, popup_title, body, thumb_img, body_img) VALUES ('$title', '$desc', '$popupTitle', '$body', $frontImageID, $backImageID)";

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