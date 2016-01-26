<?

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);
session_start();
//set_time_limit(5); //время выполнения скрипта в секундах, если 0 то бесконечно


/* $number = 5;
  while($number >= 5) {
  echo $number.'<br>';
  $number++;
  }

  do while отличается от while тем что сначала выводится блок а потом уже проверяется условие, то есть 1 раз блок выведется в любом случае

  $number = 5;
  do {
  echo $number.'<br>';
  $number++;
  }
  while($number >= 5) ;

  for($counter=1; $counter<5; $counter++){
  echo "hello<br>";
  }
 */

//Создается новый массив, содержащий 5 значений цвета
$colors = array('red', 'green', 'blue', 'yellow', 'white');
// Цикл for используется для итераций по массиву и вывода каждого элемента
for ($i = 0; $i < count($colors); $i++) {
    echo "Значением элемента массива $i+1 является $colors[$i].<br>";
}



/* $colors = array('color1'=>'red','green','blue','yellow','white');

  foreach($colors as $key => $value)
  {
  echo $key.' =>'. $value."<br>";
  }
 */
//    Бесконечным называется цикл такого вида:
//while (true) { … }
//или такого (что одно и то же):
//for (;;) { … }



$n = 10;
$i = 1;
while (true) {
    echo "$i<br/>";
    $i++;
    if ($i > $n)
        break; //выход из цикла
}
/*
  $colors = array('first'=>'red','green','blue','yellow','white');

  foreach($colors as &$value)//ссылка находит в памяти переменную и меняет ее
  {
  $value .=':no!';
  if($value == 'blue:no!'){
  break;//доходит до blue и далее не преобразовывает
  }
  }
  print_r($colors);
 */

/*
  $colors = array('first'=>'red','green','blue','yellow','white');

  foreach($colors as &$value)
  {
  if($value == 'blue'){
  continue;//доходит до blue пропускает его, а остальное продолжает
  }
  $value .=':no!';
  }
  print_r($colors);
 */

echo "<br>";

$n = 10;
for ($i = 1; $i <= $n; $i++) {
    if ($i % 2 == 0) //если четные
        continue; //то пропускать, остальные показывать
    echo "$i<br/>";
}



$aLanguages = array("Slavic" => array("Russian", "Polish", "Slovenian"),
    "Germanic" => array("Swedish", "Dutch", "English"),
    "Romance" => array("Italian", "Spanish", "Romanian")
);
print_r($aLanguages);

foreach ($aLanguages as $sKey => $aFamily) {
// Вывести название семейства языков:
    echo(
    "<h2>$sKey</h2>" .
    "<ul>"
    );
// Теперь перечислить языки в каждом семействе:
    foreach ($aFamily as $sLanguage) {
        echo("<li>$sLanguage</li>");
    }
// Завершить список:
    echo("</ul>");
}

$x = 0;
global $x; //эту тоже увидит она глобальная
echo $GLOBALS['x']; //можно так обращаться
//print_r($GLOBALS);//содержит все массивы

//$_GET
//$_POST
//$_REQUIEST
//$_FILES
//$_COOKIE

$_SESSION['history'][date('d.m.Y H:i:s')] = $_GET;//записываем в сессию время захода и все что пападает в get массив
print_r($_SESSION);
unset($_SESSION['history']);//удаляем сессию