<?php
require_once "utils.php";
require_once "db.php";

$list = array();

$selectSQL = "SELECT 
                PP.index AS `index`, 
                PP.title AS title, 
                PP.desc AS `desc`, 
                PP.link AS link,
                I1.`index` AS frontImgIndex,
                I1.pc AS frontPcPath, 
                I1.mobile as frontMobilePath,
                I2.`index` AS backImgPath,
                I2.pc AS backPcPath, 
                I2.mobile as backMobilePath 
            FROM present_project AS PP
            INNER JOIN image AS I1 ON I1.index=PP.front_img
            INNER JOIN image AS I2 ON I2.index=PP.back_img";

$conn = CreateConnection();
if ($result = $conn->query($selectSQL))
{
    while($row = $result->fetch_assoc())
    {
        array_push($list, array(
                                "index" => $row["index"], 
                                "title" => $row["title"],
                                "desc" => $row["desc"], 
                                "link" => $row["link"],
                                "frontImg" => array(
                                    "name" => $row["title"], 
                                    "index" => $row["frontImgIndex"],
                                    "pcPath" => $row["frontPcPath"], 
                                    "mobilePath" => $row["frontMobilePath"]),
                                "backImg" => array(
                                    "name" => $row["title"], 
                                    "index" => $row["backImgPath"],
                                    "pcPath" => $row["backPcPath"], 
                                    "mobilePath" => $row["backMobilePath"])    
                                ));
    }
}
$conn->close();

$message = MakeMessage(TRUE, "read success", $list);
Response(200, $message);
?>