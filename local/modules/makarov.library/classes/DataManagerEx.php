<?php

namespace Makarov\Library;


use Bitrix\Main\Entity\DataManager;

abstract class DataManagerEx extends DataManager
{
    public static function getQueryEntityName ()
    {
        return preg_replace("/Table$/", "", static::class);
    }
}