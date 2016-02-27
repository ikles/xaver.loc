<?php
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$project_root = $_SERVER['DOCUMENT_ROOT'];
$smarty_dir = $project_root . '/dz10/smarty/';
// put full path to Smarty.class.php
require($smarty_dir . 'libs/Smarty.class.php');

require_once $project_root . "/dbsimple/config.php";
require_once $project_root ."/dbsimple/DbSimple/Generic.php";

//Подключаем библиотеку
require_once $project_root . "/FirePHPCore/lib/FirePHP.class.php";

//Инициализируем класс
$firePHP = FirePHP::getInstance(true);

//Устанавливаем активность. Если false то в firebug не будет видно
$firePHP->setEnabled(true);

$smarty = new Smarty(); //создаем новый объект смарти и записываем в переменную

$smarty->compile_check = true; //обращаемся к свойствам объекта чтобы их выставить
$smarty->debugging = false; //дебаггер

$smarty->template_dir = $smarty_dir . 'templates';
$smarty->compile_dir = $smarty_dir . 'templates_c';
$smarty->cache_dir = $smarty_dir . 'cache';
$smarty->config_dir = $smarty_dir . 'configs';
