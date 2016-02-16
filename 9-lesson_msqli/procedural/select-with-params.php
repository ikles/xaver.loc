<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title>
</head>
<body>

<h1>Выборка с параметрами на MySQLi</h1>

<?php

$db = mysqli_connect('localhost', 'root', '', 'xmpl');


$username = 'guest';
$password = '123456'; // "' OR '1'='1"

$sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

$result = mysqli_query($db, $sql);

echo "<h2>Выборка записи без защиты от SQL инъекции: </h2>";
if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    echo "{$user['id']}. Username: {$user['username']}, Password: {$user['password']}. <br />";
}

echo "<hr />";


$username = mysqli_real_escape_string($db, 'guest');//функция защищает от sql иньекций
$password = mysqli_real_escape_string($db, '123456'); // "' OR '1'='1"

$sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

$result = mysqli_query($db, $sql);

echo "<h2>Выборка записи с \"ручной\" защитой от SQL инъекции: </h2>";
if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    echo "{$user['id']}. Username: {$user['username']}, Password: {$user['password']}. <br />";
}

echo "<hr />";



$sql = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $usrnm, $psswrd);

$usrnm = 'guest';
$psswrd = '123456'; // "' OR '1'='1"

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $id, $username, $password);

echo "<h2>Выборка записи с \"автоматической\" защитой от SQL инъекции: </h2>";
mysqli_stmt_fetch($stmt);
echo "{$id}. Username: {$username}, Password: {$password}. <br />";

mysqli_stmt_close($stmt);

mysqli_close($db);
?>

</body>
</html>