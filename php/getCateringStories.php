<?php
require_once "utils.php";
require_once "db.php";

$list = array();

$selectSQL = "SELECT 
                CS.index AS `index`, 
                CS.title AS title, 
                CS.desc AS `desc`, 
                I1.pc AS frontPcPath, 
                I1.mobile as frontMobilePath,
                I2.pc AS backPcPath, 
                I2.mobile as backMobilePath 
            FROM catering_story AS CS
            INNER JOIN image AS I1 ON I1.index=CS.front_img
            INNER JOIN image AS I2 ON I2.index=CS.back_img";

$conn = CreateConnection();
if ($result = $conn->query($selectSQL))
{
    while($row = $result->fetch_assoc())
    {
        array_push($list, array(
                                "index" => $row["index"], 
                                "title" => $row["title"],
                                "desc" => $row["desc"], 
                                "frontImg" => array(
                                    "name" => $row["title"], 
                                    "pcPath" => $row["frontPcPath"], 
                                    "mobilePath" => $row["frontMobilePath"]),
                                "backImg" => array(
                                    "name" => $row["title"], 
                                    "pcPath" => $row["backPcPath"], 
                                    "mobilePath" => $row["backMobilePath"])    
                                ));
    }
}
$conn->close();

$message = MakeMessage(TRUE, "read success", $list);
Response(200, $message);
?>