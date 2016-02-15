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

$result2 = mysql_query("select * from citys");
while ($city = mysql_fetch_assoc($result2)){
    $citys[] = $city;
}

foreach($citys as $value){
    $cities[$value['location_id']] = $value['city'];
}
//$smarty->assign('citys', array('641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск'));
$smarty->assign('citys',$cities);

$result3 = mysql_query("select * from categories");
while ($category = mysql_fetch_assoc($result3)){
    $categories[] = $category;
}

foreach($categories as $value){
    $categorys[$value['category_id']] = $value['category'];
}
$smarty->assign('category',$categorys);
//$smarty->assign('category', array('24' => 'Квартиры','23' => 'Комнаты','25' => 'Дома, дачи, коттеджи'));

$result4 = mysql_query("select * from private");
while ($private = mysql_fetch_assoc($result4)){
    $privates[] = $private;
}

foreach($privates as $value){
    $privats[$value['private_id']] = $value['private_value'];
}
$smarty->assign('private', $privats);

if (isset ($last_id)) {$smarty->assign('last_id', $last_id);}

$smarty->display('template.tpl');