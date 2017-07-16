<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

require_once __DIR__ . "/define.php";

$nameSpacePrefix = 'Makarov\Library';
$baseDirectory = __DIR__ . '/classes';

spl_autoload_register(function($className) use ($nameSpacePrefix, $baseDirectory) {
    $nameSpacePrefix = preg_replace("/^\\\\+/", "", $nameSpacePrefix);
    $nameSpacePrefix = str_replace("\\", "\\\\", $nameSpacePrefix);

    if (!preg_match("/^$nameSpacePrefix/", $className)) {
        return;
    }

    $className = preg_replace("/^$nameSpacePrefix/", "", $className);
    $className = str_replace("\\", "/", $className);

    $filename = $baseDirectory . "/" . $className . ".php";
    if (file_exists($filename)) {
        include $filename;
    }
});