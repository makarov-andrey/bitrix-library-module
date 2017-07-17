<?php

namespace Makarov\Library;

class AdminURL
{
    const BOOKS_LIST = ADMIN_URL . '/library_books.php';
    const BOOK_ADD = ADMIN_URL . '/library_book_edit.php';
    const BOOK_DELETE = ADMIN_URL . '/library_book_delete.php';
    const AUTHORS_LIST = ADMIN_URL . '/library_authors.php';
    const AUTHOR_ADD = ADMIN_URL . '/library_author_edit.php';
    const AUTHOR_DELETE = ADMIN_URL . '/library_author_delete.php';

    public static function bookEdit ($bookID)
    {
        return static::BOOK_ADD . '?id=' . $bookID;
    }

    public static function authorEdit ($authorID)
    {
        return static::AUTHOR_ADD . '?id=' . $authorID;
    }
}