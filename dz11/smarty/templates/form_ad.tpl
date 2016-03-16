
{include file="header.tpl"}

<h1 align="center"><strong>Доска объявлений</strong></h1>
<form style="margin-left: 30%;" method="post"> <font size="4">
    <div> 
        <label class="form-label-radio">
            <input type="radio" value=0 checked="" {if $display->getPrivate() eq 0}checked{/if} name="private">Частное лицо
            <input type="radio" value=1 {if $display->getPrivate() eq 1}checked{/if} name="private">Компания
        </label>
    </div>
    
    <div> 
        <label for="fld_seller_name">
            <b id="your-name">Ваше имя </b>
        </label>
        <input type="text" maxlength="40" value="{$display->getSeller_name()}" name="seller_name" id="fld_seller_name">
    </div>
    <div>
        <label for="fld_email">Электронная почта</label>
        <input type="text" value="{$display->getEmail()}" name="email" id="fld_email">
    </div>
    <div>
        <label for="allow_mail"> <input type="checkbox" value=1 {if ($display->getAllow_mail() eq 1)}checked{/if} name="allow_mail" id="allow_mail">
            <span>Я не хочу получать вопросы по объявлению по e-mail</span>
        </label>
    </div>
    <div>
        <label id="fld_phone_label" for="fld_phone">Номер телефона</label>
        <input type="text" value="{$display->getPhone()}" name="phone" id="fld_phone">
    </div>
    <div class="form-group">
        <label for="region" class="col-sm-2 control-label">Город</label>
        {html_options name=city_id options=$cities selected=$display->getCity_id()}
    </div>
    <div class="form-group">
        <label for="fld_category_id" class="form-label">Категория</label> 
        {html_options name=category_id options=$categories selected=$display->getCategory_id()}
    </div> 
    <div id="f_title">
        <label for="fld_title">Название объявления</label>
        <input type="text" maxlength="50" value="{$display->getTitle()}" name="title" id="fld_title">
    </div>
    <div>
        <label for="fld_description" id="js-description-label">Описание объявления</label>
        <br>
        <textarea name="description" cols="80" rows="5" maxlength="3000" id="fld_description">{$display->getDescription()}</textarea>
    </div>
    <div id="price_rw"> 
        <label id="price_lbl" for="fld_price">Цена</label> 
        <input type="text" maxlength="9" value="{$display->getPrice()}" name="price" id="fld_price">&nbsp;
        <span id="fld_price_title">руб.</span> 
    </div>
    
    <input type="submit" value="{if isset($smarty.get.click_id)}Сохранить{else}Добавить{/if}объявление" id="form_submit" name="confirm_add">
    <input type="submit" value="Очистить форму" id="form_submit" name="clear_form">
    <input type="submit" value="Очистить базу объявлений" id="clear_base" name="clear_base">
    <input type=hidden name=id_r value={if isset($smarty.get.click_id)}{$smarty.get.click_id}{/if}>
</form>
<hr>
    
    <ul>
    {foreach from=$ads key=myId item=i name='ads'}      {* foreach($items as $myId => $i)*}
        <li><div align='left'>
            <a href='{$smarty.server.SCRIPT_NAME}?click_id={$i->getId()}'> # {$i->getTitle()}  
            </a>
            | Цена: {$i->getPrice()} | Продавец: {$i->getSeller_name()} | 
            <a href='{$smarty.server.SCRIPT_NAME}?del_ad={$i->getId()}'>Удалить</a><br></li>
    {foreachelse} База объявлений пуста
    {/foreach}
    </ul>


{include file='footer.tpl'}