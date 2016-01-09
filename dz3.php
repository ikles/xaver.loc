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
while ($i<5)
{
$a = mt_rand(1, 12);
$b = mt_rand(1, 12);   
$date[] = mktime(0,0,0,$a,$b,2016);
$i++;
}
print_r($date);

$timestamp = $date[0];
$date0 =  date('d.m.y H:i:s',$timestamp)."\n";
$timestamp2 = $date[1];
$date1 =  date('d.m.y H:i:s',$timestamp2)."\n";
$timestamp3 = $date[2];
$date2 =  date('d.m.y H:i:s',$timestamp3)."\n";
$timestamp4 = $date[3];
$date3 =  date('d.m.y H:i:s',$timestamp4)."\n";
$timestamp5 = $date[4];
$date4 =  date('d.m.y H:i:s',$timestamp5)."\n";
print_r($date);

$minday0 = substr($date0, 0, 2);
$minday1 = substr($date1, 0, 2);
$minday2 = substr($date2, 0, 2);
$minday3 = substr($date3, 0, 2);
$minday4 = substr($date4, 0, 2);

echo "Наименьший день в массиве: ".min($minday0,$minday1,$minday2,$minday3,$minday4)."\n" ; //минимальный день

$maxmonth0 = substr($date0, 3, 2);
$maxmonth1 = substr($date1, 3, 2);
$maxmonth2 = substr($date2, 3, 2);
$maxmonth3 = substr($date3, 3, 2);
$maxmonth4 = substr($date4, 3, 2);

echo "Наибольший месяц в массиве: ".max($maxmonth0,$maxmonth1,$maxmonth2,$maxmonth3,$maxmonth4)."\n" ;

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