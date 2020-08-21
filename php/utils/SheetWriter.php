<?php

require_once __DIR__ . '/..' . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..', '.php_env');
$dotenv->load();

class SheetWriter
{
    public function __construct()
    {
        $this->url = $_ENV["SHEET_URL"];
    }

    public function WriteToSheet($data)
    {
        $oCurl = curl_init();

        $host_info = explode("/", $this->url);
        $port = $host_info[0] == 'https:' ? 443 : 80;

        $urlWithQuery = $this->url."?".http_build_query($data);

        curl_setopt($oCurl, CURLOPT_PORT, $port);
        curl_setopt($oCurl, CURLOPT_URL, $urlWithQuery);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $result = curl_exec($oCurl);

        curl_close($oCurl);

        return $result;
    }
}

?>