<?php

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
include 'functions.php';
/*$lines = file('./test.html'); //извлекает содержимое файла как индекс массив с значениями каждой строки до переноса
print_arr($lines);

foreach ($lines as $key => $value){
    echo $key .= " не очень => ";
    echo $value."<br>";
}*/


/*
$lines = file_get_contents('./test.html'); // извлекает содержимое файла как строку с переносами
var_dump($lines);

$lines = explode("\n",$lines); //разбивает строку на массив символ переноса строки указан разделителем
print_arr($lines);
 */

/*
 * Парсим весь сайт
$lines = file_get_contents('http://lenta.ru');
echo $lines;*/

//либо так
/*
$lines = file('http://lenta.ru');
print_r($lines);*/

//$lines = file_get_contents('http://lenta.ru');
//file_put_contents('test.html', $lines, FILE_APPEND); //append значит дописать в конец файла, если просто перезаписать надо то этот флаг не ставится
//считали разметку с сайтв всю и записали в файл 

file_put_contents('test.html', 'kak dela', FILE_APPEND);//просто добавляем текст kak dela в конец файла
//Закончил на времени 1.08.20