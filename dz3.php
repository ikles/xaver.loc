<?php
/*
 * Следующие задания требуется воспринимать как ТЗ (Техническое задание)
 * p.s. Разработчик, помни! 
 * Лучше уточнить ТЗ перед выполнением у заказчика, если ты что-то не понял, чем сделать, переделать, потерять время, деньги, нервы, репутацию.
 * Не забывай о навыках коммуникации :)
 * 
 * Задание 1
 * - Создайте массив $date с пятью элементами
 * - C помощью генератора случайных чисел забейте массив $date юниксовыми метками
 * - Сделайте вывод сообщения на экран о том, какой день в сгенерированном массиве получился наименьшим, а какой месяц наибольшим
 * - Отсортируйте массив по возрастанию дат
 * - С помощью функция для работы с массивами извлеките последний элемент массива в новую переменную $selected
 * - C помощью функции date() выведите $selected на экран в формате "дд.мм.ГГ ЧЧ:ММ:СС"
 * - Выставьте часовой пояс для Нью-Йорка, и сделайте вывод снова, чтобы проверить, что часовой пояс был изменен успешно
 * 

 */
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
$date = array();
$i=0;

while ($i++ < 5) {
    $date[] = mt_rand(0, time());
}

print_r($date);

$minday0 = date('d', $date[0]);
$minday1 = date('d', $date[2]);
$minday2 = date('d', $date[2]);
$minday3 = date('d', $date[3]);
$minday4 = date('d', $date[4]);

echo "Наименьший день в массиве: ".min($minday0,$minday1,$minday2,$minday3,$minday4)."\n" ; //минимальный день

$maxmonth0 = date('m', $date[0]);
$maxmonth1 = date('m', $date[1]);
$maxmonth2 = date('m', $date[2]);
$maxmonth3 = date('m', $date[3]);
$maxmonth4 = date('m', $date[4]);


echo "Наибольший месяц в массиве: ".max($maxmonth0,$maxmonth1,$maxmonth2,$maxmonth3,$maxmonth4)."\n"; 

sort($date);
print_r($date);
echo "\n";

$selected = array_pop($date);
echo $selected."\n";
print_r($date);

$selected = date('d.m.y H:i:s',$selected);
echo $selected."\n";
echo "Мой часовой пояс: ".date_default_timezone_get()."\n";
date_default_timezone_set('America/New_York');
echo "Новый часовой пояс: ".date_default_timezone_get()."\n";