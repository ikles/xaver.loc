<?php

/*Задание 1*/

$name = 'Игорь';
$age = 28;
echo '"Меня зовут '."$name\"\n".' <br>"Мне '.$age.' лет"';
unset($name);
unset($age);
echo '<br><br>';

/*Задание 2*/

define("CITY", "Москва");
if (defined("CITY")) {
  echo CITY;
}
else {
    echo '<br>Константа не существует';
}
echo '<br><br>';
define("CITY", "Новосибирск");

/*Задание 3*/

$book = array(
    'title'=>'Транссерфинг реальности',
    'author'=>'Вадим Зеланд',
    'pages'=>'589'
);
echo '"Недавно я прочитал книгу \''.$book['title'].'\', написанную автором '.$book['author'].', я осилил все '.$book['pages'].' страниц, мне она очень понравилась"';
echo '<br><br>';

/*Задание 4*/
 $book1 = array('title1'=>'Транссерфинг реальности', 'author1'=>'Вадим Зеланд', 'pages1'=>'589');
 $book2 = array('title2'=>'Я такой как все', 'author2'=>'Олег Тиньков', 'pages2'=>'571');

$books = array($book1,$book2);
$total_pages = $books['0']['pages1']+$books['1']['pages2'];

echo '"Недавно я прочитал книги \''.$books['0']['title1'].'\' и \''.$books['1']['title2'].'\', написанные соответственно авторами '.$books['0']['author1'].' и '.$books['1']['author2'].', я осилил в сумме '.$total_pages.' страниц, не ожидал от себя подобного"';