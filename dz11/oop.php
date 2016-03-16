<?php

class ad {                                                   // класс для хранения данных об объявлении

    public $id;
    public $private;
    public $seller_name;
    public $email;
    public $allow_mail;
    public $phone;
    public $city_id;
    public $category_id;
    public $title;
    public $description;
    public $price;
    public $id_r;

    function __construct($ad) {
        if (isset($ad['id'])) {
            $this->id = $ad['id'];
        }
        $this->private = $ad['private'];
        $this->seller_name = $ad['seller_name'];
        $this->email = $ad['email'];
        if (isset($ad['allow_mail'])) {
            $this->allow_mail = $ad['allow_mail'];
        }

        $this->phone = $ad['phone'];
        $this->city_id = $ad['city_id'];
        $this->category_id = $ad['category_id'];
        $this->title = $ad['title'];
        $this->description = $ad['description'];

        $this->price = $ad['price'];
        if (isset($ad['id_r'])) {
            $this->id_r = $ad['id_r'];
        }
    }

    public function getArray() {
        if (!isset($this->allow_mail)) {
            $this->allow_mail = 0;
        }
        return array('private' => $this->private, 'seller_name' => $this->seller_name, 'email' => $this->email,
            'allow_mail' => $this->allow_mail, 'phone' => $this->phone, 'city_id' => $this->city_id,
            'category_id' => $this->category_id, 'title' => $this->title, 'description' => $this->description, 'price' => $this->price);
    }

    public function getId() {
        return $this->id;
    }

    public function getPrivate() {
        return $this->private;
    }

    public function getSeller_name() {
        return $this->seller_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAllow_mail() {
        return $this->allow_mail;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getCity_id() {
        return $this->city_id;
    }

    public function getCategory_id() {
        return $this->category_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getId_r() {
        return $this->id_r;
    }

}

class adDisplay {                                                        // класс ответственный за вывод данных на экран

    function displayForm($db, $smarty, $sql, $display_id = NULL) {       // функция вывода формы
        if ($display_id) {
            $ad = $sql->getAd($db, $display_id);
        } else {
            $ad = NULL;
        }
        $smarty->assign('display', new ad($ad));
        $smarty->assign('ads', $sql->getAds($db));
        $smarty->assign('cities', $sql->getCities($db));
        $smarty->assign('categories', $sql->getCategories($db));
        $smarty->display('form_ad.tpl');
    }

    function restart() {                                                 // функция перезапуска скрипта
        header("Location: $_SERVER[SCRIPT_NAME]");
        exit;
    }

    function error() {                                                   // вывод ошибки
        echo "<h1 style='color:red' align='center'> НЕТ ТАКОГО ОБЪЯВЛЕНИЯ!<br> <a href='$_SERVER[SCRIPT_NAME]?back=''>НАЗАД</a>";
        exit();
    }

}

class adSql {                                                            // класс ответственный за взаимодействие с базой данных
    // вместо точек вставьте нужный код!!!!!!!!
    function addAd($db, ad $ad) { // функция добавления объявления в БД    
        $db->query('INSERT INTO ads(?#) VALUES(?a)', array_keys($ad->getArray()), array_values($ad->getArray()));
    }

    function editAd($db, ad $ad) {                                      // функция редактирования объявления
        $db->query('UPDATE ads SET ?a WHERE id=?d', $ad->getArray(), $_GET['click_id']);
    }

    function getAd($db, $id) {                                              // возвращает объявление из базы по id
        return $db->selectRow('SELECT * FROM ads WHERE id=?', $id);
    }

    function delAd($db, $id) {                                              // удаляет объявление из базы по id
        $db->query('delete from ads where id = ?', $id);
    }

    function getAds($db) {                                                  // возвращает все объявления из базы
        $ads = $db->select('SELECT * FROM ads');
        $ads_array = array();
        foreach ($ads as $value) {
            $ads_array[] = new ad($value);
        }
        return $ads_array;
    }

    function getCities($db) {                                                // возвращает список городов для селектора
        $cities_query = $db->select('SELECT id AS ARRAY_KEY,city FROM cities');
        foreach ($cities_query as $key => $value) {                                   // приводим массив к соответствующему виду
            $cities[$key] = $value['city'];                                         // для селектора smarty
        }
        return $cities;
    }

    function getCategories($db) {                                            // возвращает список категорий для селектора
        $categories_query = $db->select('SELECT id AS ARRAY_KEY, category, parent_id AS PARENT_KEY FROM categories');
        foreach ($categories_query as $key => $value) {                                                   // приводим массив к соответствующему виду
            if (!$key) {
                $categories[$key] = $value['category'];
            }                                       // для селектора smarty
            foreach ($value['childNodes'] as $k => $v) {
                $categories[$value['category']][$k] = $v['category'];
            }
        }
        return $categories;
    }

    function clearDB($db) {                                              // очищает базу данных
        $db->query("delete from `ads` where 1");
    }

}