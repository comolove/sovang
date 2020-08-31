<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$pcImage = isset($_FILES["pcImage"]) ? $_FILES["pcImage"] : "";
$mobileImage = isset($_FILES["mobileImage"]) ? $_FILES["mobileImage"] : "";

$imageUploader = new ImageUploader();
$result = $imageUploader->UploadImages($pcImage['name'] , $pcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "이미지 업로드 실패");
    Response(500, $message);
}

$insertSQL = "INSERT INTO present_mainSlide (imageIndex) VALUES($result)";

$conn = CreateConnection();
if ($conn->query($insertSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "이미지 업로드 쿼리 실패");
    Response(500, $message);
}
$conn->close();

$message = MakeMessage(TRUE, "이미지 업로드 성공");
Response(200, $message);
?>