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
    $message = MakeMessage(FALSE, "상품 이름이 없습니다.");
    Response(400, $message);
}

if (IsNullOrEmptyString($itemDesc))
{
    $message = MakeMessage(FALSE, "상품 설명이 없습니다.");
    Response(400, $message);
}

if (IsNullOrEmptyString($link))
{
    $message = MakeMessage(FALSE, "상품 링크가 없습니다.");
    Response(400, $message);
}

$imageUploader = new ImageUploader();
$result = $imageUploader->UploadImages($itemName, $pcImage, $mobileImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "이미지 업로드 실패");
    Response(500, $message);
}

$insertSQL = "INSERT INTO online_mall (item_name,item_desc,link,imageIndex) VALUES ('$itemName', '$itemDesc', '$link' ,$result)";

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