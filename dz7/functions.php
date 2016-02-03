<?php

//Функция вывода таблицы с объявлениями
function show_ads() {
    global $ads;
    if (isset($ads)) {
        foreach ($ads as $id => $value) {
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
    global $ads;
    $citys = array('641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск');
    if (check_data()) {
        $gorod = $ads[$_GET['id']]['location_id'];
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
        global $ads;
        $category = array('24' => 'Квартиры', '23' => 'Комнаты', '25' => 'Дома, дачи, коттеджи');
        if (check_data()) {
            $cat = $ads[$_GET['id']]['category_id'];
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
            global $ads;
            $private = array('1' => 'Частное лицо', '0' => 'Компания');
            if (check_data()) {
                $pr = $ads[$_GET['id']]['private'];
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
        ?>