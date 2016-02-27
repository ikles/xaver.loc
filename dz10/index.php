<?php
require('config.php');

// Подключаемся к БД.
$db = DbSimple_Generic::connect('mysqli://form_user:1234@localhost/form'); //DNS //логин пароль хост база данных
// Устанавливаем обработчик ошибок.
$db->setErrorHandler('databaseErrorHandler');
// Устанавливаем логгер mysql
$db->setLogger('myLogger');

require('functions.php');

if (check_get_params($_GET)) {
    $id = $_GET['id'];
    $smarty->assign('id', $_GET['id']);
} else {
    $id = '';
}

if (validate($_POST) && !check_get_params($_GET)) { //если заполнена форма и гет параметров нет
    add_ads($_POST);
} elseif (check_get_params($_GET) && isset($_POST['main_form_submit'])) {//при сохранении объявления
    up_ads($_POST);
}

if (isset($_GET['action']) && !isset($_POST['main_form_submit']) && $_GET['action'] == 'del') { //если существует GET['action'] и при этом не нажата кнопка
    delAds($_GET['id']); //удаление объявления
}

$ads = getAds(); //показы списка
//проверка существует ли ключ в массиве
if (isset($_GET['id']) && isset($ads) && array_key_exists($_GET['id'], $ads)) {
    $ad = $ads[$_GET['id']];
} else {
    $ad = '';
}

if (isset($ads)) {
    $smarty->assign('ads', $ads);
}

if (check_get_params($_GET)) {
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