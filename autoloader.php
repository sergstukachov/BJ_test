<?php

spl_autoload_register('autoloader');

function autoloader($className)
{
    try {
        include($_SERVER["DOCUMENT_ROOT"] . "/" .
            str_replace("\\", "/", $className) . ".php");
    } catch (\Exception $exception) {
        var_dump($exception);
    }


}