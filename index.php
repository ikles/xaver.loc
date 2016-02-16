<?
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
phpinfo();
echo "cell:" . ceil(4) . "<br>";
echo "floor:" . floor(6.945) . "<br>";
echo "floor:" . round(6.236) . "<br>";
echo "floor:" . round(6.236, 2) . "<br>"; //2 цифры после запятой
echo "floor:" . round(6.2366, 3) . "<br>"; //3 цифры после запятой
echo min(6, 2366, 3, 256) . "<br>"; //минимальное число
echo max(6, 236, 3, 235) . "<br>"; //максимальное число
//echo rand(0,10)."<br>";//случайно сгененрированное число, иногда подряд одно и то же число выдает, чтобы этого не было делается следующее
mt_srand(time());
echo mt_rand(10, 100) . "<br>";
$str = "1234567890";
echo strlen($str) . "<br>"; //считает длинну строки
$name = " | Igor . ";
echo var_dump(trim($name, '. |')) . "<br>"; //удаляет пробелы, вторым параметром можно добавить чтобы удаляло символы и их записать подряд
//rtrim(); чистит справа ltrim(); чистит слева
$str2 = "|privet kak dela|";
echo strtoupper($str2) . "<br>";
echo strrev($str2) . "<br>"; //реверс
echo substr($str2, 1, 3) . "<br>"; //берет часть строки первое число позиция с которой начинать, второе сколько символов брать
// если взять -2 позицию то с конца начнется отсчет
echo strstr($str2, 'i') . "<br>"; // начинает с этой буквы
//pattern шаблон
if (!preg_match_all('/(\d+)/', 'raz, dva, 345 555 678', $matches1)) {
    echo 'yes';
}

//print_r($matches1);

if (preg_match('/Ticket\s+(\d+)/i', 'Ticket 15', $matches2)) {
    echo 'yes';
}

print_r($matches2) . "<br>";

$_SERVER;


echo count($_SERVER) . "<br>";
//echo sort($_SERVER)."<br>";//сортирует и создает индексный массив из ассоциативного
//echo ksort($_SERVER)."<br>";//сортирует оставив массив ассоциативным
//echo array_multisort($_SERVER, SORT_DESC)."<br>";//
//echo rsort($_SERVER)."<br>";//
//echo krsort($_SERVER)."<br>";//сортировка по ключам в обратном порядке

/* function shuffle_assoc($list) {
  if (!is_array($list))
  return $list;

  $keys = array_keys($list);
  shuffle($keys);
  $random = array();
  foreach ($keys as $key) {
  $random[$key] = $list[$key];
  }
  return $random;
  }
  $_SERVER = shuffle_assoc($_SERVER);
  echo "<pre>";
  print_r($_SERVER);
  echo "</pre>"; */

$new = array_slice($_SERVER, 0, 1); //берет 5 сконца элемент и от него берет 3 элемента
$new2 = array_slice($_SERVER, -1, 1);
$new4 = array_slice($_SERVER, -5, 1);

echo "\n";
echo "<pre>";
print_r($new);
print_r($new2);
print_r($new4);
$new3 = array_merge($new, $new2, $new4);
print_r($new3);
print_r($_SERVER);
echo "</pre>";

//Array_diff, array_intersect, array_pop, array_shift, array_flip

/*$a = array("apple","banana");
$b = array("banana","coconut");
$c = array("banana","orange");

$d = array_diff($a, $b, $c);

print_r($a);
print_r($b);
print_r($c);
print_r($d);
echo '<br>';
$d = array_intersect($a, $b, $c);

print_r($a);
print_r($b);
print_r($c);
print_r($d);*/

/*Находит схождения, выведет банан
echo "\n";
$a = array("apple","banana","coconut","orange");
$b = array_pop($a);
var_dump(array_pop($a));
var_dump($a);
//выталкивает последний элемент из массива*/

/*echo "\n";
$a = array("apple","banana","coconut","orange");
$b = array_shift($a);
//var_dump(array_shift($a));
var_dump($b);
var_dump($a);
//выталкивает первый элемент из массива*/

echo "\n";
$a = array("apple","banana","coconut","orange","coconut");
print_r($a);
$a = array_flip($a);
print_r($a);
$a = array_flip($a);
print_r($a);
//ключи становятся значениями а значения ключами
//в этом примере благодаря перевороту 2 раза удалились дублирующиеся значения coconut

echo "<br><br><br>";
function printme ($val1,$val2,$val3){
    echo $val1.'-'.$val2.'-'.$val3."\n";
}



array_map('printme',array('a','b'),array('c','d'),array('e','g'));
echo "<br><br><br>";

echo date_default_timezone_get();
date_default_timezone_set('Asia/Novosibirsk');
echo date('l d.m.Y H:i:s');


//echo ":".time();//1 января 1970 начало эпохи unix//timestamp

//php date time zone загуглить документация с часовыми поясами

//создаем штамп времени
//$timestamp = mktime(1,1,1,1,1,2014);//1 секнда 1 минуты 1 часа первого дня первого месяца 2014 года
//echo $timestamp;

//echo "\n".date('l d.m.Y H:i:s',$timestamp);//c помощью функции date форматировали в удобочитаемый вид

echo "\n";
$timestamp = strtotime('2015-01-09 1:53:00');//нормальную дату преобразовываем в строку
echo $timestamp." в ненормальную строку";
echo "\n".date('l d.m.Y H:i:s',$timestamp); // обратно в нормальный формат
echo "\n";
$timestamp = strtotime('2015-01-09 1:53:00 +78 days -7 hours +0 minutes');//функция понимает если ее спросить что букдет через 7 дней 7 часов и т. д.
echo "\n".date('l d.m.Y H:i:s',$timestamp);
echo "\n";
$timestamp = strtotime('last sunday');//функция какое число было прошлое воскресменье
echo "\n".date('l d.m.Y H:i:s',$timestamp);
$timestamp = strtotime('last sunday -7 days');//и позапрошлое
echo "\n".date('l d.m.Y H:i:s',$timestamp);
echo "\n";
echo "\n";
echo "\n";
echo "\n";
echo "\n";
echo "\n";
echo "\n";