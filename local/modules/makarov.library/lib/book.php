<?php

namespace Makarov\Library;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class BookTable extends DataManagerEx
{
    public static function getTableName()
    {
        return 'books';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ID'),
            )),
            new StringField('TITLE', array(
                'required' => true,
                'title' => Loc::getMessage('TITLE'),
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                },
            ))
        );
    }

    /**
     * Возвращает массив книг с вложенным массивом авторов.
     *
     * @param array $params
     * @return array
     */
    public static function getWithAuthors($params = array())
    {
        if (!is_array($params["select"])) {
            $params["select"] = array("*");
        }
        $params["select"]["AUTHOR_"] = BookAuthorTable::getQueryEntityName() . ":BOOK.AUTHOR.*";
        $result = BookTable::getList($params);
        $books = array();
        while ($row = $result->fetch()) {
            if (!$books[$row["ID"]]) {
                $books[$row["ID"]] = array(
                    "ID" => $row["ID"],
                    "TITLE" => $row["TITLE"],
                    "AUTHORS" => array()
                );
            }
            $books[$row["ID"]]["AUTHORS"][] = array(
                "ID" => $row["AUTHOR_ID"],
                "NAME" => $row["AUTHOR_NAME"],
            );
        }
        return $books;
    }

    /**
     * Возвращает книгу с вложенным массивом авторов.
     * Если книги с атким id не существует, возвращает null.
     *
     * @param $id
     * @param array $params
     * @return array|null
     */
    public static function getByIdWithAuthors($id, $params = array())
    {
        if (!is_array($params["filter"])) {
            $params["filter"] = array();
        }
        $params["filter"]["ID"] = $id;
        $result = static::getWithAuthors($params);
        return !empty($result) ? reset($result) : null;
    }
}
