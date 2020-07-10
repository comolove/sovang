<?php
function Response($statusCode, $data)
{
    header('Access-Control-Allow-Origin: *'); 
    header('Content-type: application/json');
    http_response_code($statusCode);
    echo $data;
}

function MakeMessage($success, $message, $data = array())
{
    $message = array("success" => $success, "msg" => $message, "data" => $data);

    return json_encode($message);
}

class EncryptHelper 
{
    private $secretKey = "sovang_secreet";
    private $secretIv = "sovang#^*(sovang";

    public function Encrypt($str)
    {
        $key = hash('sha256', $this->secretKey);
        $iv = substr(hash('sha256', $this->secretIv), 0, 16);

        return str_replace("=", "", base64_encode(openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv)));
    }

    public function Decrypt($str)
    {
        $key = hash('sha256', $this->secretKey);
        $iv = substr(hash('sha256', $this->secretIv), 0, 16);

        return openssl_decrypt(base64_decode($str), "AES-256-CBC", $key, 0, $iv);
    }
}

function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}

?>