<?php
namespace Makarov\Library;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class AuthorTable extends DataManagerEx
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

    /**
     * Возвращает массив книг с вложенным массивом авторов.
     *
     * @param array $params
     * @return array
     */
    public static function getWithBooks($params = array())
    {
        if (!is_array($params["select"])) {
            $params["select"] = array("*");
        }
        $params["select"]["BOOK_"] = BookAuthorTable::getQueryEntityName() . ":AUTHOR.BOOK.*";
        $result = static::getList($params);
        $authors = array();
        while ($row = $result->fetch()) {
            if (!$authors[$row["ID"]]) {
                $authors[$row["ID"]] = array(
                    "ID" => $row["ID"],
                    "NAME" => $row["NAME"],
                    "BOOKS" => array()
                );
            }
            $authors[$row["ID"]]["BOOKS"][] = array(
                "ID" => $row["BOOK_ID"],
                "TITLE" => $row["BOOK_TITLE"],
            );
        }
        return $authors;
    }

    /**
     * Возвращает книгу с вложенным массивом авторов.
     * Если книги с атким id не существует, возвращает null.
     *
     * @param $id
     * @param array $params
     * @return array|null
     */
    public static function getByIdWithBooks($id, $params = array())
    {
        if (!is_array($params["filter"])) {
            $params["filter"] = array();
        }
        $params["filter"]["ID"] = $id;
        $result = static::getWithBooks($params);
        return !empty($result) ? reset($result) : null;
    }
}
