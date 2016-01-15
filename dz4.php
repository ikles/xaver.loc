﻿<?php
/*
 * Задание 1
 * - Вы проектируете интернет магазин. Посетитель на вашем сайте создал следующий заказ (цена, количество в заказе
 *   и остаток на складе генерируются автоматически):
 */
error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$ini_string='
[игрушка мягкая мишка белый]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[одежда детская куртка синяя синтепон]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[игрушка детская велосипед]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';

';

$bd = parse_ini_string($ini_string, true);
echo "<h3>Содержание корзины</h3>";
echo '<table border=1><tr><td>Наименование</td><td>Цена за единицу товара</td><td>Количество заказано</td><td>Остаток на складе</td><td>Дисконт</td><td>Цена с учетом скидки</td></tr>';
    global $info_am_ord;
    global $balances;
    global $total_price;
    global $prices;
    global $product_out;    
    foreach($bd as $name => $params){
        $price = $params['цена'];
        $ordered = $params['количество заказано'];
        $balance = $params['осталось на складе'];
        $diskont = $params['diskont'];
        echo "<tr><td>".$name."</td>";
        echo "<td>".$price." руб.</td>";
        echo "<td>".$ordered."</td>";
        echo "<td>".$balance."</td>"; 
        if($name == 'игрушка детская велосипед' && $ordered >= 3 && $balance >= 3){
            $disc = 'Вы заказали '.$name.' в количетсве '.$ordered.' штук, вам посчитана скидка 30% на эту позицию';
            $diskont = 'diskont3';
        } 
        echo "<td>".diskont($diskont)."%</td>";         
        echo "<td>";
        if($name == 'игрушка детская велосипед' && $ordered >= 3 && $balance >= 3){
            $disc = 'Вы заказали '.$name.' в количетсве '.$ordered.' штук, вам посчитана скидка 30% на эту позицию';
            $diskont = 'diskont3';
        }     
        $info_am_ord = $info_am_ord + $ordered; //Общее количество заказаных товаров:
          if($ordered > $balance){
            $ordered = $balance;
        } 
        $total = $price*$ordered - ($price*$ordered*diskont($diskont)/100);//Цена с учетом скидки
        echo $total;
        echo " руб.</td></tr>";       
        if($balance == 0){
            $product_out = '<h2>Уведомления:</h2>Нужного товара не оказалось на складе: <b>'.$name.'</b>';
        }                      
         $prices += $price*$ordered; //Сумма заказа:
         $balances += $ordered;//Общее количество товара на складе:
         $total_price += $total; //Общая сумма заказа по наличию на складе с учетом всех скидок:
    }//закрытие foreach
    $count_basket = count($bd);   
echo '</table>';
if($product_out){
    echo $product_out."<br>";
}
echo "<h2>Итого:</h2> Всего было заказано: ".$count_basket." наименований товара<br>";
echo " Общее количество заказаных товаров: ".$info_am_ord."<br>";
echo " Общее количество товара на складе: ".$balances."<br>";
echo " Сумма заказа: ".$prices." руб.<br>";
echo " Общая сумма заказа по наличию на складе с учетом всех скидок: ".$total_price." руб.<br>";
echo'<h2>Скидки</h2>';
if (isset($disc)) {echo $disc;}
//Вычисление скидки
function diskont($num){     
    $percent = substr($num,7,1)*10;
    return $percent;
}
/*
 * 
 * - Вам нужно вывести корзину для покупателя, где указать: 
 * 1) Перечень заказанных товаров, их цену, кол-во и остаток на складе
 * 2) В секции ИТОГО должно быть указано: сколько всего наименовний было заказано, каково общее количество товара,
 * какова общая сумма заказа
 * - Вам нужно сделать секцию "Уведомления", где необходимо извещать покупателя о том, что нужного количества товара 
 * не оказалось на складе
 * - Вам нужно сделать секцию "Скидки", где известить покупателя о том, что если он заказал "игрушка детская велосипед"
 *  в количестве >=3 штук, то на эту позицию ему 
 * автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически)
 * 3) у каждого товара есть автоматически генерируемый скидочный купон diskont, используйте переменную функцию,
 * чтобы делать скидку на итоговую цену в корзине
 * diskont0 = скидок нет, diskont1 = 10%, diskont2 = 20%
 * 
 * В коде должно быть использовано:
 * - не менее одной функции
 * - не менее одного параметра для функции
 * операторы if, else, switch
 * статические и глобальные переменные в теле функции
 * 
 */
