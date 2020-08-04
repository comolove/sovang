<?php
require_once "utils.php";
require_once "db.php";

class ImageUploader
{
    private $imageDir = "./images";
    private $allowed_ext = array('jpg','jpeg','png','gif');
    private $fail = FALSE;
    
    function __construct() 
    {
        $this->CheckImageDirExists();
    }

    public function UploadImages($name, $pcImage, $mobileImage = NULL)
    {
        $pcPath = "";
        $mobilePath = "";
        $lastInsertId = 0;

        $result = $this->UploadImage($pcImage);
        if ($this->IsFail())
        {
            return $result;
        }
        $pcPath = $result;
        // 맨 앞의 간접 주소 (`.`)을 자른다
        $pcPath = substr($pcPath, 1);

        if ($mobileImage !== NULL)
        {
            $result = $this->UploadImage($mobileImage);
            if ($this->IsFail())
            {
                return $result;
            }
            $mobilePath = $result;
            // 맨 앞의 간접 주소 (`.`)을 자른다
            $mobilePath = substr($mobilePath, 1);
        }
        
        $insertSQL = "INSERT INTO image (name, pc, mobile) VALUES('$name','$pcPath','$mobilePath')";

        $conn = CreateConnection();
        if ($conn->query($insertSQL) === TRUE)
        {
            $lastInsertId = $conn->insert_id;
        }
        else
        {
            $this->fail = TRUE;
            return "insert query failed";
        }
        $conn->close();

        return $lastInsertId;
    }

    public function IsFail()
    {
        return $this->fail;
    }

    private function UploadImage($file)
    {
        if (!$this->IsValidExt($file))
        {
            $this->fail = TRUE;
            return "올바르지 않은 확장자";
        }

        $uploadError = $this->IsError($file);

        if ($uploadError !== FALSE)
        {
            $this->fail = TRUE;
            return $uploadError;
        }

        $imgPath = $this->imageDir."/".md5(uniqid(rand(), true)).".".$this->GetExt($file["name"]);
        if(!move_uploaded_file($file["tmp_name"], $imgPath)) 
        {
            $this->fail = TRUE;
            return "이미지 업로드 실패";
        }

        return $imgPath;
    }
    
    private function CheckImageDirExists()
    {
        if (!is_dir($this->imageDir))
        {
            mkdir($this->imageDir);
        }
    }

    private function IsValidExt($file)
    {
        $ext = $this->GetExt($file["name"]);

        if( in_array($ext, $this->allowed_ext) ) 
        {
            return TRUE;
        }

        return FALSE;
    }

    private function IsError($file)
    {
        $error = $file["error"];
        if( $error != UPLOAD_ERR_OK ) 
        {
            switch( $error ) 
            {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    return "파일이 너무 큽니다. ($error)";
                case UPLOAD_ERR_NO_FILE:
                    return "파일이 첨부되지 않았습니다. ($error)";
                default:
                    return "파일이 제대로 업로드되지 않았습니다. ($error)";
            }
        }

        return FALSE;
    }

    private function GetExt($fileName)
    {
        $ext = explode('.', $fileName);
        $ext = array_pop($ext);
        
        return $ext;
    }
}   