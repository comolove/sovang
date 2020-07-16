<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$name = isset($_POST["name"]) ? $_POST["name"] : "";

$pcImage = isset($_FILES["pcImage"]) ? $_FILES["pcImage"] : "";
$mobileImage = isset($_FILES["mobileImage"]) ? $_FILES["mobileImage"] : "";

if (IsNullOrEmptyString($name))
{
    AlertAndRedirectToAdmin("name is null");
    exit();
}

$imageUploader = new ImageUploader();
$result = $imageUploader->UploadImages($name, $pcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    Alert($result);
    AlertAndRedirectToAdmin("이미지 업로드 실패");
}

$insertSQL = "INSERT INTO mainSlide (imageIndex) VALUES($result)";

$conn = CreateConnection();
if ($conn->query($insertSQL) !== TRUE)
{
    AlertAndRedirectToAdmin("이미지 업로드 쿼리 실패");
}
$conn->close();

AlertAndRedirectToAdmin("업로드 성공");
?>