<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Установка базы данных</title>
</head>

<body>
<form id="form1" name="form1" method="post" style="margin-left: 30%; margin-top: 1%;"> <font size="5">
  <p>
    <label for="textfield">Server name:<br>
    </label>
    <input name="server_name" type="text" id="server_name" value="localhost">
  </p>
  <p>
    <label for="textfield2">User name:<br>
    </label>
    <input name="user_name" type="text" id="user_name" value="test">
  </p>
  <p>
    <label for="textfield3">Password:<br>
    </label>
    <input name="password" type="text" id="password" value="123">
  </p>
  <p>
    <label for="textfield4">Database:<br>
    </label>
    <input name="database" type="text" id="database" value="test">
  </p>
  <p>
    <input type="submit" name="submit" id="submit" value="Install">
  </p>
</form>
</body>
</html>

<?php
    error_reporting(E_ALL);
//    header("Content-Type: text/html; charset=utf-8");
    
    if (isset($_POST['submit']) && $_POST['submit'] == 'Install'){
        
        $dump = "-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `form` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `form`;

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private` tinyint(1) unsigned NOT NULL,
  `seller_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `allow_mail` tinyint(1) unsigned NOT NULL,
  `phone` int(11) unsigned NOT NULL,
  `city_id` int(4) unsigned NOT NULL,
  `category_id` int(4) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ads` (`id`, `private`, `seller_name`, `email`, `allow_mail`, `phone`, `city_id`, `category_id`, `title`, `description`, `price`) VALUES
(26,	0,	'Петр',	'aron@ya.ru',	1,	894651321,	7,	205,	'Куплю гараж',	'Желательно с автомобилем.',	1000000);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `category`, `parent_id`) VALUES
(0,	'-- Выберите категорию --',	NULL),
(101,	'Автомобили с пробегом',	100),
(102,	'Новые автомобили',	100),
(103,	'Мотоциклы и мототехника',	100),
(104,	'Грузовики и спецтехника',	100),
(105,	'Водный транспорт',	100),
(106,	'Запчасти и аксессуары',	100),
(201,	'Квартиры',	200),
(202,	'Комнаты',	200),
(203,	'Дома, дачи, коттеджи',	200),
(204,	'Земельные участки',	200),
(205,	'Гаражи и машиноместа',	200),
(206,	'Коммерческая недвижимость',	200),
(207,	'Недвижимость за рубежом',	200),
(301,	'Вакансии',	300),
(302,	'Резюме',	300),
(401,	'Предложения услуг',	400),
(402,	'Запросы на услуги',	400),
(501,	'Одежда, обувь, аксессуары',	500),
(502,	'Детская одежда и обувь',	500),
(503,	'Товары для детей и игрушки',	500),
(504,	'Часы и украшения',	500),
(505,	'Красота и здоровье',	500),
(601,	'Бытовая техника',	600),
(602,	'Мебель и интерьер',	600),
(603,	'Посуда и товары для кухни',	600),
(604,	'Продукты питания',	600),
(605,	'Ремонт и строительство',	600),
(606,	'Растения',	600),
(701,	'Аудио и видео',	700),
(702,	'Игры, приставки и программы',	700),
(703,	'Настольные компьютеры',	700),
(704,	'Ноутбуки',	700),
(705,	'Оргтехника и расходники',	700),
(706,	'Планшеты и электронные книги',	700),
(707,	'Телефоны',	700),
(708,	'Товары для компьютера',	700),
(709,	'Фототехника',	700),
(801,	'Билеты и путешествия',	800),
(802,	'Велосипеды',	800),
(803,	'Книги и журналы',	800),
(804,	'Коллекционирование',	800),
(805,	'Музыкальные инструменты',	800),
(806,	'Охота и рыбалка',	800),
(807,	'Спорт и отдых',	800),
(808,	'Знакомства',	800),
(901,	'Собаки',	900),
(902,	'Кошки',	900),
(903,	'Птицы',	900),
(904,	'Аквариум',	900),
(905,	'Другие животные',	900),
(906,	'Товары для животных',	900),
(1001,	'Готовый бизнес',	1000),
(1002,	'Оборудование для бизнеса',	1000),
(100,	'Транспорт',	NULL),
(200,	'Недвижимость',	NULL),
(300,	'Работа',	NULL),
(400,	'Услуги',	NULL),
(500,	'Личные вещи',	NULL),
(600,	'Для дома и дачи',	NULL),
(700,	'Бытовая электроника	',	NULL),
(800,	'Хобби и отдых	',	NULL),
(900,	'Животные	',	NULL),
(1000,	'Для бизнеса',	NULL);

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cities` (`id`, `city`) VALUES
(1,	'Новосибирск'),
(2,	'Барабинск'),
(3,	'Бердск'),
(4,	'Искитим'),
(5,	'Колывань'),
(6,	'Краснообск'),
(7,	'Куйбышев'),
(8,	'Мошково'),
(9,	'Обь'),
(10,	'Ордынское'),
(11,	'Черепаново');

-- 2016-01-30 05:34:11
";
        $mysqli = new mysqli("{$_POST['server_name']}", "{$_POST['user_name']}", "{$_POST['password']}");
        if ($mysqli->connect_errno){ 
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error); 
        }
        
        if (mysqli_select_db($mysqli, $_POST['database'])){
            if($mysqli->multi_query("DROP DATABASE `{$_POST['database']}`")){
                echo 'База данных '.$_POST['database'].' удалена<br>';
            }
        }
        else{
            echo 'База данных '.$_POST['database'].' недоступна.<br>';
        }
        
        if($mysqli->multi_query($dump)){
            echo 'База данных '.$_POST['database'].' успешно добавлена <br> <a href="index.php">Перейти на сайт</a><br>';
        }
        else{
            echo 'Ошибка при добавлении базы данных '.$_POST['database'];
        }
        
    }
?>