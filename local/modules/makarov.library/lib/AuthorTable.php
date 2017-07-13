<?php
namespace Makarov\Library;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class AuthorTable extends DataManager
{
    public static function getTableName()
    {
        return 'authors';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ID'),
            )),
            new StringField('NAME', array(
                'required' => true,
                'title' => Loc::getMessage('NAME'),
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                },
            ))
        );
    }
}
