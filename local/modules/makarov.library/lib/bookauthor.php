<?php
namespace Makarov\Library;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\ReferenceField;

class BookAuthorTable extends DataManagerEx
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
                BookTable::getQueryEntityName(),
                array('=this.BOOK_ID' => 'ref.ID')
            ),
            new IntegerField('AUTHOR_ID', array(
                'primary' => true
            )),
            new ReferenceField(
                'AUTHOR',
                AuthorTable::getQueryEntityName(),
                array('=this.AUTHOR_ID' => 'ref.ID')
            )
        );
    }

    /**
     * удаляет текущих привязанных к книге авторов и сохраняет новые
     *
     * @param number $bookId
     * @param array $authors
     */
    public static function saveAuthorsForBook($bookId, $authors)
    {
        static::delete(array("BOOK_ID" => $bookId));
        foreach ($authors as $authorId) {
            static::add(array(
                "BOOK_ID" => $bookId,
                "AUTHOR_ID" => $authorId
            ));
        }
    }

    /**
     * удаляет текущие привязанных к автору книги и сохраняет новые
     *
     * @param number $authorId
     * @param array $books
     */
    public static function saveBooksForAuthor($authorId, $books)
    {
        static::delete(array("AUTHOR_ID" => $authorId));
        foreach ($books as $bookId) {
            static::add(array(
                "BOOK_ID" => $bookId,
                "AUTHOR_ID" => $authorId
            ));
        }
    }
}
