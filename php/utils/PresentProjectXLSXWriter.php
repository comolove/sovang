<?php

require_once "IXLSXWriter.php";

class PresentProjectXLSXWriter implements IXLSXWriter
{
    private static $FILE_PATH = "/tmp";
    private static $FILE_NAME = "Present.xlsx";

    public function Write($list)
    {
        $filePath = self::$FILE_PATH."/".self::$FILE_NAME;

        return $this->WriteXLSX($filePath, $list);
    }

    public function LoadDataFromDB($conn)
    {
        $list = array();

        $selectSQL = "SELECT * FROM `present_consult`";
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
                    "question" => $row["question"],
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
        $writer->writeSheetHeader('명절선물 컨설팅', 
            array(
                '색인' => 'integer',
                '단체명'=>'string',
                '담당자'=>'string',
                '연락처'=>'string',
                '이메일'=>'string',
                '문의내용'=>'string',
                '문의 날짜'=>'string',
            ) 
        );
        
        for($i = 0; $i < count($list); $i++)
        {
            $writer->writeSheetRow('명절선물 컨설팅', $list[$i] );
        }

        $writer->writeToFile($filePath);

        return $filePath;
    }
}

?>