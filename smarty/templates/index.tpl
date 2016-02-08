{include file="$header_template.tpl" var1='2016'}{*подключение файла и передача переменной для использования в header *}
{*конструкция выше переменная и добавляется .tpl все обрабатывается т. к. двойные кавычки*}
{assign var=time value='555'}{*Задаем переменную прямо в шаблоне*}
Привет {$name|replace:'горь':'ра'}{*модификатор replace меняет буквы в значении*}, как дела
<br>
{if $name eq 'Игорь'}{*альтернатива квалификатора eq это значит равно == *}
    Мое имя Игорь
    {else}
        Мое имя не Игорь
        {/if}

<br>Время {$time}
<br>
Server name: {$smarty.server.SERVER_NAME} {* в php так $_SERVER['SERVER_NAME']*}
<br>
{if (isset($smarty.get.id))}
Get: {$smarty.get.id} {*в php $_GET['id']*}
{else}
not get
{/if}
<br>
Name: {$names.first}, {$names[1]} {*вызов ассоц массива и индексного*}
<br>
Phone home: {$Contacts.phone.home}
<br>
{$raz|date_format:"%Y.%m.%d"}{*модификатор форматирует юниксовое время в нормальное*}
<br>
<ul>
{foreach from=$items key=myId item=i}{*форичим $items ключи пишем в myId a значения пишем в i*}
<li><a href="item.php?id={$myId}">{$i.no}: {$i.label}</a></li>{*здесь индекс no у массива $i и индекс label у массива $i, обращение к массивам как и ранее*}
{/foreach}
</ul>
<br>
{php}
//Вывод обычного php кода
//global $not_smarty;//обязательно объявить ее глобавльной
//echo $not_smarty;
{/php}
<br>
{html_options name=customer_id options=$cust_options selected=$customer_id}{*name имя селектора, options опции селектора, selected выбранное значение*}

<br>
{html_table loop=$data}
{html_table loop=$data cols=4 table_attr='border="0"'}
{html_table loop=$data cols="first,second,third,fourth" tr_attr=$tr}

<br>
<br>
<br>
<br>
<br>
<br>






{include file='footer.tpl'}












