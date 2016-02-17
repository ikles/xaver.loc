<?php

require('config.php');

$db = mysqli_connect('localhost', 'form_user', '1234', 'form') or die(mysql_error());
mysqli_query($db,"SET NAMES utf8");

require('functions.php');

add_up_del_ads(); //добавление/обновление
getAds(); //показы списка
delAds(); //удаление объявления
get_id_key_exists(); //проверка на существование ключа

if (isset($ads)) {
    $smarty->assign('ads', $ads);
}

if (check_get_params()) {
    $smarty->assign('ad', $ad);
} else {
    $smarty->assign('ad', NULL);
}

if (check_get_params()) {
    $smarty->assign('id', $_GET['id']);
}

citys();
$smarty->assign('citys', $cities);
categories();
$smarty->assign('category', $categorys);

if (isset($last_id)) {
    $smarty->assign('last_id', $last_id);
}

$smarty->display('template.tpl');
