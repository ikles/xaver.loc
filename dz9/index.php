<?php

require('config.php');

$db = mysql_connect('localhost', 'form_user', '1234') or die('Mysql сервер недоступен ' . mysql_error());
mysql_select_db('form', $db)or die('<br>Не удалось соединиться с базой данных ' . mysql_error() . '<br>');
mysql_query("SET NAMES utf8");

require('functions.php');

if (check_get_params()) {
    $id = $_GET['id'];
    $smarty->assign('id', $_GET['id']);
}
else {$id = '';}

if (validate($_POST) && !check_get_params()){ //если заполнена форма и гет параметров нет
    add_ads();
}
elseif (check_get_params() && isset($_POST['main_form_submit'])) {//при сохранении объявления
    up_ads();
}

$ads = getAds(); //показы списка
$ads = delAds($ads,$id); //удаление объявления
$ad = get_id_key_exists($ads); //проверка на существование ключа

if (isset($ads)) {
    $smarty->assign('ads', $ads);
}

if (check_get_params()) {
    $smarty->assign('ad', $ad);
} else {
    $smarty->assign('ad', NULL);
}

$smarty->assign('citys', getCitys());
$smarty->assign('category', getCategories());

if (isset($last_id)) {
    $smarty->assign('last_id', $last_id);
}

$smarty->display('template.tpl');