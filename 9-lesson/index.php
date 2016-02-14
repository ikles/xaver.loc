<?php

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$db = mysql_connect('localhost', 'test', '123') or die('Mysql сервер недоступен '. mysql_error());
echo "Соединение с сервером установлено успешно";
mysql_select_db('test2', $db)or die('<br>Не удалось соединиться с базой данных '. mysql_error().'<br>');
mysql_query("SET NAMES utf8");
echo "<br>База данныъх выбрана спешно<br>";//$db идентификатор подключение, если подключнеие одно то он не обязательный
$result = mysql_query('select users.id,first_name,last_name,phone,department,departments.id as department_id,name from users left join departments on (users.department=departments.id)') or die ('Запрос на удался '. mysql_error()); //limit 1 - 1 запись, 1,2 - начиная с 1 вывести 2 записи
// так как обе таблицы имеют id то нужно обозначить к какой таблице отностися каждый id - users.id и departments.id
// departments.id при это создаем виртуальное имя через as department_id

//echo "Всего количество юзеров: ".mysql_num_rows($result)."<br>";

//exit();

while ($row = mysql_fetch_assoc($result)) {
    $row['last_name'].=" А.";
    mysql_query("update users set last_name='$row[last_name]' where id = $row[id]") 
    or die(mysql_error());
    //обновить значение users столбец last_name на то что пристыковано выше где id равно тому id который сейчас учавствует в итеррации
    echo "количество строк обработано: ".  mysql_affected_rows()."<br>";
    print_r($row);
}

//mysql_query('delete from users where id=4'); //удалить из users где id = 4
mysql_query('delete from users where phone like "%888%"'); //удалить из users где телефон содержит 888
echo "количество строк обработано: ".  mysql_affected_rows()."<br>";

//Вставка данных в таблицу

$insert_sql="INSERT INTO `users` (`first_name`, `last_name`, `phone`, `department`)
VALUES ('Петр5', 'Иванов', '89999999999', '2')";//запрос присваиваем переменной, не указываем тут id т.к он заполняется автоматом

mysql_query($insert_sql) or die(mysql_error()); //посылаем запрос в бд
echo "Новый идентификатор ".mysql_insert_id();//выводит какой идентификатор был добавлен последним


mysql_free_result($result);//очистить память
mysql_close();//закрыть соединение с базой данных
