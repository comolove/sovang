<?php

require_once "xlsxwriter.class.php";

interface IXLSXWriter
{
    public function WriteXLSX($filePath, $list);
}

?>