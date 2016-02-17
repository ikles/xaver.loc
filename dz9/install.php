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
        $db = mysql_connect($server_name, $user_name, $password) or die('Mysql сервер недоступен '. mysql_error());
        mysql_select_db($database, $db)or die('<br>Не удалось соединиться с базой данных '. mysql_error().'<br>');
        mysql_query("SET NAMES utf8");
        mysql_query("SET time_zone = '+00:00'");
        mysql_query("SET foreign_key_checks = 0");
        mysql_query("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");
        mysql_query("DROP TABLE IF EXISTS `ads`");
        mysql_query("CREATE TABLE `ads` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `private` tinyint(4) NOT NULL,
                    `seller_name` varchar(10) NOT NULL,
                    `email` varchar(15) NOT NULL,
                    `allow_mails` tinyint(4) NOT NULL,
                    `phone` varchar(12) NOT NULL,
                    `location_id` int(11) NOT NULL,
                    `category_id` int(11) NOT NULL,
                    `title` varchar(30) NOT NULL,
                    `description` varchar(255) NOT NULL,
                    `price` varchar(10) NOT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
        
        mysql_query("INSERT INTO `ads` (`id`, `private`, `seller_name`, `email`, `allow_mails`, `phone`, `location_id`, `category_id`, `title`, `description`, `price`) VALUES
                   (34,1,'4654','4446',1,'464',641490,25,'4564','4465','44'),
                   (36,1,'464','446',1,'464',641780,24,'4664','4646','4664')");
        mysql_query("DROP TABLE IF EXISTS `categories`");
        mysql_query("CREATE TABLE `categories` (
                    `category_id` varchar(3) NOT NULL,
                    `category` varchar(10) NOT NULL
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
         mysql_query("INSERT INTO `categories` (`category_id`, `category`) VALUES
                    ('24','Квартиры'),
                    ('23','Комнаты'),
                    ('25','Дома, дачи')");
         mysql_query("DROP TABLE IF EXISTS `citys`");
         mysql_query("CREATE TABLE `citys` (
                    `location_id` varchar(10) NOT NULL,
                    `city` varchar(30) NOT NULL
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
         mysql_query("INSERT INTO `citys` (`location_id`, `city`) VALUES
                    ('641780','Новосибирск'),
                    ('641490','Барабинск'),
                    ('641510','Бердск')");
         mysql_query("DROP TABLE IF EXISTS `private`");    
         echo "<a href='index.php'>Перейти на сайт</a>";
}

