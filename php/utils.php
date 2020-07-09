<?php

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
?>