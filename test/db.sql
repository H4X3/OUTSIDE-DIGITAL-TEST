-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.24 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных og
CREATE DATABASE IF NOT EXISTS `og` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `og`;

-- Дамп структуры для таблица og.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы og.authors: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` (`id`, `fio`) VALUES
	(21, 'Марк Твен'),
	(22, 'Лев Толстой'),
	(23, 'Люк Бессон'),
	(24, 'Новый автор');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;

-- Дамп структуры для таблица og.authors_books
CREATE TABLE IF NOT EXISTS `authors_books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `isbn` int NOT NULL DEFAULT '0',
  `author_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `author_id` (`author_id`),
  KEY `isbn` (`isbn`) USING BTREE,
  CONSTRAINT `authors_books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  CONSTRAINT `authors_books_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `book` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы og.authors_books: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `authors_books` DISABLE KEYS */;
INSERT INTO `authors_books` (`id`, `isbn`, `author_id`) VALUES
	(27, 14, 21),
	(29, 16, 22),
	(30, 16, 23),
	(31, 17, 22),
	(39, 19, 21),
	(40, 19, 23),
	(41, 19, 24);
/*!40000 ALTER TABLE `authors_books` ENABLE KEYS */;

-- Дамп структуры для таблица og.book
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `year` datetime DEFAULT NULL,
  `count_pages` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `genre_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы og.book: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` (`id`, `name`, `year`, `count_pages`, `count`, `genre_id`) VALUES
	(14, 'Приключения Тома Сойера', '2021-11-02 00:00:00', '1200', '4', 4),
	(16, 'Моя книга', '2021-11-01 00:00:00', '900', '8', 7),
	(17, 'Война и Мир', '1962-01-01 00:00:00', '9000', '5', 4),
	(19, 'Моя вторая книга', '2021-11-01 00:00:00', '1500', '0', 3);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;

-- Дамп структуры для таблица og.genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы og.genre: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id`, `name`) VALUES
	(3, 'Повесть'),
	(4, 'Детектив '),
	(5, 'Фантастика '),
	(6, 'Роман '),
	(7, 'Приключения');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Дамп структуры для таблица og.reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `isbn_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_return` timestamp NOT NULL,
  `date_issue` timestamp NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `isbn_id` (`isbn_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`isbn_id`) REFERENCES `book` (`id`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы og.reservation: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` (`id`, `isbn_id`, `user_id`, `date_return`, `date_issue`) VALUES
	(17, 14, 7, '2021-11-19 00:00:00', '2021-11-16 00:00:00'),
	(19, 16, 7, '2021-11-26 00:00:00', '2021-11-01 00:00:00'),
	(20, 14, 6, '2021-11-24 00:00:00', '2021-11-01 00:00:00'),
	(23, 19, 6, '2021-11-24 00:00:00', '2021-11-01 00:00:00'),
	(24, 19, 7, '2022-04-15 00:00:00', '2021-06-09 00:00:00');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Дамп структуры для таблица og.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы og.user: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `fio`, `phone`, `address`) VALUES
	(6, 'Югов Максим Владимирович', '+7(999)123-45-67', 'Пермь'),
	(7, 'Иванов Иван Иванович', '+7(955)642-12-12', 'Москва');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
