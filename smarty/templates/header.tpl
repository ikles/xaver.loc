<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE>{$title} / {$var1}</TITLE>
<script>
    function get_alert(){ldelim}//Вместо левой фигурной скобки используется ldelim в скобках а правой rdelim
        alert('test');
        {rdelim}
    //get_alert();
 </script>   
 {*literal оборачивая им можно писать что угодно и все будет восприниматься как надо*}
    {literal}
     <script>
    function get_alert2(){
        alert('{/literal}{$title}{literal}');//если нужно использовать что-то в скобках, то закрываем его и снова открываем после
        }
    //get_alert2();
 </script>      
    {/literal}
    

</HEAD>
<BODY bgcolor="#ffffff">
