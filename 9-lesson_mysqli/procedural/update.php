<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title>
</head>
<body>

<h1>Обновление существующей записи</h1>

<?php

$db = mysqli_connect('localhost', 'root', '', 'xmpl');

$sql = "UPDATE users SET username = ? WHERE id = ?";
$stmt = mysqli_prepare($db, $sql);

mysqli_stmt_bind_param($stmt, 'si', $username, $id);

$username = 'manager';
$id = '5';

mysqli_stmt_execute($stmt);

echo '<p>Было затронуто строк: ' . mysqli_affected_rows($db) . "</p>";

mysqli_stmt_close($stmt);

mysqli_close($db);
?>

</body>
</html>