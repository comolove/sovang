<?php
require_once "utils.php";
require_once "db.php";
require_once "utils/CateringOrderXLSXWriter.php";
require_once "utils/MailSender.php";
require_once "utils/MessageSender.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$organization = isset($_POST["organization"]) ? $_POST["organization"] : "";
$personInCharge = isset($_POST["personInCharge"]) ? $_POST["personInCharge"] : "";
$hp = isset($_POST["hp"]) ? $_POST["hp"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$date = isset($_POST["date"]) ? $_POST["date"] : "";
$headcount = isset($_POST["headcount"]) ? $_POST["headcount"] : "";
$payType = isset($_POST["payType"]) ? $_POST["payType"] : "";
$address = isset($_POST["address"]) ? $_POST["address"] : "";
$category = isset($_POST["category"]) ? $_POST["category"] : "";
$menuItem = isset($_POST["menuItem"]) ? $_POST["menuItem"] : "";
$menuSet = isset($_POST["menuSet"]) ? $_POST["menuSet"] : "";
$extraMenu = isset($_POST["extraMenu"]) ? $_POST["extraMenu"] : "";
$extraMessage = isset($_POST["extraMessage"]) ? $_POST["extraMessage"] : "";

$insertSQL = "
INSERT INTO `catering_order`
(`organization`,
`person_in_charge`,
`hp`,
`email`,
`date`,
`headcount`,
`pay_type`,
`address`,
`category`,
`menu_item`,
`menu_set`,
`extra_menu`,
`extra_message`,
`created_at`)
VALUES
('$organization',
'$personInCharge',
'$hp',
'$email',
'$date',
'$headcount',
'$payType',
'$address',
'$category',
'$menuItem',
'$menuSet',
'$extraMenu',
'$extraMessage',
NOW())
";

$conn = CreateConnection();

if ($conn->query($insertSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "삽입 실패");
    Response(500, $message);
    $conn->close();
    exit();
}

$writer = new CateringOrderXLSXWriter();
$list = $writer->LoadDataFromDB($conn);
$filepath = $writer->Write($list);

$mailSender = new MailSender();
$result = $mailSender->SendTo("sobang@millcompany.co.kr", "케이터링 상담예약", "신규 케이터링 상담예약이 접수되었습니다 :)", array($filepath));

if ($result == FALSE) 
{
    $message = MakeMessage(FALSE, "이메일 발송 실패", $result->GetError());
    Response(500, $message);
    $conn->close();
    exit();
}

$messageSender = new MessageSender();
$result = $messageSender->SendMessage("신규 케이터링 상담예약이 접수되었습니다 :)", "01047210778", /* Test Mode */"N");

$conn->close();

$message = MakeMessage(TRUE, "insert success", array("message_result" => $result));
Response(200, $message);
?>