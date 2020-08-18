<?php
require_once "utils.php";
require_once "imageUploader.php";
require_once "db.php";

$index = isset($_POST["index"]) ? $_POST["index"] : "";
$type = isset($_POST["type"]) ? $_POST["type"] : "";

$newImage = isset($_FILES["newImage"]) ? $_FILES["newImage"] : "";

if (IsNullOrEmptyString($index))
{
    $message = MakeMessage(FALSE, "이미지 인덱스가 없습니다.");
    Response(400, $message);
}

if (IsNullOrEmptyString($type))
{
    $message = MakeMessage(FALSE, "이미지 타입이 없습니다.");
    Response(400, $message);
}

$imageUploader = new ImageUploader();
$result = $imageUploader->ModifyImage($index, $type, $newImage);
if ($imageUploader->IsFail())
{
    $message = MakeMessage(FALSE, "이미지 변경 실패", $result);
    Response(500, $message);
}

$message = MakeMessage(TRUE, "이미지 변경 성공");
Response(200, $message);
?>