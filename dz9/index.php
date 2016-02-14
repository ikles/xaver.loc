<?php
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
  
$project_root = $_SERVER['DOCUMENT_ROOT'];
$smarty_dir = $project_root . '/dz9/smarty/';
//
// put full path to Smarty.class.php
require($smarty_dir . 'libs/Smarty.class.php');

$smarty = new Smarty(); //создаем новый объект смарти и записываем в переменную

$smarty->compile_check = true; //обращаемся к свойствам объекта чтобы их выставить
$smarty->debugging = false; //дебаггер

$smarty->template_dir = $smarty_dir . 'templates';
$smarty->compile_dir = $smarty_dir . 'templates_c';
$smarty->cache_dir = $smarty_dir . 'cache';
$smarty->config_dir = $smarty_dir . 'configs';

///////////////////////////////////////////////////////////////////////////////////

$db = mysql_connect('localhost', 'form_user', '1234') or die('Mysql сервер недоступен '. mysql_error());
mysql_select_db('form', $db)or die('<br>Не удалось соединиться с базой данных '. mysql_error().'<br>');
mysql_query("SET NAMES utf8");

$insert_sql = "select ads.id,private,seller_name,email,allow_mails,phone,ads.location_id,ads.category_id,title,description,price,categories.category_id "
        . "as categories_category_id,citys.location_id as citys_location_id,category,city,private_id,private_value "
        . "from ads left join categories on (ads.category_id=categories.category_id) left join citys on (ads.location_id=citys.location_id) "
        . "left join private on (ads.private = private.private_id)";

$result = mysql_query($insert_sql);
while ($row = mysql_fetch_assoc($result)) {
    $ads[$row['id']] = $row;
}

//Функция проверки формы и сохраниение в сессию
function validate($post) {
    if (isset($post['private']) &&
            isset($post['main_form_submit']) &&
            !empty($post['seller_name']) &&
            !empty($post['email']) &&
            !empty($post['phone']) &&
            !empty($post['location_id']) &&
            !empty($post['category_id']) &&
            !empty($post['title']) &&
            !empty($post['description']) &&
            !empty($post['price'])) {
        return true;
    } else {
        return false;
    }
}

//Функция проверки полей формы
function check_get_params() {
    if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
        return true;
    } else {
        return false;
    }
}

if (validate($_POST) && !check_get_params()) {//если заполнена форма и гет параметров нет
    //реализовать добавление объявления в базу
    if (!isset($_POST['allow_mails'])) {$_POST['allow_mails']="0";}
    $ads[] = $_POST;
    $new_ad = "insert into `ads` (`private`, `seller_name`, `email`, `allow_mails`,`phone`,`location_id`,`category_id`,`title`,`description`,`price`)
VALUES ('$_POST[private]', '$_POST[seller_name]','$_POST[email]','$_POST[allow_mails]','$_POST[phone]','$_POST[location_id]','$_POST[category_id]','$_POST[title]','$_POST[description]','$_POST[price]')";
    mysql_query($new_ad);
}

elseif (check_get_params() && isset($_POST['main_form_submit'])) {//при сохранении объявления
    //перезаписать объявление в базу
    $ads[$_GET['id']] = $_POST;
    /*print_arr($ads);*/
    if (!isset($_POST['allow_mails'])) {$_POST['allow_mails']="0";}
    $up_ad = "update ads set private='$_POST[private]', seller_name='$_POST[seller_name]', email='$_POST[email]', allow_mails='$_POST[allow_mails]', phone='$_POST[phone]', location_id='$_POST[location_id]', category_id='$_POST[category_id]', title='$_POST[title]', description='$_POST[description]', price='$_POST[price]' where id = $_GET[id]";
    mysql_query($up_ad) or die(mysql_error());

    
} elseif (isset($_GET['action']) && !isset($_POST['main_form_submit'])) {//если существует GET['action'] и при этом не нажата кнопка
    $id = $_GET['id'];
    if ($_GET['action'] == 'del' && isset($ads[$id])) {
        unset($ads[$id]);
        mysql_query("delete from ads where id = $_GET[id]");
    }
}

if (isset($_GET['id']) && array_key_exists($_GET['id'], $ads)) {//проверка существует ли array_key_exists ключ в массиве
    $ad = $ads[$_GET['id']];
} else {
    $ad = '';
}
  function print_arr($a){
        echo"<pre>";
        print_r($a);
        echo"</pre>";
    }

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

$smarty->display('template.tpl');