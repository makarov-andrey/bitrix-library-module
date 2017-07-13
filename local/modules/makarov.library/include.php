<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses('makarov.library', array(
    // no thanks, bitrix, we better will use psr-4 than your class names convention
    'Makarov\Library' => 'lib/',
));