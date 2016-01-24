<?php
session_start();
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
//Проверка формы на заполненность всех полей
if (validate($_POST) && !check_data()) {
    $_SESSION['history'][] = $_POST;
} elseif (check_data() && isset($_POST['main_form_submit'])) {
    $_SESSION['history'][$_GET['id']] = $_POST;
} elseif (isset($_GET['action']) && !isset($_POST['main_form_submit'])) {//если существует GET['action'] и при этом не нажата кнопка
    if ($_GET['action'] == 'del') {
        $id = $_GET['id'];
        if (isset($_SESSION['history'][$id])) {
            unset($_SESSION['history'][$id]);
        }
    } elseif ($_GET['action'] == 'show') {
        $id = $_GET['id'];
    }
}
?>
<html>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset='UTF-8'>
            <title>Форма</title>
        </head>
        <body>       
            <h2>Форма добавление/изменения объявления</h2>
            <form  method='post'>  
                <div>
                    <?php show_private_block(); ?>
                </div>
                <div>
                    <label for='fld_seller_name'><b id='your-name'>Ваше имя</b></label>
                    <input type='text' maxlength='40'  value='<?php
                    if (check_data()) {
                        echo $_SESSION['history'][$_GET['id']]['seller_name'];
                    } else {
                        echo '';
                    }
                    ?>' name='seller_name' id='fld_seller_name'>
                </div>
                <div>
                    <label for='fld_email'>Электронная почта</label>
                    <input type='text'  value='<?php
                    if (check_data()) {
                        echo $_SESSION['history'][$_GET['id']]['email'];
                    }
                    ?>' name='email' id='fld_email'>
                </div>
                <div>
                    <label for='allow_mails'> <input type='checkbox' value='1' 
                        <?
                        if (check_data()) {
                            if (isset($_SESSION['history'][$_GET['id']]['allow_mails']) && $_SESSION['history'][$_GET['id']]['allow_mails'] == 1) {
                                echo " checked ";
                            } else {
                                echo '';
                            }
                        }
                        ?>
                                                     ' name='allow_mails' id='allow_mails' >
                        <span class='form-text-checkbox'>Я не хочу получать вопросы по объявлению по e-mail</span> 
                    </label> </div>
                <div>
                    <label id='fld_phone_label' for='fld_phone'>Номер телефона</label>
                    <input type='text'  value='<?php
                        if (check_data()) {
                            echo $_SESSION['history'][$_GET['id']]['phone'];
                        }
                        ?>' name='phone' id='fld_phone'>
                </div>
                <div id='f_location_id'>
                    <label for='region'>Город</label>
<?php show_city_block(); ?>
                </div>
                <div>
                    <label for='fld_category_id'>Категория</label>
<?php show_category_block(); ?>
                </div>
                <div style='display: none;' id='params' class='form-row form-row-required'>
                    <label class='form-label '>Выберите параметры</label>
                    <div class='form-params params' id='filters'>
                    </div>           
                </div>
                <div id='f_title' class='form-row f_title'>
                    <label for='fld_title'>Название объявления</label>
                    <input type='text' maxlength='50' class='form-input-text-long' value='<?php
if (check_data()) {
     echo $_SESSION['history'][$_GET['id']]['title'];
    }
?>' name='title' id='fld_title'>
                </div>
                <div>
                    <label for='fld_description'  id='js-description-label'>Описание объявления</label>
                    <textarea maxlength='3000' name='description' id='fld_description' class='form-input-textarea'><?php
                        if (check_data()) {
                            echo $_SESSION['history'][$_GET['id']]['description'];
                        }
?></textarea>
                </div>
                <div id='price_rw' class='form-row rl'>
                    <label id='price_lbl' for='fld_price'>Цена</label>
                    <input type='text' maxlength='9' value='
<?php
if (check_data()) {
    echo $_SESSION['history'][$_GET['id']]['price'];
}
?>'
                           class='form-input-text-short' name='price' id='fld_price'>&nbsp;<span id='fld_price_title'>руб.</span>  
                </div>
                <div style='display: none; margin-top: 0px;' class='form-row-indented images' id='files'>
                    <div style='display: none;' id='progress'>
                        <table>
                            <tbody>
                                <tr>
                                    <td> <div><div></div></div> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class='form-row-indented form-row-submit b-vas-submit' id='js_additem_form_submit'>
                    <div class='vas-submit-button pull-left'>
                        <span class='vas-submit-border'></span>
                        <span class='vas-submit-triangle'></span> 
                        <input type='submit' value='<?php if (isset($_GET['action']) && $_GET['action'] == 'show') {
    echo"Сохранить";
} else {
    echo"Отправить";
} ?>' id='form_submit' name='main_form_submit' class='vas-submit-input'>
                    </div>
                </div>
            </form>
        <?php
        show_ads(); //Вывод объявлений
        if (check_data()) {
            echo "<br><a href='/dz6.php'>Добавить новое объявление >></a><br>";
        }
        ?>
        </body>
        <?php

//Функция вывода таблицы с объявлениями
        function show_ads() {
            if (isset($_SESSION['history'])) {
                foreach ($_SESSION['history'] as $id => $value) {
                    echo "<a href=?action=show&id=" . $id . ">" . $value['title'] . "</a> | ";
                    echo $value['price'] . " руб. | ";
                    echo $value['seller_name'] . " | <a href=?action=del&id=" . $id . ">Удалить</a><br>";
                }
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
        function check_data() {
            if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
                return true;
            } else {
                return false;
            }
        }

//Функция показа содержимого массива форматированного
        function print_arr($a) {
            echo "<pre>";
            print_r($a);
            echo "</pre>";
        }

//Функция вывода города в форму
        function show_city_block() {
            $citys = array('641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск');
            if (check_data()) {
                $gorod = $_SESSION['history'][$_GET['id']]['location_id'];
                ?>  
                <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select"> 
                    <option value="">-- Выберите город --</option>
                    <option class="opt-group" disabled="disabled">-- Города --</option>
                    <?php
                    foreach ($citys as $number => $city) {
                        $selected = ($number == $gorod) ? 'selected=""' : ''; //если мы передали в функцию город который нужно выставить в списке то мы ставим специальную метку в селектор
                        echo '<option data-coords=",," ' . $selected . ' value="' . $number . '">' . $city . '</option>';
                    }
                } else {
                    ?>
                    <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select"> 
                        <option value="">-- Выберите город --</option>
                        <option class="opt-group" disabled="disabled">-- Города --</option>  
                            <?php
                            foreach ($citys as $number => $city) {
                                echo '<option data-coords=",," value="' . $number . '">' . $city . '</option>';
                            }
                        }
                        ?>
                </select>    
                        <?php
                    }

//Функция вывода категории в форму
                    function show_category_block() {
                        $category = array('24' => 'Квартиры', '23' => 'Комнаты', '25' => 'Дома, дачи, коттеджи');
                        if (check_data()) {
                            $cat = $_SESSION['history'][$_GET['id']]['category_id'];
                            ?>    
                    <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
                        <option value="">-- Выберите категорию --</option>
                        <optgroup label="Недвижимость">
        <?php
        foreach ($category as $number => $categ) {
            $selected = ($number == $cat) ? 'selected=""' : '';
            echo '<option data-coords=",," ' . $selected . ' value="' . $number . '">' . $categ . '</option>';
        }
    } else {
        ?>
                        <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
                            <option value="">-- Выберите категорию --</option>
                            <optgroup label="Недвижимость">
                        <?php
                        foreach ($category as $number => $categ) {

                            echo '<option data-coords=",," value="' . $number . '">' . $categ . '</option>';
                        }
                    }
                    ?>
                        </optgroup>
                    </select>  
                    <?php
                }

//Функция вывода Частное лицо/компания в форму
                function show_private_block() {
                    $private = array('1' => 'Частное лицо', '0' => 'Компания');
                    if (check_data()) {
                        $pr = $_SESSION['history'][$_GET['id']]['private'];
                        foreach ($private as $number => $prive) {
                            if (isset($pr)) {
                                $checked = ($number == $pr) ? ' checked ' : ' ';
                                echo "<label class='form-label-radio'>
<input" . $checked . "type='radio' value='" . $number . "' name='private'>" . $prive . "</label>   ";
                            }
                        }
                    } else {
                        foreach ($private as $number => $prive) {
                            echo "<label class='form-label-radio'>
<input type='radio' value='" . $number . "' name='private'>" . $prive . "</label>";
                        }
                    }
                }
                