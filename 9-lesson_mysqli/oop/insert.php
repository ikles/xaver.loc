<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title>
</head>
<body>

<h1>Вставка новой записи</h1>

<?php

$db = new mysqli('localhost', 'root', '', 'xmpl');

$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $db->prepare($sql);

$stmt->bind_param('ss', $username, $password);

$username = 'author';
$password = '987456';

$stmt->execute();

echo '<p>Было затронуто строк: ' . $db->affected_rows . "</p>";
echo '<p>ID вставленной записи: ' . $db->insert_id . "</p>";

$stmt->close();

$db->close();
?>

</body>
</html>