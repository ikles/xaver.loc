<?php
session_start();
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
//Проверка формы на заполненность всех полей
if (isset($_POST['main_form_submit'])) {
    if (isset($_POST['private']) &&
            !empty($_POST['seller_name']) &&
            !empty($_POST['email']) &&
            !empty($_POST['phone']) &&
            !empty($_POST['location_id']) &&
            !empty($_POST['category_id']) &&
            !empty($_POST['title']) &&
            !empty($_POST['description']) &&
            !empty($_POST['price'])) {
        $_SESSION['history'][] = $_POST;
    } else {
        $input = "Заполните все поля формы";
    }
}
if (isset($_POST['main_form_submit2'])) {
    $_SESSION['history'][$_GET['id']] = $_POST;
}
// Вывод конкретного объявления
del_show();
?>
<?php /* print_arr($_SESSION); */ ?>
<html>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Форма</title>
        </head>
        <body>
            <h2>Добавление нового объявления</h2>
            <? if (isset($input)) {
                echo $input;
            } ?>
            ﻿<form  method="post">  
                <div> 
                    <label class="form-label-radio">
                        <input type="radio" value="1" name="private">Частное лицо</label>
                    <label class="form-label-radio">
                        <input type="radio" value="0" name="private">Компания</label>
                </div>
                <div>
                    <label for="fld_seller_name"><b id="your-name">Ваше имя</b></label>
                    <input type="text" maxlength="40"  value="" name="seller_name" id="fld_seller_name">
                </div>
                <div>
                    <label for="fld_email">Электронная почта</label>
                    <input type="text"  value="" name="email" id="fld_email">
                </div>
                <div>
                    <label for="allow_mails"> <input type="checkbox" value="1" name="allow_mails" id="allow_mails" >
                        <span class="form-text-checkbox">Я не хочу получать вопросы по объявлению по e-mail</span> 
                    </label> </div>
                <div>
                    <label id="fld_phone_label" for="fld_phone">Номер телефона</label> <input type="text"  value="" name="phone" id="fld_phone">
                </div>
                <div id="f_location_id">
                    <label for="region">Город</label>

                    <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select"> 
                        <option value="">-- Выберите город --</option>
                        <option class="opt-group" disabled="disabled">-- Города --</option>
                        <option selected="" data-coords=",," value="641780">Новосибирск</option>  
                        <option data-coords=",," value="641490">Барабинск</option>   
                        <option data-coords=",," value="641510">Бердск</option>   
                    </select>

                </div>
                <div>
                    <label for="fld_category_id">Категория</label>
                    <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select">
                        <option value="">-- Выберите категорию --</option>
                        <optgroup label="Недвижимость">
                            <option value="24">Квартиры</option>
                            <option value="23">Комнаты</option>
                            <option value="25">Дома, дачи, коттеджи</option>
                        </optgroup>    
                    </select>
                </div>
                <div style="display: none;" id="params" class="form-row form-row-required">
                    <label class="form-label ">Выберите параметры</label>
                    <div class="form-params params" id="filters">
                    </div>           
                </div>

                <div id="f_title" class="form-row f_title">
                    <label for="fld_title">Название объявления</label>
                    <input type="text" maxlength="50" class="form-input-text-long" value="" name="title" id="fld_title">
                </div>
                <div>
                    <label for="fld_description"  id="js-description-label">Описание объявления</label>
                    <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"></textarea>
                </div>
                <div id="price_rw" class="form-row rl">
                    <label id="price_lbl" for="fld_price">Цена</label>
                    <input type="text" maxlength="9" class="form-input-text-short" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span>  
                </div>
                <div style="display: none; margin-top: 0px;" class="form-row-indented images" id="files">
                    <div style="display: none;" id="progress">
                        <table>
                            <tbody>
                                <tr>
                                    <td> <div><div></div></div> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
                    <div class="vas-submit-button pull-left">
                        <span class="vas-submit-border"></span>
                        <span class="vas-submit-triangle"></span> 
                        <input type="submit" value="Отправить" id="form_submit" name="main_form_submit" class="vas-submit-input">
                    </div>
                </div>
            </form>
        <? show_ads(); ?>
        </body>
        <?php

//Функция вывода таблицы с объявлениями
        function show_ads() {
            if (isset($_SESSION['history'])) {
                foreach ($_SESSION['history'] as $id => $value) {
                    echo "<a href=?action=show&id=" . $id . ">" . $value['title'] . "</a> | ";
                    echo $value['price'] . " | ";
                    echo $value['seller_name'] . " | <a href=?action=del&id=" . $id . ">Удалить</a><br>";
                }
            }
        }

//Функция вывода формы
        function show_form() {
            echo
            "
 <html>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Форма</title>
</head>
<body>       
<h2>Показ/изменение объявления</h2>
<form  method='post'>  
    <div>";
            show_private_block();
            echo "</div>
    <div>
        <label for='fld_seller_name'><b id='your-name'>Ваше имя</b></label>
        <input type='text' maxlength='40'  value='" . $_SESSION['history'][$_GET['id']]['seller_name'] . "' name='seller_name' id='fld_seller_name'>
    </div>
    <div>
        <label for='fld_email'>Электронная почта</label>
        <input type='text'  value='" . $_SESSION['history'][$_GET['id']]['email'] . "' name='email' id='fld_email'>
    </div>
    <div>
        <label for='allow_mails'> <input type='checkbox' value='1' ";
            if (isset($_SESSION['history'][$_GET['id']]['allow_mails']) && $_SESSION['history'][$_GET['id']]['allow_mails'] == 1) {
                echo " checked ";
            } else {
                echo " ";
            }
            echo "' name='allow_mails' id='allow_mails' >
            <span class='form-text-checkbox'>Я не хочу получать вопросы по объявлению по e-mail</span> 
        </label> </div>
    <div>
        <label id='fld_phone_label' for='fld_phone'>Номер телефона</label>
        <input type='text'  value='" . $_SESSION['history'][$_GET['id']]['phone'] . "' name='phone' id='fld_phone'>
    </div>
    <div id='f_location_id'>
        <label for='region'>Город</label>";
            show_city_block($_SESSION['history'][$_GET['id']]['location_id']);
            echo "
    </div>
    <div>
        <label for='fld_category_id'>Категория</label>";
            show_category_block($_SESSION['history'][$_GET['id']]['category_id']);
            echo "
    </div>
    <div style='display: none;' id='params' class='form-row form-row-required'>
        <label class='form-label '>Выберите параметры</label>
        <div class='form-params params' id='filters'>
        </div>           
    </div>

    <div id='f_title' class='form-row f_title'>
        <label for='fld_title'>Название объявления</label>
        <input type='text' maxlength='50' class='form-input-text-long' value='";
            echo $_SESSION['history'][$_GET['id']]['title'];
            echo "' name='title' id='fld_title'>
    </div>
    <div>
        <label for='fld_description'  id='js-description-label'>Описание объявления</label>
        <textarea maxlength='3000' name='description' id='fld_description' class='form-input-textarea'>" .
            $_SESSION['history'][$_GET['id']]['description'] . "        
</textarea>
    </div>
    <div id='price_rw' class='form-row rl'>
        <label id='price_lbl' for='fld_price'>Цена</label>
        <input type='text' maxlength='9' value='" . $_SESSION['history'][$_GET['id']]['price'] . "' class='form-input-text-short' name='price' id='fld_price'>&nbsp;<span id='fld_price_title'>руб.</span>  
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
            <input type='submit' value='Сохранить' id='form_submit' name='main_form_submit2' class='vas-submit-input'>
        </div>
    </div>
</form>
</body>
"
            ;
        }

//Функция показа содержимого массива форматированного
        function print_arr($a) {
            echo "<pre>";
            print_r($a);
            echo "</pre>";
        }

//Функция удаления, показа объявления
        function del_show() {
            if (isset($_GET['action']) && !isset($_POST['main_form_submit'])) {//если существует GET['action'] и при этом не нажата кнопка
                if ($_GET['action'] == 'del') {
                    $id = $_GET['id'];
                    if (isset($_SESSION['history'][$id])) {
                        unset($_SESSION['history'][$id]);
                    }
                } elseif ($_GET['action'] == 'show') {
                    $id = $_GET['id'];
                    if (isset($_SESSION['history'][$id])) {
                        show_form(); //вывод формы
                        show_ads(); //вывод объявлений
                        echo "<br><a href='/dz6.php'>Добавить новое объявление >></a><br>";
                        exit();
                    }
                }
            }
        }

//Функция вывода города в форму
        function show_city_block() {
            $citys = array('641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск');
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
            ?>
            </select>    
                    <?php
                }

//Функция вывода категории в форму
                function show_category_block() {
                    $category = array('24' => 'Квартиры', '23' => 'Комнаты', '25' => 'Дома, дачи, коттеджи');
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
            ?>
                </optgroup>
            </select>  
            <?php
        }

//Функция вывода Частное лицо/компания в форму
        function show_private_block() {
            $private = array('1' => 'Частное лицо', '0' => 'Компания');
            $pr = $_SESSION['history'][$_GET['id']]['private'];
            ?>    
    <?php
    foreach ($private as $number => $prive) {
        $checked = ($number == $pr) ? ' checked ' : ' ';
        echo "<label class='form-label-radio'>
                           <input" . $checked . "type='radio' value='" . $number . "' name='private'>" . $prive . "</label>   ";
    }
    ?>                
    <?php
}
?>