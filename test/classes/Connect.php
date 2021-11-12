<?php


/**
 * Класс Connect
 * Компонент для работы с базой данных
 */


class Connect
{

    private static $connection;

    public static function getConnection()
    {
        if (!empty(self::$connection)) {
            return self::$connection;
        }
        try {
            $paramsPath = ROOT . '/config/db_params.php';
            $params = include($paramsPath);

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new PDO($dsn, $params['user'], $params['password']);

            // Задаем кодировку
            $db->exec("SET NAMES utf8");

            self::$connection = $db;

            return $db;
        } catch (PDOException $e) {
            print "Error! : " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
