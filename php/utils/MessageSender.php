<?php

require_once __DIR__ . '/..' . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..', '.php_env');
$dotenv->load();

class MessageSender
{
    private static $SMS_URL = "https://apis.aligo.in/send/";

    private $userId = "";
    private $key = "";
    private $sender = "";

    public function __construct()
    {
        $this->userId = $_ENV["MSG_USER_ID"];
        $this->key = $_ENV["MSG_KEY"];
        $this->sender = $_ENV["MSG_SENDER"];
    }

    public function SendMessage($message, $receiver, $testMode = "N")
    {
        $sms['user_id'] = $this->userId;
        $sms['key'] = $this->key;
        $sms['msg'] = stripslashes($message);
        $sms['receiver'] = $receiver;
        $sms['sender'] = $this->sender;
        $sms['testmode_yn'] = $testMode;
        $sms['msg_type'] = "SMS";

        $host_info = explode("/", self::$SMS_URL);
        $port = $host_info[0] == 'https:' ? 443 : 80;

        $oCurl = curl_init();
        curl_setopt($oCurl, CURLOPT_PORT, $port);
        curl_setopt($oCurl, CURLOPT_URL, self::$SMS_URL);
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $result = curl_exec($oCurl);

        curl_close($oCurl);

        return $result;
    }
}

?>