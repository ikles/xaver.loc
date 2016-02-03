<?php
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
if (file_exists('ads.html')) {
$ads = file_get_contents('ads.html');
$ads = unserialize($ads);
}
include 'functions.php';
//Проверка формы на заполненность всех полей
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
if (isset($ads)) {file_put_contents('ads.html', serialize($ads));}
include 'template.php';
show_ads(); //Вывод объявлений
if (check_data()) {
    echo "<br><a href='dz6_2.php'>Добавить новое объявление >></a><br>";
}
?>
</body>