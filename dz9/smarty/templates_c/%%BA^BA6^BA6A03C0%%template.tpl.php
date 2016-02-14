<?php /* Smarty version 2.6.25-dev, created on 2016-02-14 23:20:21
         compiled from template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'template.tpl', 37, false),)), $this); ?>
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
<label class="form-label-radio"><input type="radio" name="private" <?php if ($this->_tpl_vars['ad']['private'] == 1): ?>checked=""<?php endif; ?>value="1">Частное лицо</label>
<label class="form-label-radio"><input type="radio" name="private" <?php if ($this->_tpl_vars['ad']['private'] === '0'): ?>checked=""<?php endif; ?>value="0">Компания</label>  
            </div>
            <div>
                <label for='fld_seller_name'><b id='your-name'>Ваше имя</b></label>
                <input type='text' maxlength='40'  value='<?php echo $this->_tpl_vars['ad']['seller_name']; ?>
' name='seller_name' id='fld_seller_name'>
            </div>
            <div>
                <label for='fld_email'>Электронная почта</label>
                <input type='text'  value='<?php echo $this->_tpl_vars['ad']['email']; ?>
' name='email' id='fld_email'>
            </div>
            <div>
                <label for='allow_mails'> <input type='checkbox' value='1' 
                        <?php if (( isset ( $this->_tpl_vars['ad']['allow_mails'] ) ) && $this->_tpl_vars['ad']['allow_mails'] == 1): ?>
                            checked=""
                        <?php endif; ?>
                                                 name='allow_mails' id='allow_mails' >
                    <span class='form-text-checkbox'>Я не хочу получать вопросы по объявлению по e-mail</span> 
                </label> </div>
            <div>
                <label id='fld_phone_label' for='fld_phone'>Номер телефона</label>
                <input type='text'  value='<?php echo $this->_tpl_vars['ad']['phone']; ?>
' name='phone' id='fld_phone'>
            </div>
            <div id='f_location_id'>
                <label for="region">Город</label>
                        <?php echo smarty_function_html_options(array('name' => 'location_id','options' => $this->_tpl_vars['citys'],'selected' => $this->_tpl_vars['ad']['location_id']), $this);?>
 
            </div>
            <div>
                <label for='fld_category_id'>Категория</label>
                       <?php echo smarty_function_html_options(array('name' => 'category_id','options' => $this->_tpl_vars['category'],'selected' => $this->_tpl_vars['ad']['category_id']), $this);?>
 
            </div>
            <div style='display: none;' id='params' class='form-row form-row-required'>
                <label class='form-label '>Выберите параметры</label>
                <div class='form-params params' id='filters'>
                </div>           
            </div>
            <div id='f_title' class='form-row f_title'>
                <label for='fld_title'>Название объявления</label>
                <input type='text' maxlength='50' class='form-input-text-long' value='<?php echo $this->_tpl_vars['ad']['title']; ?>
' name='title' id='fld_title'>
            </div>
            <div>
                <label for='fld_description'  id='js-description-label'>Описание объявления</label>
                <textarea maxlength='3000' name='description' id='fld_description' class='form-input-textarea'><?php echo $this->_tpl_vars['ad']['description']; ?>
</textarea>
            </div>
            <div id='price_rw' class='form-row rl'>
                <label id='price_lbl' for='fld_price'>Цена</label>
                <input type='text' maxlength='9' value='<?php echo $this->_tpl_vars['ad']['price']; ?>
'
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
                    <input type='submit' value='<?php if (( isset ( $_GET['action'] ) ) && ( $_GET['action'] == 'show' )): ?>Сохранить<?php else: ?>Отправить<?php endif; ?>' id='form_submit' name='main_form_submit' class='vas-submit-input'>
                </div>
            </div>
        </form>
        <p></p>
        <?php if (( isset ( $this->_tpl_vars['ads'] ) )): ?>
    <?php $_from = $this->_tpl_vars['ads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['value']):
?>
        <a href=?action=show&id=<?php echo $this->_tpl_vars['id']; ?>
><?php echo $this->_tpl_vars['value']['title']; ?>
</a> |
        <?php echo $this->_tpl_vars['value']['price']; ?>
 руб. | <?php echo $this->_tpl_vars['value']['seller_name']; ?>
 | <a href=?action=del&id=<?php echo $this->_tpl_vars['id']; ?>
>Удалить</a><br>
    <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>  

<?php if (( check_get_params ( ) )): ?>
    <br><a href='index.php'>Добавить новое объявление >></a><br>
<?php endif; ?>