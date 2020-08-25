<?php
require_once "utils.php";
require_once "db.php";
require_once "utils/CateringOrderXLSXWriter.php";
require_once "utils/MailSender.php";
require_once "utils/MessageSender.php";
require_once "utils/SheetWriter.php";

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

$result = array();

$lastListData = null;
if (count($list) > 0)
{
    $lastListData = $list[count($list) - 1];
}

$mailSender = new MailSender();
$emailResult = $mailSender->SendTo("sobang@millcompany.co.kr", "케이터링 상담예약", "신규 케이터링 상담예약이 접수되었습니다 :)", array($filepath));

if ($emailResult == FALSE) 
{
    $message = MakeMessage(FALSE, "이메일 발송 실패", $mailSender->GetError());
    Response(500, $message);
    $conn->close();
    exit();
}

$messageSender = new MessageSender();
$messageResult = $messageSender->SendMessage("신규 케이터링 상담예약이 접수되었습니다 :)", "01047210778", /* Test Mode */"N");
array_push($result, array("messageResult" => $messageResult));

if ($lastListData != null) {
    $sheetWriter = new SheetWriter();
    $data = array(
        "type" => "catering",
        "header_row" => "2",
        "year" => date("Y"),
        "색인" => $lastListData["index"],
        "단체명" => $lastListData["organization"],
        "담당자" => $lastListData["personInCharge"],
        "연락처" => $lastListData["hp"],
        "이메일" => $lastListData["email"],
        "날짜/시간" => $lastListData["date"],
        "인원" => $lastListData["headcount"],
        "결제방법" => $lastListData["payType"],
        "주소" => $lastListData["address"],
        "카테고리" => $lastListData["category"],
        "메뉴구성" => $lastListData["menuItem"],
        "메뉴항목" => $lastListData["menuSet"],
        "추가메뉴" => $lastListData["extraMenu"],
        "추가메시지" => $lastListData["extraMessage"],
        "문의 날짜" => $lastListData["createdAt"]
    );

    $sheetResult = $sheetWriter->WriteToSheet($data);

    array_push($result, array("sheetResult" => $sheetResult));
}

$conn->close();

$message = MakeMessage(TRUE, "insert success", array("message_result" => $result));
Response(200, $message);
?>