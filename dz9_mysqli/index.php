<?php
require('config.php');

$db = mysqli_connect('localhost', 'form_user', '1234', 'form') or die(mysql_error());
mysqli_query($db,"SET NAMES utf8");

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

$result2 = mysqli_query($db,"select * from citys");
while ($city = mysqli_fetch_assoc($result2)){
    $citys[] = $city;
}

foreach($citys as $value){
    $cities[$value['location_id']] = $value['city'];
}
//$smarty->assign('citys', array('641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск'));
$smarty->assign('citys',$cities);

$result3 = mysqli_query($db,"select * from categories");
while ($category = mysqli_fetch_assoc($result3)){
    $categories[] = $category;
}

foreach($categories as $value){
    $categorys[$value['category_id']] = $value['category'];
}
$smarty->assign('category',$categorys);
//$smarty->assign('category', array('24' => 'Квартиры','23' => 'Комнаты','25' => 'Дома, дачи, коттеджи'));

$result4 = mysqli_query($db,"select * from private");
while ($private = mysqli_fetch_assoc($result4)){
    $privates[] = $private;
}

foreach($privates as $value){
    $privats[$value['private_id']] = $value['private_value'];
}
$smarty->assign('private', $privats);

if (isset ($last_id)) {$smarty->assign('last_id', $last_id);}

$smarty->display('template.tpl');