<?php
require('config.php');

$db = mysql_connect('localhost', 'form_user', '1234') or die('Mysql сервер недоступен '. mysql_error());
mysql_select_db('form', $db)or die('<br>Не удалось соединиться с базой данных '. mysql_error().'<br>');
mysql_query("SET NAMES utf8");

require('functions.php');

getAds();
add_up_del_ads();
get_id_key_exists();

if (isset ($ads)) {$smarty->assign('ads', $ads);}

if (check_get_params()) {
    $smarty->assign('ad', $ad);
} else {
    $smarty->assign('ad', NULL);
}

if (check_get_params()) {
    $smarty->assign('id', $_GET['id']);
}

citys();
$smarty->assign('citys',$cities);
categories();
$smarty->assign('category',$categorys);
private_val();
$smarty->assign('private', $privats);

if (isset ($last_id)) {$smarty->assign('last_id', $last_id);}

$smarty->display('template.tpl');