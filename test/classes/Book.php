<?php

use Connect as Connect;

/**
 * Класс Db
 * Компонент для работы с базой данных
 */
class Book
{

    private static $connection;

    public function __construct()
    {
        $conn = new Connect();
        self::$connection = $conn->getConnection();
    }

    public static function getAllBooks()
    {
        $sql = 'SELECT *, ge.name AS genre_name, b.name AS book_name
                FROM book b
                LEFT JOIN authors_books ab ON (b.id = ab.isbn)
                LEFT JOIN authors a ON (ab.author_id = a.id)
                LEFT JOIN genre ge ON (b.genre_id = ge.id)';

        $allBooks = self::$connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        if ($allBooks) {
            $key = 1;
            foreach ($allBooks as $i => $item) {
                if ($key == $item['isbn']) {
                    $authors[] = $item['fio'];
                } else {
                    unset($authors);
                    $key = $item['isbn'];
                    $authors[] = $item['fio'];
                }
                $item['fullName'] = implode($authors, ', ');
                $newAllBooks[$item['isbn']] = $item;
            }
            return $newAllBooks;
        }
        return [];
    }

    public static function setBook($data)
    {
        $sql = "INSERT INTO book (name, year, count_pages, count, genre_id) VALUES ('{$data["name"]}', '{$data["date"]}', '{$data["count_pages"]}', '{$data["count"]}', '{$data["genre_id"]}')";
        self::$connection->prepare($sql)->execute();
        $id = self::$connection->lastInsertId();

        $AUTHOR = new Author();
        $AUTHOR->setAuthorsBooks($id, $data['author_id']);
    }

    public static function deleteBook($id)
    {
        $AUTHOR = new Author();
        $AUTHOR->deleteAuthorsBooks($id);
        $USER = new User();
        $USER->deleteReservationBookId($id);
        $sql = "DELETE FROM book WHERE id={$id}";
        self::$connection->prepare($sql)->execute();
    }

    public static function getBook($id)
    {
        $sql = "SELECT *
        FROM book b
        LEFT JOIN authors_books ab ON (b.id = ab.isbn)
        LEFT JOIN authors a ON (ab.author_id = a.id)
        WHERE b.id={$id}";

        $allBooks = self::$connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if ($allBooks) {
            $key = 1;
            foreach ($allBooks as $i => $item) {
                if ($key == $item['isbn']) {
                    $authors[$item['author_id']] = $item['fio'];
                } else {
                    $key = $item['isbn'];
                    $authors[$item['author_id']] = $item['fio'];
                }
                $item['authors'] = $authors;
                $newAllBooks = $item;
            }
            $phpdate = strtotime($newAllBooks['year']);
            $newAllBooks['year'] = date('Y-m-d', $phpdate);
            return $newAllBooks;
        }
        return [];
    }

    public static function editBook($data)
    {
        $AUTHOR = new Author();
        $AUTHOR->deleteAuthorsBooks($data['id']);
        $AUTHOR->setAuthorsBooks($data['id'], $data['author_id']);

        $sql = "UPDATE book SET name=?, year=?, count_pages=? , count=?, genre_id=? WHERE id=?";
        self::$connection->prepare($sql)->execute([$data['name'], $data['date'], $data['count_pages'], $data['count'], $data['genre_id'],  $data['id']]);
    }

    public static function updateBookCount($count, $id)
    {
        $bookCount = self::getBook($id)['count'];
   
        if ($count == 'minus') {
            $newBookCount = $bookCount - 1;
        } else {
            $newBookCount = $bookCount + 1;
        }

        if ($newBookCount < 0) {
            return ['status' => 'error', 'message' => 'Не осталось книг в библиотеке!'];
        } else {
            $sql = "UPDATE book SET count=? WHERE id=?";
            self::$connection->prepare($sql)->execute([$newBookCount, $id]);
            return ['status' => 'success'];
        }
    }

    public static function getAllGenres()
    {
        $sql = 'SELECT * FROM genre';
        $res = self::$connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function setGenre($data)
    {
        $sql = "INSERT INTO genre (name) VALUES ('{$data["name"]}')";
        self::$connection->prepare($sql)->execute();
    }

    public static function deleteGenre($id)
    {
        $sql = "DELETE FROM genre WHERE id={$id}";
        self::$connection->prepare($sql)->execute();
    }

    public static function getGenre($id)
    {
        $sql = "SELECT * FROM genre WHERE id={$id}";
        $res = self::$connection->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function editGenre($data)
    {
        $sql = "UPDATE genre SET name=? WHERE id=?";
        self::$connection->prepare($sql)->execute([$data['name'], $data['id']]);
    }
}
