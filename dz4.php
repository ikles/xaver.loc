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
//print_r($ini_string);
$bd=  parse_ini_string($ini_string, true);
//print_r($bd);

echo "<h3>Содержание корзины</h3>";
$info = array('осталось на складе'=>'','количество заказано'=>'','цена'=>'');
function parse_basket($basket){//сюда будет передаваться массив bd в качестве параметра функции
    global $info;
    global $balance;
    global $total_price;
    global $price;
    global $product_out;
    global $discount3;
    global $disc;
    foreach($basket as $name => $params){//внутри $params оказывается массив, тот который вложенный в основной массив
        echo "<b>".$name."</b><br>";
        echo "Цена за единицу товара: ".$params['цена']." руб.";//тут идет обращение уже к этому массиву по старым ключам
        echo " | Количество заказано: ".$params['количество заказано'];
        echo " | Остаток на складе: ".$params['осталось на складе'].""; 
        echo " | Дисконт: ".$params['diskont']."<br><br>"; 
        
        $info['количество заказано'] = $info['количество заказано'] + $params['количество заказано'];      
        $info['осталось на складе'] = $info['осталось на складе'] + $params['осталось на складе'];      
        if($params['осталось на складе'] == 0){
            $product_out = 'Нужного товара не оказалось на складе: <b>'.$name.'</b>';
        }        
        $price = $price+$params['цена']*$params['количество заказано'];       
        
        $par_disc = $params['diskont'];
        $disc = $total_price*substr($par_disc,7,1)/10;
        
        
        if($params['количество заказано'] <= $params['осталось на складе']){
            $balance = $balance+$params['количество заказано'];
            $total_price = $total_price+$params['цена']*$params['количество заказано'] - $disc;
        }
        else{
            $balance = $balance+$params['осталось на складе'];
            $total_price = $total_price+$params['цена']*$params['осталось на складе'] - $disc;//вычитаем скидку
        } 
        $disc = $total_price*substr($par_disc,7,1)/10;
        
        
        
        
        if($name == 'игрушка детская велосипед' && $params['количество заказано'] >= 3 && $params['осталось на складе'] >= 3){
            $discount3 = 'Вы заказали '.$name.' в количетсве '.$params['количество заказано'].' штук, вам посчитана скидка 30% на эту позицию';
            $disc = 'Пока думаю';
        }
        
            
    }
    echo "Итого:<br> Всего было заказано: ".count($basket)." наименований товара<br>";
}
parse_basket($bd);
if($product_out){
    echo $product_out."<br>";
}
echo " Общее количество заказаных товаров: ".$info['количество заказано']."<br>";
echo " Общее количество товара на складе: ".$balance."<br>";
echo " Сумма заказа: ".$price." руб.<br>";
echo " Общая сумма заказа по наличию: ".$total_price." руб.<br>";
echo'<h2>Скидки</h2>';
echo $discount3;



/*- Вам нужно сделать секцию "Скидки", где известить покупателя о том, что если он заказал "игрушка детская велосипед"
 *  в количестве >=3 штук, то на эту позицию ему 
 * автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически)
 * 3) у каждого товара есть автоматически генерируемый скидочный купон diskont, используйте переменную функцию,
 * чтобы делать скидку на итоговую цену в корзине
 * diskont0 = скидок нет, diskont1 = 10%, diskont2 = 20%
*/

/*
function prices(){
    global $bd;
    $price = array_map(function($element) {return $element['цена'];}, $bd);
    return $price;
}
$prices = prices();

function amounts(){
    global $bd;
    $amount = array_map(function($element) {return $element['количество заказано'];}, $bd);
    return $amount;
}
$amounts = amounts();

function a_keys() {
    global $bd;
    $keys = array_keys($bd);
    return $keys;
}
$name = a_keys();

function discount_action(){
    global $price, $amount;
    return ($price*$amount) - ($price*$amount)/100*30;
}

function discount($discont){
    global $price, $amount;
    if($discont == 'discont1') {
        return $price*$amount/100*10;
    } elseif ($discont == 'discont2') {
        return $price*$amount/100*20;
    }
}

//скидки

if ($amounts['игрушка детская велосипед'] >= 3) {
    $price = $prices['игрушка детская велосипед'];
    $amount = $amounts['игрушка детская велосипед'];
    echo discount_action();
}

 */

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