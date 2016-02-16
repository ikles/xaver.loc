<form action="" method="post">
    Server name:<br>
    <input type="text" name="server_name"><br><br>
    User name:<br>
    <input type="text" name="user_name"><br><br>
    Password:<br>
    <input type="text" name="password"><br><br>
    Database:<br>
    <input type="text" name="database">
    <p><input type="submit" name="button" value="Install"></p>
</form>
<?php
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 0);

function check_form() {
if (isset($_POST['button'])) {
    if (!empty($_POST['server_name']) &&
            !empty($_POST['user_name']) &&
            !empty($_POST['password']) &&
            !empty($_POST['database'])) {
        global $server_name;
        $server_name = $_POST['server_name'];
        global $user_name;
        $user_name = $_POST['user_name'];
        global $password;
        $password = $_POST['password'];
        global $database;
        $database = $_POST['database'];    
        return true;
            } else {
        echo "Заполните все поля";
    }
}
}

if (check_form()) {
        $db = mysqli_connect($server_name, $user_name, $password, $database) or die(mysql_error());        
        mysqli_query($db,"SET NAMES utf8");
        mysqli_query($db,"SET time_zone = '+00:00'");
        mysqli_query($db,"SET foreign_key_checks = 0");
        mysqli_query($db,"SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");
        mysqli_query($db,"DROP TABLE IF EXISTS `ads`");
        mysqli_query($db,"CREATE TABLE `ads` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `private` varchar(1) NOT NULL,
                    `seller_name` varchar(10) NOT NULL,
                    `email` varchar(15) NOT NULL,
                    `allow_mails` varchar(1) NOT NULL,
                    `phone` varchar(12) NOT NULL,
                    `location_id` varchar(10) NOT NULL,
                    `category_id` varchar(3) NOT NULL,
                    `title` varchar(30) NOT NULL,
                    `description` varchar(255) NOT NULL,
                    `price` varchar(10) NOT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        
        mysqli_query($db,"INSERT INTO `ads` (`id`, `private`, `seller_name`, `email`, `allow_mails`, `phone`, `location_id`, `category_id`, `title`, `description`, `price`) VALUES
                    (1,'1','Иван','34@ya.ru','1','79998887766','641490','23','Квартира 34 комнаты','Квартира 4 комнаты в центре','3500000'),
                    (8,'1','Альберт','ikles.ru@ya.ru','0','35','641490','24','Собака','Собака 222','35')");
        mysqli_query($db,"DROP TABLE IF EXISTS `categories`");
        mysqli_query($db,"CREATE TABLE `categories` (
                    `category_id` varchar(3) NOT NULL,
                    `category` varchar(10) NOT NULL
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
         mysqli_query($db,"INSERT INTO `categories` (`category_id`, `category`) VALUES
                    ('24','Квартиры'),
                    ('23','Комнаты'),
                    ('25','Дома, дачи')");
         mysqli_query($db,"DROP TABLE IF EXISTS `citys`");
         mysqli_query($db,"CREATE TABLE `citys` (
                    `location_id` varchar(10) NOT NULL,
                    `city` varchar(30) NOT NULL
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
         mysqli_query($db,"INSERT INTO `citys` (`location_id`, `city`) VALUES
                    ('641780','Новосибирск'),
                    ('641490','Барабинск'),
                    ('641510','Бердск')");
         mysqli_query($db,"DROP TABLE IF EXISTS `private`");
         mysqli_query($db,"CREATE TABLE `private` (
                    `private_id` varchar(1) NOT NULL,
                    `private_value` varchar(15) NOT NULL
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
         mysqli_query($db,"INSERT INTO `private` (`private_id`, `private_value`) VALUES
                    ('1','Частное лицо'),
                    ('0','Компания')");
         echo "<a href='index.php'>Перейти на сайт</a>";
}

