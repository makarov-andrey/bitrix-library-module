<?php
namespace Makarov\Library;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\ReferenceField;

class BookAuthorTable extends DataManager
{
    public static function getTableName()
    {
        return 'books_authors';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('BOOK_ID', array(
                'primary' => true
            )),
            new ReferenceField(
                'BOOK',
                __NAMESPACE__ . '\Book',
                array('=this.BOOK_ID' => 'ref.ID')
            ),
            new IntegerField('AUTHOR_ID', array(
                'primary' => true
            )),
            new ReferenceField(
                'TAG',
                __NAMESPACE__ . '\Author',
                array('=this.AUTHOR_ID' => 'ref.ID')
            )
        );
    }
}