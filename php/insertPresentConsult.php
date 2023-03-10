<?php
require_once "utils.php";
require_once "db.php";
require_once "utils/PresentProjectXLSXWriter.php";
require_once "utils/MailSender.php";
require_once "utils/MessageSender.php";
require_once "utils/SheetWriter.php";

$_POST = json_decode(file_get_contents("php://input"), true);

$organization = isset($_POST["organization"]) ? $_POST["organization"] : "";
$personInCharge = isset($_POST["personInCharge"]) ? $_POST["personInCharge"] : "";
$hp = isset($_POST["hp"]) ? $_POST["hp"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$question = isset($_POST["question"]) ? $_POST["question"] : "";

$insertSQL = "
INSERT INTO `present_consult`
(`organization`,
`person_in_charge`,
`hp`,
`email`,
`question`,
`created_at`)
VALUES
('$organization',
'$personInCharge',
'$hp',
'$email',
'$question',
NOW())
";

$conn = CreateConnection();

if ($conn->query($insertSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "삽입 실패");
    Response(500, $message);
    exit();
}

$writer = new PresentProjectXLSXWriter();
$list = $writer->LoadDataFromDB($conn);
$filepath = $writer->Write($list);

$result = array();

$lastListData = null;
if (count($list) > 0)
{
    $lastListData = $list[count($list) - 1];
}

$mailSender = new MailSender();
$mailTitle = date("m월d일")." 명절선물 상담예약";

$mailBody = "신규 명절선물 상담예약이 접수되었습니다 :)\n";
$mailBody = $mailBody."단체명 : $organization\n";
$mailBody = $mailBody."담당자 : $personInCharge\n";
$mailBody = $mailBody."이메일 : $email\n";
$mailBody = $mailBody."연락처 : $hp\n";

$emailResult = $mailSender->SendTo("sobang@millcompany.co.kr", $mailTitle, $mailBody, array($filepath));

if ($emailResult == FALSE) 
{
    $message = MakeMessage(FALSE, "이메일 발송 실패", $mailSender->GetError());
    Response(500, $message);
    $conn->close();
    exit();
}

$messageSender = new MessageSender();
$messageResult = $messageSender->SendMessage("신규 명절선물 상담예약이 접수되었습니다 :)", "01047210778", /* Test Mode */"N");
array_push($result, array("messageResult" => $messageResult));

if ($lastListData != null) {
    $sheetWriter = new SheetWriter();
    $data = array(
        "type" => "present",
        "header_row" => "2",
        "year" => date("Y"),
        "색인" => $lastListData["index"],
        "단체명" => $lastListData["organization"],
        "담당자" => $lastListData["personInCharge"],
        "연락처" => $lastListData["hp"],
        "이메일" => $lastListData["email"],
        "문의내용" => $lastListData["question"],
        "문의 날짜" => $lastListData["createdAt"]
    );

    $sheetResult = $sheetWriter->WriteToSheet($data);

    array_push($result, array("sheetResult" => $sheetResult));
}

$conn->close();

$message = MakeMessage(TRUE, "insert success", array("message_result" => $result));
Response(200, $message);
?>