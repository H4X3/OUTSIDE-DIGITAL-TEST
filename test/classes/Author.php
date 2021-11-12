<?php

use Connect as Connect;

/**
 * Класс Db
 * Компонент для работы с базой данных
 */
class Author
{

    private static $connection;

    public function __construct()
    {
        $conn = new Connect();
        self::$connection = $conn->getConnection();
    }

    public static function get()
    {
        $sql = 'SELECT * FROM authors';
        $res = self::$connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function getAuthor($id)
    {
        $sql = "SELECT * FROM authors WHERE id={$id}";
        $res = self::$connection->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function setAuthor($data)
    {
        $sql = "INSERT INTO authors (fio) VALUES ('{$data["fio"]}')";
        self::$connection->prepare($sql)->execute();
    }

    public static function editAuthor($data)
    {
        $sql = "UPDATE authors SET fio=? WHERE id=?";
        self::$connection->prepare($sql)->execute([$data['fio'], $data['id']]);
    }

    public static function deleteAuthor($id)
    {
        $sql = "DELETE FROM authors WHERE id={$id}";
        self::$connection->prepare($sql)->execute();
    }

    public static function setAuthorsBooks($id, $arAuthors)
    {
        foreach ($arAuthors as $item) {
            $arSql[] = "('{$id}', '{$item}')";
        }

        $sql = "INSERT INTO authors_books (isbn, author_id) VALUES" . implode($arSql, ', ');
        self::$connection->prepare($sql)->execute();
    }

    public static function deleteAuthorsBooks($id)
    {
        $sql = "DELETE FROM authors_books WHERE isbn={$id}";
        self::$connection->prepare($sql)->execute();
    }
}
