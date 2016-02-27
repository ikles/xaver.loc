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

$db = mysqli_connect('localhost', 'root', '', 'xmpl');


$sql = "SELECT * FROM users";
$result = mysqli_query($db, $sql); // mysql_query(///)

echo "<h2>Вывод записей из результата по одной: </h2>";
while($user = mysqli_fetch_assoc($result)) { // mysql_fetch_assoc(...)
    echo "{$user['id']}. Username: {$user['username']}, Password: {$user['password']}. <br />";
}


echo "<hr />";


$sql = "SELECT * FROM users";
$result = mysqli_query($db, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<h2>Выборка все записей в массив и вывод на экран: </h2>";
foreach ($users as $user) {
    echo "{$user['id']}. Username: {$user['username']}, Password: {$user['password']}. <br />";
}


echo "<hr />";


$sql = "SELECT * FROM users";

$stmt = mysqli_prepare($db, $sql);

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $id, $username, $password);

echo "<h2>Вывод записей с помощью подготовленного выражения и привязка данных к переменным: </h2>";
while (mysqli_stmt_fetch($stmt)) {
    echo "{$id}. Username: {$username}, Password: {$password}. <br />";
}

mysqli_stmt_close($stmt);

mysqli_close($db);
?>

</body>
</html>