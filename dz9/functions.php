<?php
// Добавление объявления
function add_ads($post){   
        //реализовать добавление объявления в базу
        if (!isset($post['allow_mails'])) {
            $post['allow_mails'] = "0";
        }
        $new_ad = "insert into `ads` (`private`, `seller_name`, `email`, `allow_mails`,`phone`,`location_id`,`category_id`,`title`,`description`,`price`)
VALUES ('$post[private]', '$post[seller_name]','$post[email]','$post[allow_mails]','$post[phone]','$post[location_id]','$post[category_id]','$post[title]','$post[description]','$post[price]')";
        mysql_query($new_ad);

}

// обновление объявления
function up_ads($post) {
        //перезаписать объявление в базу
        if (!isset($post['allow_mails'])) {
            $post['allow_mails'] = "0";
        }
        $up_ad = "update ads set private='$post[private]', seller_name='$post[seller_name]', email='$post[email]', allow_mails='$post[allow_mails]', phone='$post[phone]', location_id='$post[location_id]', category_id='$post[category_id]', title='$post[title]', description='$post[description]', price='$post[price]' where id = $_GET[id]";
        mysql_query($up_ad) or die(mysql_error());
    }

function delAds($id) {
        $id = intval($id);
        mysql_query("delete from ads where id = ".$id);
}

function getAds() {
    $insert_sql = "select ads.id,private,seller_name,email,allow_mails,phone,ads.location_id,ads.category_id,title,description,price,categories.category_id as categories_category_id,citys.location_id as citys_location_id,category,city from ads left join categories on (ads.category_id=categories.category_id) left join citys on (ads.location_id=citys.location_id)";
    $result = mysql_query($insert_sql);
    while ($row = mysql_fetch_assoc($result)) {        
        $ads[$row['id']] = $row;
    }
    if (isset($ads)) {return $ads;}
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

function getCitys() {
    $result2 = mysql_query("select * from citys");
    while ($city = mysql_fetch_assoc($result2)) {
        $citys[$city['location_id']] = $city['city'];
    }
    return $citys;
}

function getCategories() {
    $result3 = mysql_query("select * from categories");
    while ($category = mysql_fetch_assoc($result3)) {
        $categories[$category['category_id']] = $category['category'];
    }
    return $categories;
}