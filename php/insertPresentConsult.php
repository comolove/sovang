<?php
require_once "utils.php";
require_once "db.php";
require_once "utils/PresentProjectXLSXWriter.php";
require_once "utils/MailSender.php";
require_once "utils/MessageSender.php";

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

$mailSender = new MailSender();
$result = $mailSender->SendTo("yikolden@naver.com", "명절선물 컨설팅", "새로운 명절선물 컨설팅이 접수되었습니다.", array($filepath));

if ($result == FALSE) 
{
    $message = MakeMessage(FALSE, "failed", $result->GetError());
    Response(500, $message);
    $conn->close();
    exit();
}

$messageSender = new MessageSender();
$result = $messageSender->SendMessage("새로운 명절선물 컨설팅이 접수되었습니다.", "01034210329", /* Test Mode */"Y");

$conn->close();

$message = MakeMessage(TRUE, "insert success", array("message_result" => $result));
Response(200, $message);
?>