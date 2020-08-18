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
    $message = MakeMessage(FALSE, "매장 이름이 없습니다.");
    Response(400, $message);
}

if (IsNullOrEmptyString($link))
{
    $message = MakeMessage(FALSE, "매장 링크가 없습니다.");
    Response(400, $message);
}

$imageUploader = new ImageUploader();
$result = $imageUploader->UploadImages($storeName."-home-image", $pcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "이미지 업로드 실패");
    Response(500, $message);
}

$insertSQL = "INSERT INTO store (store_name,home_image,link) VALUES ('$storeName', $result, '$link')";

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