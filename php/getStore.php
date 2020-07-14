<?php
require_once "utils.php";
require_once "db.php";

$list = array();

$queryStoreSQL = "SELECT 
                S.index AS `index`, 
                S.store_name AS storeName, 
                S.link AS link, 
                I.pc AS homeImagePcPath, 
                I.mobile as homeImageMobilePath,
                S.img_list AS imgList
            FROM store AS S 
                INNER JOIN image AS I ON I.index=S.home_image";

$queryImgListTemplate = "SELECT pc AS pcPath, mobile AS mobilePath FROM image WHERE `index` IN ";

$conn = CreateConnection();
if ($result = $conn->query($queryStoreSQL))
{
    while($row = $result->fetch_assoc())
    {
        $newStore = array(
            "index" => $row["index"],
            "storeName" => $row["storeName"],
            "link" => $row["link"],
            "img" => array(
                "pcPath" => $row["homeImagePcPath"],
                "mobilePath" => $row["homeImageMobilePath"]
            ),
            "imgList" => array()
        );
        
        if (strlen($row["imgList"]) > 0)
        {
            $imgList = array();

            $queryImgListSQL = $queryImgListTemplate."(".$row["imgList"].")";
            if ($imgQueryResult = $conn->query($queryImgListSQL))
            {
                while($imgQueryRow = $imgQueryResult->fetch_assoc())
                {
                    array_push($imgList, array(
                        "pcPath" => $imgQueryRow["pcPath"],
                        "mobilePath" => $imgQueryRow["mobilePath"]
                    ));
                }

                $newStore["imgList"] = $imgList;
            }
        }
        
        array_push($list, $newStore);
    }
}
$conn->close();

$message = MakeMessage(TRUE, "read success", $list);
Response(200, $message);
?>