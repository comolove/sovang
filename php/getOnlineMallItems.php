<?php
require_once "utils.php";
require_once "db.php";

$list = array();

$selectSQL = "SELECT O.index AS `index`, O.item_name AS itemName, O.item_desc AS itemDesc, O.link AS `link`, I.pc AS pcPath, I.mobile as mobilePath, I.`index` as imgIndex FROM online_mall AS O INNER JOIN image AS I ON I.index=O.imageIndex;";

$conn = CreateConnection();
if ($result = $conn->query($selectSQL))
{
    while($row = $result->fetch_assoc())
    {
        array_push($list, array(
                                "index" => $row["index"], 
                                "itemName" => $row["itemName"],
                                "itemDesc" => $row["itemDesc"], 
                                "link" => $row["link"],
                                "img" => array(
                                    "index" => $row["imgIndex"],
                                    "name" => $row["itemName"], 
                                    "pcPath" => $row["pcPath"], 
                                    "mobilePath" => $row["mobilePath"])
                                ));
    }
}
$conn->close();

$message = MakeMessage(TRUE, "read success", $list);
Response(200, $message);
?>