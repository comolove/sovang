<?php
require_once "utils.php";
require_once "db.php";

$list = array();

$selectSQL = "SELECT 
                CS.index AS `index`, 
                CS.title AS title, 
                CS.desc AS `desc`,
                CS.popup_title AS popupTitle,
                CS.body AS body,
                I1.`index` AS frontImgIndex,
                I1.pc AS frontPcPath, 
                I1.mobile as frontMobilePath,
                I2.`index` AS backImgPath,
                I2.pc AS backPcPath, 
                I2.mobile as backMobilePath 
            FROM present_item AS CS
            INNER JOIN image AS I1 ON I1.index=CS.thumb_img
            INNER JOIN image AS I2 ON I2.index=CS.body_img";

$conn = CreateConnection();
if ($result = $conn->query($selectSQL))
{
    while($row = $result->fetch_assoc())
    {
        array_push($list, array(
                                "index" => $row["index"], 
                                "title" => $row["title"],
                                "desc" => $row["desc"],
                                "popupTitle" => $row["popupTitle"],
                                "body" => $row["body"],
                                "thumbImg" => array(
                                    "name" => $row["title"], 
                                    "index" => $row["frontImgIndex"],
                                    "pcPath" => $row["frontPcPath"], 
                                    "mobilePath" => $row["frontMobilePath"]),
                                "bodyImg" => array(
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