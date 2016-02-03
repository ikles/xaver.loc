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
                    echo $ads[$_GET['id']]['seller_name'];
                } else {
                    echo '';
                }
                ?>' name='seller_name' id='fld_seller_name'>
            </div>
            <div>
                <label for='fld_email'>Электронная почта</label>
                <input type='text'  value='<?php
                       if (check_data()) {
                           echo $ads[$_GET['id']]['email'];
                       }
                       ?>' name='email' id='fld_email'>
            </div>
            <div>
                <label for='allow_mails'> <input type='checkbox' value='1' 
                    <?php
                    if (check_data()) {
                        if (isset($ads[$_GET['id']]['allow_mails']) && $ads[$_GET['id']]['allow_mails'] == 1) {
                            echo " checked ";
                        } else {
                            echo '';
                        }
                    }
                    ?>
                                                 name='allow_mails' id='allow_mails' >
                    <span class='form-text-checkbox'>Я не хочу получать вопросы по объявлению по e-mail</span> 
                </label> </div>
            <div>
                <label id='fld_phone_label' for='fld_phone'>Номер телефона</label>
                <input type='text'  value='<?php
                       if (check_data()) {
                           echo $ads[$_GET['id']]['phone'];
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
                           echo $ads[$_GET['id']]['title'];
                       }
                       ?>' name='title' id='fld_title'>
            </div>
            <div>
                <label for='fld_description'  id='js-description-label'>Описание объявления</label>
                <textarea maxlength='3000' name='description' id='fld_description' class='form-input-textarea'><?php
                    if (check_data()) {
                        echo $ads[$_GET['id']]['description'];
                    }
                    ?></textarea>
            </div>
            <div id='price_rw' class='form-row rl'>
                <label id='price_lbl' for='fld_price'>Цена</label>
                <input type='text' maxlength='9' value='<?php
                       if (check_data()) {
                           echo $ads[$_GET['id']]['price'];
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
                    <input type='submit' value='<?php
                       if (isset($_GET['action']) && $_GET['action'] == 'show') {
                           echo"Сохранить";
                       } else {
                           echo"Отправить";
                       }
                       ?>' id='form_submit' name='main_form_submit' class='vas-submit-input'>
                </div>
            </div>
        </form>
        <p></p>