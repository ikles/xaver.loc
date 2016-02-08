<?
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$my_name = 'Igor';
echo ($my_name == 'Igor' ? 'yes' : 'no');
echo "\n";

//тернарный оператор

$test = 'Игорь';

/*function test_ok ($p) {
    global $test; //функция будет использовать глобальные переменные объявленные вне
    echo $test.'-'.$p;
}

test_ok (28);*/

function test_ok (&$p) { //&=> передача параметров по ссылки
   $p.=' 28 y.o';
}

//идет в память и меняет значение переменной

test_ok($test);
echo $test;