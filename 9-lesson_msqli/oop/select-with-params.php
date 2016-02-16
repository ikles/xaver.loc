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

$db = new mysqli('localhost', 'root', '', 'xmpl');


$username = 'guest';
$password = '123456'; // "' OR '1'='1"

$sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

$result = $db->query($sql);

echo "<h2>Выборка записи без защиты от SQL инъекции: </h2>";
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    echo "{$user['id']}. Username: {$user['username']}, Password: {$user['password']}. <br />";
}

echo "<hr />";


$username = $db->real_escape_string('guest');
$password = $db->real_escape_string('123456'); // "' OR '1'='1"

$sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

$result = $db->query($sql);

echo "<h2>Выборка записи с \"ручной\" защитой от SQL инъекции: </h2>";
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    echo "{$user['id']}. Username: {$user['username']}, Password: {$user['password']}. <br />";
}

echo "<hr />";



$sql = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bind_param('ss', $usrnm, $psswrd);

$usrnm = 'guest';
$psswrd = '123456'; // "' OR '1'='1"

$stmt->execute();

$stmt->bind_result($id, $username, $password);

echo "<h2>Выборка записи с \"автоматической\" защитой от SQL инъекции: </h2>";
$stmt->fetch();
echo "{$id}. Username: {$username}, Password: {$password}. <br />";

$stmt->close();

$db->close();
?>

</body>
</html>