<?php
require_once "utils.php";
require_once "db.php";
require_once "utils/PresentProjectXLSXWriter.php";

$conn = CreateConnection();

$writer = new PresentProjectXLSXWriter();
$list = $writer->LoadDataFromDB($conn);

$conn->close();

$filepath = $writer->Write($list);

$filesize = filesize($filepath);
$path_parts = pathinfo($filepath);
$filename = $path_parts['basename'];
$extension = $path_parts['extension'];

header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

ob_clean();
flush();
readfile($filepath);
?>