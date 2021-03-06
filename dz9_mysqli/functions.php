<?php
// Добавление/обновление/удаление объявления
function add_up_del_ads() {
    global $ads;
    global $db;
    if (validate($_POST) && !check_get_params()) {//если заполнена форма и гет параметров нет
        //реализовать добавление объявления в базу
        if (!isset($_POST['allow_mails'])) {
            $_POST['allow_mails'] = "0";
        }
        $new_ad = "insert into `ads` (`private`, `seller_name`, `email`, `allow_mails`,`phone`,`location_id`,`category_id`,`title`,`description`,`price`)
VALUES ('$_POST[private]', '$_POST[seller_name]','$_POST[email]','$_POST[allow_mails]','$_POST[phone]','$_POST[location_id]','$_POST[category_id]','$_POST[title]','$_POST[description]','$_POST[price]')";
        mysqli_query($db,$new_ad);
        //то отправляем в базу объявление
    } elseif (check_get_params() && isset($_POST['main_form_submit'])) {//при сохранении объявления
        //перезаписать объявление в базу
        if (!isset($_POST['allow_mails'])) {
            $_POST['allow_mails'] = "0";
        }
        $up_ad = "update ads set private='$_POST[private]', seller_name='$_POST[seller_name]', email='$_POST[email]', allow_mails='$_POST[allow_mails]', phone='$_POST[phone]', location_id='$_POST[location_id]', category_id='$_POST[category_id]', title='$_POST[title]', description='$_POST[description]', price='$_POST[price]' where id = $_GET[id]";
        mysqli_query($db,$up_ad) or die(mysql_error());
    }
}

function delAds() {
    global $id;
    global $ads;
    global $db;
    //print_arr($ads);
    if (isset($_GET['action']) && !isset($_POST['main_form_submit'])) {//если существует GET['action'] и при этом не нажата кнопка
        $id = $_GET['id'];
        if ($_GET['action'] == 'del' && isset($ads[$id])) {
            unset($ads[$id]);
            mysqli_query($db,"delete from ads where id = $_GET[id]");
        }
    }
}

function getAds() {
    global $db;
    $insert_sql = "select ads.id,private,seller_name,email,allow_mails,phone,ads.location_id,ads.category_id,title,description,price,categories.category_id as categories_category_id,citys.location_id as citys_location_id,category,city from ads left join categories on (ads.category_id=categories.category_id) left join citys on (ads.location_id=citys.location_id)";
    $result = mysqli_query($db,$insert_sql);
    while ($row = mysqli_fetch_assoc($result)) {
        global $ads;
        $ads[$row['id']] = $row;
    }
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

function print_arr($a) {
    echo"<pre>";
    print_r($a);
    echo"</pre>";
}

//проверка существует ли array_key_exists ключ в массиве
function get_id_key_exists() {
    global $ad;
    global $ads;
    if (isset($_GET['id']) && isset($ads) && array_key_exists($_GET['id'], $ads)) {
        $ad = $ads[$_GET['id']];
    } else {
        $ad = '';
    }
}

function getCitys($db) {
    $result2 = mysqli_query($db,"select * from citys");
    while ($city = mysqli_fetch_assoc($result2)) {
        $citys[$city['location_id']] = $city['city'];
    }
    return $citys;
}

function getCategories($db) {
    $result3 = mysqli_query($db,"select * from categories");
    while ($category = mysqli_fetch_assoc($result3)) {
        $categories[$category['category_id']] = $category['category'];
    }
    return $categories;
}
