<?php
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
function parse_basket($basket){//сюда будет передаваться массив bd в качестве параметра функции
    global $info_balance;
    global $info_am_ord;
    global $balance;
    global $total_price;
    global $price;
    global $product_out;
    global $discount3;
    global $disc;
    global $count_basket;
    global $params_price;
    global $params_am_ord;
    global $params_balance;
    global $params_diskont;
    foreach($basket as $name => $params){//внутри $params оказывается массив, тот который вложенный в основной массив
        $params_price = $params['цена'];
        $params_am_ord = $params['количество заказано'];
        $params_balance = $params['осталось на складе'];
        $params_diskont = $params['diskont'];
        echo "<tr><td>".$name."</td>";
        echo "<td>".$params_price." руб.</td>";//тут идет обращение уже к этому массиву по старым ключам
        echo "<td>".$params['количество заказано']."</td>";
        echo "<td>".$params['осталось на складе']."</td>"; 
        echo "<td>".$params['diskont']."</td></tr>";  
        $info_am_ord = $info_am_ord + $params_am_ord;      
        $info_balance = $info_balance + $params_balance;      
        if($params_balance == 0){
            $product_out = '<h2>Уведомления:</h2>Нужного товара не оказалось на складе: <b>'.$name.'</b>';
        }        
        $price = $price+$params_price*$params_am_ord;       
        $par_disc = $params_diskont;       
        //Скидка 30%
        if($name == 'игрушка детская велосипед' && $params_am_ord >= 3 && $params_balance >= 3){
            $disc = 'Вы заказали '.$name.' в количетсве '.$params_am_ord.' штук, вам посчитана скидка 30% на эту позицию';
            $discount3 = 3;
        }      
        if($params_am_ord <= $params_balance){
            $balance = $balance+$params_am_ord;
            if($discount3) {
                $total_price = $total_price+$params_price*$params_am_ord-($params_price*$params_am_ord)*$discount3/10;
            }
            else{
                $total_price = $total_price+$params_price*$params_am_ord-($params_price*$params_am_ord)*substr($par_disc,7,1)/10;
            }
        }
        else{
            $balance = $balance+$params_balance;
            if($discount3) {
              $total_price = $total_price+$params_price*$params_balance-($params_price*$params_balance)*$discount3/10;  
            }
            else {
                $total_price = $total_price+$params_price*$params_balance-($params_price*$params_balance)*substr($par_disc,7,1)/10;
            }
        }      
    }
    $count_basket = count($basket);
}
echo '<table border=1><tr><td>Наименование</td><td>Цена за единицу товара</td><td>Количество заказано</td><td>Остаток на складе</td><td>Дисконт</td></tr>';
parse_basket($bd);
echo '</table>';
if($product_out){
    echo $product_out."<br>";
}
echo "<h2>Итого:</h2> Всего было заказано: ".$count_basket." наименований товара<br>";
echo " Общее количество заказаных товаров: ".$info_am_ord."<br>";
echo " Общее количество товара на складе: ".$balance."<br>";
echo " Сумма заказа: ".$price." руб.<br>";
echo " Общая сумма заказа по наличию: ".$total_price." руб.<br>";
echo'<h2>Скидки</h2>';
echo $disc;
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
