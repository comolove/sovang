<?php
    include "utils.php";

    $id = $_POST["id"];
    $pw = $_POST["password"];

    $encryptHelper = new EncryptHelper();
    $encryptPw = $encryptHelper->Encrypt($pw);
    $decrypePw = $encryptHelper->Decrypt($encryptPw);

    echo "ID : ".$id;
    echo "<br/>";
    echo "Origin PW : ".$pw;
    echo "<br/>";
    echo "Hashed PW : ".$encryptPw;
    echo "<br/>";
    echo "Decrypte PW : ".$decrypePw;
?>