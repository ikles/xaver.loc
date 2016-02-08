<?php
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$project_root = $_SERVER['DOCUMENT_ROOT'];
$smarty_dir = $project_root . '/dz8/smarty/';

// put full path to Smarty.class.php
require($smarty_dir . 'libs/Smarty.class.php');

$smarty = new Smarty(); //создаем новый объект смарти и запис в перемен

$smarty->compile_check = true; //обращаемся к свойствам объекта чтобы их выставить
$smarty->debugging = true; //дебаггер

$smarty->template_dir = $smarty_dir . 'templates';
$smarty->compile_dir = $smarty_dir . 'templates_c';
$smarty->cache_dir = $smarty_dir . 'cache';
$smarty->config_dir = $smarty_dir . 'configs';

///////////////////////////////////////////////////////////////////////////////////

if (file_exists('ads.html')) {
    $ads = file_get_contents('ads.html');
    $ads = unserialize($ads);
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
function check_data() {
    if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
        return true;
    } else {
        return false;
    }
}

if (validate($_POST) && !check_data()) {
    $ads[] = $_POST;
} elseif (check_data() && isset($_POST['main_form_submit'])) {//при сохранении объявления
    $ads[$_GET['id']] = $_POST; //Перезаписать данные в массив с определенным индексом который берется из get id
} elseif (isset($_GET['action']) && !isset($_POST['main_form_submit'])) {//если существует GET['action'] и при этом не нажата кнопка
    $id = $_GET['id'];
    if ($_GET['action'] == 'del' && isset($ads[$id])) {
        unset($ads[$id]);
    }
}
if (isset($ads)) {
    file_put_contents('ads.html', serialize($ads));
}
if (isset($_GET['id'])) {
    $get_id = $_GET['id'];
}
if (isset($get_id) && array_key_exists($get_id, $ads)) {
    $ad = $ads[$_GET['id']];
} else {
    $ad = '';
}

/////////////////////////////////////////////

if (isset ($ads)) {$smarty->assign('ads', $ads);}

if (check_data()) {
    $smarty->assign('ad', $ad);
} else {
    $smarty->assign('ad', NULL);
}

if (check_data()) {
    $smarty->assign('id', $_GET['id']);
}

$smarty->assign('citys', array('641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск'));

$smarty->assign('category', array('24' => 'Квартиры',
    '23' => 'Комнаты',
    '25' => 'Дома, дачи, коттеджи')
);

$smarty->assign('private', array('1' => 'Частное лицо', '0' => 'Компания'));
$smarty->display('template.tpl');