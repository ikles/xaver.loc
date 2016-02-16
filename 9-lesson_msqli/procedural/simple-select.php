<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title>
</head>
<body>

<h1>Простая выборка на MySQLi</h1>

<?php

$db = mysqli_connect('localhost', 'root', '', 'xmpl'); //подключение к серверу и выбор бд происходит в одной строке хост юзер пароль имя бд


$sql = "SELECT * FROM users"; //sql запрос
$result = mysqli_query($db, $sql); // первый арг. подключение второй сам запрос

echo "<h2>Вывод записей из результата по одной: </h2>";
while($user = mysqli_fetch_assoc($result)) { // mysql_fetch_assoc(...)
    echo "{$user['id']}. Username: {$user['username']}, Password: {$user['password']}. <br />";
}


echo "<hr />";

//Второй способ позволяет выводить данные сразу в массив без использования цикла while

$sql = "SELECT * FROM users";
$result = mysqli_query($db, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);//mysqli_fetch_all функция создания этого массива, MYSQLI_ASSOC аргумен показывающий что нужен ассоциативный

echo "<h2>Выборка все записей в массив и вывод на экран: </h2>";
foreach ($users as $user) {
    echo "{$user['id']}. Username: {$user['username']}, Password: {$user['password']}. <br />";
}


echo "<hr />";


$sql = "SELECT * FROM users";

$stmt = mysqli_prepare($db, $sql); //функция вместо mysqli_query подготавливает запрос

mysqli_stmt_execute($stmt); //выполняет запрос

mysqli_stmt_bind_result($stmt, $id, $username, $password);//функция позволяет задать ключам массива переменные, чтобы оращаться уже к ним а не к ключам массива
//первый аргумент это сам запрос, потом уже имена переменных для колонок
//в каком порядке колонки в таком и переменные записывать

echo "<h2>Вывод записей с помощью подготовленного выражения и привязка данных к переменным: </h2>";
while (mysqli_stmt_fetch($stmt)) {//фция передает выражение чтобы можно было его разобрать
    echo "{$id}. Username: {$username}, Password: {$password}. <br />";
    //данные выводятся уже с помощью наших новых переменных
}

mysqli_stmt_close($stmt);//закрываем выражение чтобы разгрузить память

mysqli_close($db); //закрываем соединение
?>

</body>
</html>