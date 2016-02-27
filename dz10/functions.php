<?php
// Добавление объявления
function add_ads($post) {
    global $db;
    //реализовать добавление объявления в базу
    if (!isset($post['allow_mails'])) {
        $post['allow_mails'] = "0";
    }
    $row = array(
        'private' => $post['private'],
        'seller_name' => $post['seller_name'],
        'email' => $post['email'],
        'allow_mails' => $post['allow_mails'],
        'phone' => $post['phone'],
        'location_id' => $post['location_id'],
        'category_id' => $post['category_id'],
        'title' => $post['title'],
        'description' => $post['description'],
        'price' => $post['price']
    );
    $db->query('INSERT ads SET ?a', $row);
}

// обновление объявления
function up_ads($post) {
    global $db;
    //перезаписать объявление в базу
    if (!isset($post['allow_mails'])) {
        $post['allow_mails'] = "0";
    }
    $row = array(
        'private' => $post['private'],
        'seller_name' => $post['seller_name'],
        'email' => $post['email'],
        'allow_mails' => $post['allow_mails'],
        'phone' => $post['phone'],
        'location_id' => $post['location_id'],
        'category_id' => $post['category_id'],
        'title' => $post['title'],
        'description' => $post['description'],
        'price' => $post['price']
    );
    $id = $_GET['id'];
    $db->query('UPDATE ads SET ?a WHERE id=?d', $row, $id);
}

function delAds($id) {
    global $db;
    $result = $db->query("delete from ads where id = ?", $id);
}

function getAds() {
    global $db;
    global $firePHP;
    $ads = $db->select("select ads.id AS ARRAY_KEY ,private,seller_name,email,allow_mails,phone,ads.location_id,ads.category_id,title,description,price,categories.category_id as categories_category_id,citys.location_id as citys_location_id,category,city from ads left join categories on (ads.category_id=categories.category_id) left join citys on (ads.location_id=citys.location_id)");
    $firePHP->table('Table ads', $ads);
    if (isset($ads)) {
        return $ads;
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
function check_get_params($get) {
    if (isset($get['action']) && $get['action'] == 'show' && isset($get['id'])) {
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

function getCitys() {
    global $db;
    global $firePHP;
    $citys = $db->selectCol("select location_id AS ARRAY_KEY, city from citys");
    $firePHP->table('Table citys', $citys);
    return $citys;
}

function getCategories() {
    global $db;
    global $firePHP;
    $categories = $db->selectCol("select category_id AS ARRAY_KEY, category from categories");
    $firePHP->table('Table categories', $categories);
    return $categories;
}

function myLogger($db, $sql, $caller) {
    global $firePHP;
    if (isset($caller['file'])) {
        $firePHP->group("at " . @$caller['file'] . ' line ' . @$caller['line']);
    }

    $firePHP->log($sql);
    if (isset($caller['file'])) {
        $firePHP->groupEnd();
    }
}

//показывает какие запросы сделаны и сколько строк затронуто и пр.
// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info) {
    // Если использовалась @, ничего не делать.
    if (!error_reporting())
        return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>";
    print_r($info);
    echo "</pre>";
    exit();
}
