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
date_default_timezone_set('Asia/Novosibirsk');
$i=0;
while ($i++ < 5) {
    $date[] = mt_rand(0, time());
    $month[] = date('m', $date[$i-1]);
    $day[] = date('d', $date[$i-1]);
}

print_r($date);
print_r($month);
print_r($day);

echo "Наименьший день в массиве: ".min($day[0],$day[1],$day[2],$day[3],$day[4])."\n" ; //минимальный день

echo "Наибольший месяц в массиве: ".max($month[0],$month[2],$month[2],$month[3],$month[4])."\n"; 

sort($date);
print_r($date);
echo "\n";

$selected = array_pop($date);
echo $selected."\n";
echo date('d.m.y H:i:s', $selected)."\n";
print_r($date);

//$selected = date('d.m.y H:i:s',$selected);
//echo $selected."\n";
//echo "Мой часовой пояс: ".date_default_timezone_get()." Мое время: ".date('d.m.y H:i:s', $selected)."\n";
//date_default_timezone_set('America/New_York');
//echo "Новый часовой пояс: ".date_default_timezone_get()." Новое время: ".date('d.m.y H:i:s', $selected);
//Здесь я пытался изменить часовой пояс у переменной в которую попало значение даты, но из этого ничего не вышло т. к.
//функция не может изменить время в переменной, это уже просто строка. Правильное решение приведено ниже.

echo "Мой часовой пояс: ".date_default_timezone_get()." Мое время: ".date('d.m.y H:i:s', $selected)."\n";
date_default_timezone_set('America/New_York');
echo "Новый часовой пояс: ".date_default_timezone_get()." Новое время: ".date('d.m.y H:i:s', $selected);