<?php
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$project_root = $_SERVER['DOCUMENT_ROOT'];

require_once $project_root . "/10-lesson/dbsimple/config.php";
require_once "DbSimple/Generic.php";


//Подключаем библиотеку
require_once $project_root . "/10-lesson/FirePHPCore/lib/FirePHP.class.php";

//Инициализируем класс
$firePHP = FirePHP::getInstance(true);

//Устанавливаем активность. Если false то в firebug не будет видно
$firePHP->setEnabled(true);

//Создаем тестовый массив
/*$myArray = array(
    'name' => '123'
);*/

//Кидаем массив в лог
//$firePHP->log($myArray);

// Подключаемся к БД.
$db = DbSimple_Generic::connect('mysqli://test:123@localhost/test2'); //DNS //логин пароль хост база данных
// Устанавливаем обработчик ошибок.
$db->setErrorHandler('databaseErrorHandler');
// Устанавливаем логгер mysql
$db->setLogger('myLogger');

//обычный placeholder
//$result = $db->select("SELECT * FROM departments where id=?",$_GET['id']);
//выбор всех строк из таблицы departments
//print_r($result);
//ассоциативный placeholder
/* $ids = array(2, 3);
  $result = $db->select("SELECT * FROM departments WHERE id IN(?a)", $ids); */
// выбрать все из таблицы где id находится в списке $ids
//print_r($result);

//INSERT
/* $row = array(
  'id'   => 110,
  'name' => "Уборки"
  ); */
//$result = $db->query('INSERT departments SET ?a', $row);

//UPDATE
/* $row = array(
  'name' => "Уборки помещений"
  );
  $id = 110;
  $result = $db->query('UPDATE departments SET ?a WHERE id=?d' , $row, $id); */


//$row = array('id' => 111, 'name' => 'Клининг');
//$db->query('INSERT INTO departments(?#) VALUES(?a)', array_keys($row), array_values($row));
//вставление в таблицу через идентификаторно списковы плейсхолдер
//(?#) сюда передаются ключи массива (id, name), а сюда (?a) занчения массива
//$row = array('name' => 'Клининг');
//$db->query('INSERT INTO departments(?#) VALUES(?a)', array_keys($row), array_values($row));
//id можно не указывать он автоинкремментный
//$result = $db->select("SELECT id AS ARRAY_KEY,name FROM departments");
// таким образом id AS ARRAY_KEY,name id становится ключом массива а name просто значением
/*
  Array
  (
  [1] => Array
  (
  [name] => Финансовый
  )

  [2] => Array
  (
  [name] => Почтовый
  )

 *  */


//$result = $db->selectRow("SELECT id,name FROM departments");
//$db->selectRow выдает первый ряд одномерным массивом
/*
  Array
  (
  [id] => 1
  [name] => Финансовый
  )
 *  */


//$result = $db->selectRow("SELECT id,name FROM departments WHERE id=?d", $_GET['id']);
//можно также указать какую строку именно нужно выбрать
/*
  Array
  (
  [id] => 3
  [name] => Доставка
  )
 *  */
//если не писать $db->selectRow а просто $db->select то получился бы много мерный массив
/*
  Array
  (
  [0] => Array
  (
  [id] => 3
  [name] => Доставка
  )

  )
 *  */

//выбор ячейки 
//$result = $db->selectCell("SELECT name FROM departments WHERE id=?d", $_GET['id']);
/* выведет просто 'Доставка' название ячейки для ввдеденного id */
//не надо делать циклы и прочее


$ads = $db->select('SELECT * FROM departments');
$firePHP->table('Table label', $ads);

//выбрать колонку со всеми названиями наших...
/*
  Array
  (
  [0] => Финансовый
  [1] => Почтовый
  [2] => Доставка
  [3] => Уборки помещений
  [4] => Клининг
  [5] => Клининг
  [6] => Клининг
  )
 * Удобно делает это индексным массивом */

//print_r($result);

$db->select('SELECT * FROM departments');

//логирование запросов
//подключили это на 15 строке $DB->setLogger('myLogger');
function myLogger($db, $sql, $caller) {
    global $firePHP;
    if(isset($caller['file'])){
      $firePHP->group("at " . @$caller['file'] . ' line ' . @$caller['line']);  
    }
    
    $firePHP->log($sql);
        if(isset($caller['file'])){
    $firePHP->groupEnd();
    }
}

//показывает какие запросы сделаны и сколько строк затронуто и пр.
// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info) {
    // Если использовалась @, ничего не делать.
    if (!error_reporting())
        return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>";
    print_r($info);
    echo "</pre>";
    exit();
}
