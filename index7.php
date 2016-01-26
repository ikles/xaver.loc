<?php
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
$get = $_GET;
$get = serialize($get); //функция преобразовывает массив в удобную строку, потому что куки нехранят массивы а только строки
setcookie('ads',$get, time()+3600*24*7); //утсанавливаем куку, название, содержание куки, время жизни, чтобы удалить куку достаточно отправить ее в прошлое time()-1
print_r($_COOKIE['ads']); 
require_once 'test/test.php'; // подключаем файл в нем смотрим продолжение