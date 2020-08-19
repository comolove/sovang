<?php

require_once "IXLSXWriter.php";

class CateringOrderXLSXWriter implements IXLSXWriter
{
    private static $FILE_PATH = "/tmp";
    private static $FILE_NAME = "Catering.xlsx";

    public function Write($list)
    {
        $filePath = self::$FILE_PATH."/".self::$FILE_NAME;

        return $this->WriteXLSX($filePath, $list);
    }

    public function LoadDataFromDB($conn)
    {
        $list = array();

        $selectSQL = "SELECT * FROM `catering_order`";
        if ($result = $conn->query($selectSQL))
        {
            while($row = $result->fetch_assoc())
            {
                array_push($list, array(
                    "index" => $row["index"], 
                    "organization" => $row["organization"],
                    "personInCharge" => $row["person_in_charge"], 
                    "hp" => $row["hp"],
                    "email" => $row["email"],
                    "date" => $row["date"],
                    "headcount" => $row["headcount"],
                    "payType" => $row["pay_type"],
                    "address" => $row["address"],
                    "category" => $row["category"],
                    "menuItem" => $row["menu_item"],
                    "menuSet" => $row["menu_set"],
                    "extraMenu" => $row["extra_menu"],
                    "extraMessage" => $row["extra_message"],
                    "createdAt" => $row["created_at"]
                ));
            }
        }

        return $list;
    }

    public function WriteXLSX($filePath, $list)
    {
        if (file_exists($filePath)) 
        {
            unlink($filePath);
        }

        $writer = new XLSXWriter();
        $writer->writeSheetHeader('케이터링 주문', 
            array(
                '색인' => 'integer',
                '단체명'=>'string',
                '담당자'=>'string',
                '연락처'=>'string',
                '이메일'=>'string',
                '날짜/시간'=>'string',
                '인원'=>'string',
                '결제방법'=>'string',
                '주소'=>'string',
                '카테고리'=>'string',
                '메뉴구성'=>'string',
                '메뉴항목'=>'string',
                '추가메뉴'=>'string',
                '추가메시지'=>'string',
                '문의 날짜'=>'string',
            ) 
        );
        
        for($i = 0; $i < count($list); $i++)
        {
            $writer->writeSheetRow('케이터링 주문', $list[$i] );
        }

        $writer->writeToFile($filePath);

        return $filePath;
    }
}

?>