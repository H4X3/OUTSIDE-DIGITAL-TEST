<?php

use Connect as Connect;

/**
 * Класс Db
 * Компонент для работы с базой данных
 */
class User
{

    private static $connection;

    public function __construct()
    {
        $conn = new Connect();
        self::$connection = $conn->getConnection();
    }

    public static function get()
    {
        $sql = 'SELECT * FROM user';
        $res = self::$connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function getUser($id)
    {
        $sql = "SELECT * FROM user WHERE id={$id}";
        $res = self::$connection->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function setUser($data)
    {
        $sql = "INSERT INTO user (fio, phone, address) VALUES ('{$data["fio"]}', '{$data["phone"]}', '{$data["address"]}')";
        self::$connection->prepare($sql)->execute();
    }

    public static function editUser($data)
    {
        $sql = "UPDATE user SET fio=?, phone=?, address=? WHERE id=?";
        self::$connection->prepare($sql)->execute([$data['fio'], $data['phone'], $data['address'], $data['id']]);
    }

    public static function deleteUser($id)
    {
        self::deleteReservationUserId($id);
        $sql = "DELETE FROM user WHERE id={$id}";
        self::$connection->prepare($sql)->execute();
    }

    public static function getAllReservation()
    {
        $sql = 'SELECT *, u.id as id_user, re.id AS reserv_id
            FROM user u
            LEFT JOIN reservation re ON (u.id = re.user_id)
            LEFT JOIN book b ON (re.isbn_id = b.id)
            WHERE u.id = re.user_id
            ORDER BY id_user ASC';

        $allUsers = self::$connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if ($allUsers) {
            $key = 1;
            foreach ($allUsers as $i => $item) {
                if ($key == $item['id_user']) {
                    $book[$item['reserv_id']] = ['name' => $item['name'], 'date_issue' => $item['date_issue'], 'date_return' => $item['date_return']];
                } else {
                    $key = $item['id_user'];
                    unset($book);
                    $book[$item['reserv_id']] = ['name' => $item['name'], 'date_issue' => $item['date_issue'], 'date_return' => $item['date_return']];
                }
                $item['books'] = $book;

                $newAllUsers[$item['id_user']] = $item;
            }
            return $newAllUsers;
        }
        return [];
    }

    public static function getReservation($id)
    {
        $sql = "SELECT *, re.id AS res_id
            FROM reservation re
            LEFT JOIN user u ON (re.user_id = u.id)
            LEFT JOIN book b ON (re.isbn_id = b.id)
            WHERE re.id = {$id}";

        $return = self::$connection->query($sql)->fetch(PDO::FETCH_ASSOC);
        $phpdateIssue = strtotime($return['date_issue']);
        $phpdateReturn = strtotime($return['date_return']);
        $return['date_issue'] = date('Y-m-d', $phpdateIssue);
        $return['date_return'] = date('Y-m-d', $phpdateReturn);
        return $return;
    }

    public static function setReservation($data)
    {
        $BOOK = new Book();
        $res = $BOOK->updateBookCount('minus', $data['isbn_id']);
        if ($res['status'] == 'success') {
            $sql = "INSERT INTO reservation (isbn_id, user_id, date_return, date_issue) VALUES ('{$data["isbn_id"]}', '{$data["user_id"]}', '{$data["date_return"]}' , '{$data["date_issue"]}')";
            self::$connection->prepare($sql)->execute();
        }
        return $res;
    }

    public static function deleteReservation($id)
    {
        $idBook = self::getReservation($id)['isbn_id'];
        $BOOK = new Book();
        $BOOK->updateBookCount('plus', $idBook);
        $sql = "DELETE FROM reservation WHERE id={$id}";
        self::$connection->prepare($sql)->execute();
    }
    
    public static function deleteReservationBookId($id)
    {
        $sql = "DELETE FROM reservation WHERE isbn_id={$id}";
        self::$connection->prepare($sql)->execute();
    }

    public static function deleteReservationUserId($id)
    {
        $sql = "DELETE FROM reservation WHERE user_id={$id}";
        self::$connection->prepare($sql)->execute();
    }

    public static function editReservation($data)
    {
        $sql = "UPDATE reservation SET isbn_id=?, user_id=?, date_return=? , date_issue=? WHERE id=?";
        self::$connection->prepare($sql)->execute([$data['isbn_id'], $data['user_id'], $data['date_return'], $data['date_issue'],  $data['id']]);
    }
}
