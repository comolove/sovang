<?php
require_once "utils.php";
require_once "db.php";

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
`qustion`)
VALUES
('$organization',
'$personInCharge',
'$hp',
'$email',
'$question')
";

$conn = CreateConnection();

if ($conn->query($insertSQL) !== TRUE)
{
    $message = MakeMessage(FALSE, "삽입 실패");
    Response(500, $message);
    exit();
}

$conn->close();

$message = MakeMessage(TRUE, "insert success");
Response(200, $message);
?>